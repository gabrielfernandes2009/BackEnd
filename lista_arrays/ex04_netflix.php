<?php
declare(strict_types=1);

$filmes = [
    ["titulo" => "Matrix", "genero" => "Ficção", "classificacao_idade" => 16],
    ["titulo" => "Shrek", "genero" => "Animação", "classificacao_idade" => 0],
    ["titulo" => "Deadpool", "genero" => "Ação", "classificacao_idade" => 18],
    ["titulo" => "Procurando Nemo", "genero" => "Animação", "classificacao_idade" => 0],
    ["titulo" => "Vingadores", "genero" => "Ação", "classificacao_idade" => 12],
];

$filmesInfantis = array_filter(
    $filmes,
    fn($filme) => $filme["classificacao_idade"] <= 12
);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Catálogo infantil</title>
</head>
<body>
    <h1>Filmes adequados para crianças</h1>
    <ul>
        <?php foreach ($filmesInfantis as $filme): ?>
            <li>
                <?= htmlspecialchars($filme["titulo"], ENT_QUOTES, "UTF-8") ?>
                (<?= htmlspecialchars($filme["genero"], ENT_QUOTES, "UTF-8") ?>,
                classificação <?= $filme["classificacao_idade"] ?>)
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>    