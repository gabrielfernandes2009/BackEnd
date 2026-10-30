<?php
// Inicialização de variáveis para evitar erros de "undefined"
$valor_veiculo = '';
$valor_entrada = '';
$numero_parcelas = '';

// Array para armazenar mensagens de erro específicas
$erros = [
    'veiculo' => '',
    'entrada' => '',
    'parcelas' => ''
];

$calculo_realizado = false;
$parcelas_permitidas =;

// Variáveis de resultado da memória de cálculo
$valor_financiado = 0;
$total_juros = 0;
$valor_total_com_juros = 0;
$valor_parcela = 0;

// Processa o formulário quando enviado via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Coleta e limpa os dados recebidos
    $valor_veiculo = filter_var($_POST['valor_veiculo'] ?? '', FILTER_VALIDATE_FLOAT);
    $valor_entrada = filter_var($_POST['valor_entrada'] ?? '', FILTER_VALIDATE_FLOAT);
    $numero_parcelas = filter_var($_POST['numero_parcelas'] ?? '', FILTER_VALIDATE_INT);

    // 1. Validação do Valor do Veículo
    if ($valor_veiculo === false || $valor_veiculo <= 0) {
        $erros['veiculo'] = 'Informe um valor válido e maior que zero para o veículo.';
    }

    // 2. Validação do Valor da Entrada (Mínimo de 20% do veículo)
    if ($valor_entrada === false || $valor_entrada < 0) {
        $erros['entrada'] = 'Informe um valor de entrada válido.';
    } elseif ($valor_veiculo > 0) {
        $entrada_minima = $valor_veiculo * 0.20;
        if ($valor_entrada < $entrada_minima) {
            $erros['entrada'] = 'A entrada deve ser de pelo menos 20% do valor do veículo (R$ ' . number_format($entrada_minima, 2, ',', '.') . ').';
        }
    }

    // 3. Validação do Número de Parcelas
    if (!in_array($numero_parcelas, $parcelas_permitidas)) {
        $erros['parcelas'] = 'Selecione uma quantidade de parcelas válida.';
    }

    // Se não houver erros de validação, executa a Regra de Negócio
    if (!array_filter($erros)) {
        $taxa_juros_mensal = 0.015; // 1.5% ao mês

        // Saldo Financiado = Valor do Veículo - Entrada
        $valor_financiado = $valor_veiculo - $valor_entrada;

        // Juros Simples: J = C * i * t
        $total_juros = $valor_financiado * $taxa_juros_mensal * $numero_parcelas;

        // Montante Total e Valor das Parcelas
        $valor_total_com_juros = $valor_financiado + $total_juros;
        $valor_parcela = $valor_total_com_juros / $numero_parcelas;

        $calculo_realizado = true;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Simulador de Financiamento de Veículos</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; background-color: #f4f7f6; color: #333; }
        .container { max-width: 550px; background: white; padding: 25px; border-radius: 8px; box-shadow: 0px 4px 12px rgba(0,0,0,0.1); margin: 0 auto; }
        h2, h3 { color: #0056b3; margin-top: 0; }
        .form-group { margin-bottom: 18px; }
        label { display: block; font-weight: bold; margin-bottom: 6px; }
        input[type="number"], select { width: 100%; padding: 10px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; font-size: 1a; }
        .error-message { color: #dc3545; font-size: 0.85em; margin-top: 5px; display: block; font-weight: bold; }
        button { width: 100%; background-color: #0056b3; color: white; border: none; padding: 12px; cursor: pointer; border-radius: 4px; font-size: 1.1em; font-weight: bold; }
        button:hover { background-color: #004085; }
        .resultado { background-color: #e9ecef; padding: 20px; border-radius: 6px; border-left: 5px solid #28a745; margin-top: 25px; }
        .resultado-linha { display: flex; justify-content: space-between; margin-bottom: 8px; padding-bottom: 8px; border-bottom: 1px solid #dee2e6; }
        .resultado-linha:last-child { border-bottom: none; margin-bottom: 0; padding-bottom: 0; font-size: 1.1em; }
        .destaque { font-weight: bold; color: #28a745; }
    </style>
</head>
<body>

<div class="container">
    <h2>Simulador de Financiamento</h2>
    
    <form action="ex04_financiamento.php" method="POST">
        <!-- Campo: Valor do Veículo -->
        <div class="form-group">
            <label for="valor_veiculo">Valor Total do Veículo (R$):</label>
            <input type="number" id="valor_veiculo" name="valor_veiculo" step="0.01" min="0" value="<?= htmlspecialchars((string)$valor_veiculo) ?>" required>
            <?php if (!empty($erros['veiculo'])): ?>
                <span class="error-message"><?= $erros['veiculo'] ?></span>
            <?php endif; ?>
        </div>

        <!-- Campo: Valor da Entrada -->
        <div class="form-group">
            <label for="valor_entrada">Valor de Entrada (R$):</label>
            <input type="number" id="valor_entrada" name="valor_entrada" step="0.01" min="0" value="<?= htmlspecialchars((string)$valor_entrada) ?>" required>
            <?php if (!empty($erros['entrada'])): ?>
                <span class="error-message"><?= $erros['entrada'] ?></span>
            <?php endif; ?>
        </div>

        <!-- Campo: Número de Parcelas -->
        <div class="form-group">
            <label for="numero_parcelas">Quantidade de Parcelas:</label>
            <select id="numero_parcelas" name="numero_parcelas" required>
                <option value="">-- Selecione as parcelas --</option>
                <?php foreach ($parcelas_permitidas as $p): ?>
                    <option value="<?= $p ?>" <?= $numero_parcelas === $p ? 'selected' : '' ?>><?= $p ?>x</option>
                <?php endforeach; ?>
            </select>
            <?php if (!empty($erros['parcelas'])): ?>
                <span class="error-message"><?= $erros['parcelas'] ?></span>
            <?php endif; ?>
        </div>

        <button type="submit">Calcular Financiamento</button>
    </form>

    <!-- Bloco de exibição dos resultados (Memória de Cálculo) -->
    <?php if ($calculo_realizado): ?>
        <div class="resultado">
            <h3>Memória de Cálculo</h3>
            
            <div class="resultado-linha">
                <span>Valor do Veículo:</span>
                <strong>R$ <?= number_format($valor_veiculo, 2, ',', '.') ?></strong>
            </div>
            
            <div class="resultado-linha">
                <span>Entrada Informada:</span>
                <strong>R$ <?= number_format($valor_entrada, 2, ',', '.') ?></strong>
            </div>
            
            <div class="resultado-linha">
                <span>Valor Financiado (Saldo):</span>
                <strong>R$ <?= number_format($valor_financiado, 2, ',', '.') ?></strong>
            </div>
            
            <div class="resultado-linha">
                <span>Total de Juros (1.5% a.m. simples):</span>
                <strong style="color: #dc3545;">R$ <?= number_format($total_juros, 2, ',', '.') ?></strong>
            </div>

            <div class="resultado-linha">
                <span>Total Geral Pago (Saldo + Juros):</span>
                <strong>R$ <?= number_format($valor_total_com_juros, 2, ',', '.') ?></strong>
            </div>
            
            <div class="resultado-linha">
                <span>Valor de Cada Parcala (<?= $numero_parcelas ?>x):</span>
                <span class="destaque">R$ <?= number_format($valor_parcela, 2, ',', '.') ?></span>
            </div>
        </div>
    <?php endif; ?>
</div>

</body>
</html>
