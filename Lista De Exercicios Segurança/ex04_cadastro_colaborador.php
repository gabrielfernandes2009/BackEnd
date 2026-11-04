<?php
declare(strict_types=1);

function e(string $texto): string 
{
    return htmlspecialchars($texto, ENT_QUOTES | ENT_HTML5, 'UTF-8');
}

function sanitizarTexto(string $dado): string 
{
    return trim(strip_tags($dado));
}

/**
 * Valida os dados do colaborador mapeando os tipos corretos.
 */
function validarColaborador(array $dados): array 
{
    $erros = [];
    $resultado = [];

    $resultado['nome'] = sanitizarTexto($dados['nome'] ?? '');
    if (empty($resultado['nome'])) {
        $erros[] = "Nome inválido.";
    }

    $email = filter_var($dados['email'] ?? '', FILTER_VALIDATE_EMAIL);
    if (!$email) {
        $erros[] = "E-mail inválido.";
    } else {
        $resultado['email'] = $email;
    }

    $matricula = filter_var($dados['matricula'] ?? '', FILTER_VALIDATE_INT);
    if ($matricula === false) {
        $erros[] = "A matrícula deve ser um número inteiro.";
    } else {
        $resultado['matricula'] = $matricula;
    }

    $salario = filter_var($dados['salario'] ?? '', FILTER_VALIDATE_FLOAT);
    if ($salario === false) {
        $erros[] = "O salário deve ser um valor numérico decimal.";
    } else {
        $resultado['salario'] = $salario;
    }

    return ['valido' => empty($erros), 'erros' => $erros, 'dados' => $resultado];
}

$feedback = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $feedback = validarColaborador($_POST);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Colaborador</title>
</head>
<body>
    <h1>Cadastro de Colaboradores</h1>

    <?php if ($feedback && !$feedback['valido']): ?>
        <div style="color: red;">
            <ul>
                <?php foreach ($feedback['erros'] as $erro): ?>
                    <li><?= e($erro) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if ($feedback && $feedback['valido']): ?>
        <div style="color: green; border: 1px solid green; padding: 10px;">
            <h3>Colaborador Cadastrado com Sucesso!</h3>
            <p>Nome: <?= e($feedback['dados']['nome']) ?></p>
            <p>E-mail: <?= e($feedback['dados']['email']) ?></p>
            <p>Matrícula: <?= e((string)$feedback['dados']['matricula']) ?></p>
            <p>Salário: R$ <?= e(number_format($feedback['dados']['salario'], 2, ',', '.')) ?></p>
        </div>
    <?php endif; ?>

    <form method="POST">
        <p><label>Nome: <input type="text" name="nome"></label></p>
        <p><label>E-mail: <input type="text" name="email"></label></p>
        <p><label>Matrícula: <input type="text" name="matricula"></label></p>
        <p><label>Salário: <input type="text" name="salario"></label></p>
        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>
