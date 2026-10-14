<?php
declare(strict_types=1);

$carrinho = [
    ["produto" => "Notebook", "preco" => 4000.00],
    ["produto" => "Mouse", "preco" => 150.00],
    ["produto" => "Teclado", "preco" => 300.00],
];

$carrinhoBlackFriday = array_map(function (array $item): array {
    $item["preco"] *= 0.80;
    return $item;
}, $carrinho);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Black Friday</title>
</head>
<body>
    <h1>Preços de Black Friday</h1>
    <ul>
        <?php foreach ($carrinhoBlackFriday as $item): ?>
            <li>
                <?= htmlspecialchars($item["produto"], ENT_QUOTES, "UTF-8") ?>:
                R$ <?= number_format($item["preco"], 2, ",", ".") ?>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
