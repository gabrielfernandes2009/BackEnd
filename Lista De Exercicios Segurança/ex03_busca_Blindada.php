<?php
declare(strict_types=1);

function e(string $texto): string 
{
    return htmlspecialchars($texto, ENT_QUOTES | ENT_HTML5, 'UTF-8');
}

$busca = $_GET['q'] ?? '';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Busca de Produtos</title>
</head>
<body>
    <h1>Busca Industrial de Produtos</h1>

    <form method="GET">
        <!-- O ENT_QUOTES garante que as aspas duplas de "><script> sejam transformadas em &quot; impossibilitando fechar o atributo value precocemente -->
        <input type="text" name="q" value="<?= e($busca) ?>" placeholder="Digite o produto...">
        <button type="submit">Pesquisar</button>
    </form>

    <?php if ($busca !== ''): ?>
        <p>Você buscou por: <strong><?= e($busca) ?></strong></p>
    <?php endif; ?>
</body>
</html>
