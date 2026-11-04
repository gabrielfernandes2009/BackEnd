<?php
declare(strict_types=1);

function e(string $texto): string 
{
    return htmlspecialchars($texto, ENT_QUOTES | ENT_HTML5, 'UTF-8');
}

/**
 * Valida se a URL é bem formada e utiliza estritamente HTTP ou HTTPS.
 */
function validarUrlSegura(string $url): ?string 
{
    $urlValidada = filter_var($url, FILTER_VALIDATE_URL);
    
    if ($urlValidada === false) {
        return null;
    }

    if (!str_starts_with($urlValidada, 'http://') && !str_starts_with($urlValidada, 'https://')) {
        return null;
    }

    return $urlValidada;
}

$erro = '';
$linkValido = '';
$nome = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $urlInput = trim($_POST['url'] ?? '');

    $linkValido = validarUrlSegura($urlInput);

    if (empty($nome)) {
        $erro = "O nome é obrigatório.";
        $linkValido = null;
    } elseif (!$linkValido) {
        $erro = "URL inválida ou protocolo não permitido. Use apenas http:// ou https://";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Portfólio</title>
</head>
<body>
    <h1>Validador de Links de Portfólio</h1>

    <?php if ($erro): ?>
        <div style="color: red;"><?= e($erro) ?></div>
    <?php endif; ?>

    <form method="POST">
        <p><label>Nome: <input type="text" name="nome" value="<?= e($nome) ?>"></label></p>
        <p><label>Link (GitHub/LinkedIn): <input type="text" name="url" style="width: 300px;"></label></p>
        <button type="submit">Validar e Cadastrar</button>
    </form>

    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && $linkValido): ?>
        <h2>Resultado:</h2>
        <p>Desenvolvedor: <?= e($nome) ?></p>
        <!-- O link passa pelo e() para evitar quebras de atributo HTML -->
        <p><a href="<?= e($linkValido) ?>" target="_blank" rel="noopener noreferrer">Visitar Portfólio</a></p>
    <?php endif; ?>
</body>
</html>
