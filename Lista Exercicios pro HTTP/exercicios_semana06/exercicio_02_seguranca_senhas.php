<?php
// 1. Funções de cálculo e classificação
function calcularIMC(float $peso, float $altura): float {
    return $peso / ($altura ** 2);
}

function classificarIMC(float $imc): string {
    if ($imc < 18.5) return 'Abaixo do peso';
    if ($imc < 25.0) return 'Normal';
    if ($imc < 30.0) return 'Sobrepeso';
    return 'Obesidade';
}

// 2. Inicialização de variáveis para o Sticky Form e mensagens
$nome = $_POST['nome'] ?? '';
$peso = isset($_POST['peso']) ? (float)$_POST['peso'] : '';
$altura = isset($_POST['altura']) ? (float)$_POST['altura'] : '';
$erros = [];
$resultado = null;

// 3. Processamento do formulário POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty(trim($nome))) $erros[] = "O campo nome é obrigatório.";
    if ($peso < 20 || $peso > 300) $erros[] = "O peso deve estar entre 20kg e 300kg.";
    if ($altura < 0.5 || $altura > 2.5) $erros[] = "A altura deve estar entre 0.5m e 2.5m.";

    if (empty($erros)) {
        $imc = calcularIMC($peso, $altura);
        $classificacao = classificarIMC($imc);
        
        // Define a classe CSS baseada na classificação
        $cor = 'vermelho';
        if ($classificacao === 'Normal') $cor = 'verde';
        if ($classificacao === 'Sobrepeso') $cor = 'amarelo';

        $resultado = [
            'imc' => number_format($imc, 1, ',', '.'),
            'classe' => $classificacao,
            'cor' => $cor
        ];
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Calculadora de IMC Interativa</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; background-color: #f9f9f9; }
        .container { max-width: 450px; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .campo { margin-bottom: 15px; }
        label { display: block; font-weight: bold; margin-bottom: 5px; }
        input[type="text"], input[type="number"] { width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        button { background: #007BFF; color: white; border: none; padding: 10px 15px; border-radius: 4px; cursor: pointer; width: 100%; font-size: 16px; }
        .erros { color: #721c24; background: #f8d7da; padding: 10px; border-radius: 4px; margin-bottom: 15px; }
        .resultado { padding: 15px; border-radius: 4px; margin-top: 20px; text-align: center; font-weight: bold; }
        /* Estilos condicionais solicitados */
        .verde { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .amarelo { background-color: #fff3cd; color: #856404; border: 1px solid #ffeeba; }
        .vermelho { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
    </style>
</head>
<body>

<div class="container">
    <h2>Calculadora de IMC</h2>

    <?php if (!empty($erros)): ?>
        <div class="erros">
            <?php foreach ($erros as $erro) echo "<p style='margin:5px 0;'>$erro</p>"; ?>
        </div>
    <?php endif; ?>

    <form action="ex02_calculadora_imc.php" method="POST">
        <div class="campo">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($nome) ?>" required>
        </div>
        <div class="campo">
            <label for="peso">Peso (kg):</label>
            <input type="number" id="peso" name="peso" step="0.1" value="<?= $peso ?>" placeholder="Ex: 75.5" required>
        </div>
        <div class="campo">
            <label for="altura">Altura (m):</label>
            <input type="number" id="altura" name="altura" step="0.01" value="<?= $altura ?>" placeholder="Ex: 1.75" required>
        </div>
        <button type="submit">Calcular IMC</button>
    </form>

    <?php if ($resultado): ?>
        <div class="resultado <?= $resultado['cor'] ?>">
            <p><?= htmlspecialchars($nome) ?>, seu IMC é <?= $resultado['imc'] ?></p>
            <p>Classificação: <?= $resultado['classe'] ?></p>
        </div>
    <?php endif; ?>
</div>

</body>
</html>
