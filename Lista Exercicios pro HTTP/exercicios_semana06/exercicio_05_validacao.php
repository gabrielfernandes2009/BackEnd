
<?php
// Inicialização de variáveis para evitar avisos de "undefined"
$nome = '';
$idade = '';
$curso = '';
$termos = false;

// Arrays para armazenar as mensagens de erro de cada campo
$erros = [
    'nome' => '',
    'idade' => '',
    'curso' => '',
    'termos' => ''
];

$sucesso = false;
$cursos_permitidos = ['Desenvolvimento de Sistemas', 'Mecatrônica', 'Redes'];

// Verifica se o formulário foi enviado via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Coleta e sanitiza os dados enviados
    $nome = trim($_POST['nome_candidato'] ?? '');
    $idade = trim($_POST['idade'] ?? '');
    $curso = $_POST['curso_desejado'] ?? '';
    $termos = isset($_POST['aceite_termos']);

    // 1. Validação do Nome (pelo menos 5 caracteres)
    if (empty($nome)) {
        $erros['nome'] = 'O nome do candidato é obrigatório.';
    } elseif (strlen($nome) < 5) {
        $erros['nome'] = 'O nome deve conter pelo menos 5 caracteres.';
    }

    // 2. Validação da Idade (maior ou igual a 16 anos)
    if (empty($idade)) {
        $erros['idade'] = 'A idade é obrigatória.';
    } elseif (!filter_var($idade, FILTER_VALIDATE_INT) || intval($idade) < 16) {
        $erros['idade'] = 'Apenas candidatos com 16 anos ou mais podem se inscrever.';
    }

    // 3. Validação do Curso (obrigatório e pertencente à lista)
    if (empty($curso)) {
        $erros['curso'] = 'Selecione um curso técnico.';
    } elseif (!in_array($curso, $cursos_permitidos)) {
        $erros['curso'] = 'Curso inválido selecionado.';
    }

    // 4. Validação dos Termos (checkbox obrigatório)
    if (!$termos) {
        $erros['termos'] = 'Você deve aceitar os termos de uso para continuar.';
    }

    // Se o array de erros continuar totalmente vazio, a validação passou
    if (!array_filter($erros)) {
        $sucesso = true;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Inscrição - Processo Seletivo SENAI</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; background-color: #f4f4f4; }
        .form-container { max-width: 500px; background: white; padding: 20px; border-radius: 8px; box-shadow: 0px 0px 10px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 15px; }
        label { display: block; font-weight: bold; margin-bottom: 5px; }
        input[type="text"], input[type="number"], select { width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        .error-message { color: red; font-size: 0.85em; margin-top: 5px; display: block; }
        .success-message { color: green; font-weight: bold; background: #e2f0d9; padding: 15px; border-radius: 4px; margin-bottom: 20px; }
        button { background-color: #0056b3; color: white; border: none; padding: 10px 15px; cursor: pointer; border-radius: 4px; font-size: 1a; }
        button:hover { background-color: #004085; }
        .checkbox-group label { display: inline; font-weight: normal; }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Inscrição Cursos Técnicos SENAI</h2>

    <?php if ($sucesso): ?>
        <div class="success-message">
            Inscrição realizada com sucesso para o curso de <?= htmlspecialchars($curso) ?>!
        </div>
    <?php endif; ?>

    <form action="ex05_inscricao.php" method="POST">
        
        <!-- Campo: Nome -->
        <div class="form-group">
            <label for="nome_candidato">Nome Completo:</label>
            <input type="text" id="nome_candidato" name="nome_candidato" value="<?= htmlspecialchars($nome) ?>">
            <?php if (!empty($erros['nome'])): ?>
                <span class="error-message"><?= $erros['nome'] ?></span>
            <?php endif; ?>
        </div>

        <!-- Campo: Idade -->
        <div class="form-group">
            <label for="idade">Idade:</label>
            <input type="number" id="idade" name="idade" value="<?= htmlspecialchars($idade) ?>">
            <?php if (!empty($erros['idade'])): ?>
                <span class="error-message"><?= $erros['idade'] ?></span>
            <?php endif; ?>
        </div>

        <!-- Campo: Curso Desejado -->
        <div class="form-group">
            <label for="curso_desejado">Curso Desejado:</label>
            <select id="curso_desejado" name="curso_desejado">
                <option value="">-- Selecione um curso --</option>
                <?php foreach ($cursos_permitidos as $c): ?>
                    <option value="<?= $c ?>" <?= $curso === $c ? 'selected' : '' ?>><?= $c ?></option>
                <?php endforeach; ?>
            </select>
            <?php if (!empty($erros['curso'])): ?>
                <span class="error-message"><?= $erros['curso'] ?></span>
            <?php endif; ?>
        </div>

        <!-- Campo: Aceite de Termos -->
        <div class="form-group checkbox-group">
            <input type="checkbox" id="aceite_termos" name="aceite_termos" value="1" <?= $termos ? 'checked' : '' ?>>
            <label for="aceite_termos">Estou ciente e aceito os termos do processo seletivo.</label>
            <?php if (!empty($erros['terms'] ?? $erros['termos'])): ?>
                <span class="error-message"><?= $erros['termos'] ?></span>
            <?php endif; ?>
        </div>

        <button type="submit">Enviar Inscrição</button>
    </form>
</div>

</body>
</html>
