<?php 
declare(strict_types=1);

// 1. O Banco de Dados Fictício (Array Multidimensional)
$produtos = [
    ['id' => 1, 'nome' => 'iPhone 15', 'categoria' => 'Smartphone', 'preco' => 6500.00],
    ['id' => 2, 'nome' => 'Galaxy S24', 'categoria' => 'Smartphone', 'preco' => 5400.00],
    ['id' => 3, 'nome' => 'MacBook Air', 'categoria' => 'Notebook', 'preco' => 8900.00],
    ['id' => 4, 'nome' => 'Monitor Dell 27', 'categoria' => 'Perifericos', 'preco' => 1200.00],
    ['id' => 5, 'nome' => 'Mouse Logitech', 'categoria' => 'Perifericos', 'preco' => 450.00],
];

// ==========================================
// MISSÃO 1: Crie o filtro para isolar APENAS os Smartphones
// ==========================================
$smartphones = array_filter($produtos, fn($p) => $p['categoria'] === 'Smartphone'
);

// ==========================================
// MISSÃO 2: Aplique 15% de desconto nos Smartphones
// ==========================================
$smartphonesComDesconto = array_map(function($p) {
    $p['preco'] = $p['preco'] * 0.85; // 15% de desconto 
    return $p;
}, $smartphones);

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Vitrine TechSenai</title>
    <style>
        body { font-family: Arial; padding: 20px; background-color: #f1f2f6; }
        .card { background: white; border-radius: 8px; padding: 15px; margin-bottom: 10px; width: 250px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); display: inline-block; margin-right: 15px;}
        .preco { color: #27ae60; font-size: 1.4em; font-weight: bold; }
        .categoria { font-size: 0.8em; color: #7f8c8d; text-transform: uppercase; letter-spacing: 1px;}
    </style>
</head>
<body>
    <h2>Ofertas Especiais: Smartphones (15% OFF)</h2>
    
    <!-- MISSÃO 3: Crie o Laço FOREACH aqui e percorra a lista $smartphonesComDesconto -->
    <?php foreach($smartphonesComDesconto as $produto): ?>

        <div class="card">
            <span class="categoria"> 
            <?= $produto['categoria'] ?> 
            </span>

            <h3><?= $produto ['nome'] ?></h3>
            <p class="preco">
            R$ <?=   number_format($produto['preco'], 2,',', '.') ?>
            </p>
        </div>

    <?php endforeach; ?>


    <hr>
    <!-- Área de Socorro (Debug) -->
    <h3>Ferramenta de Debug (Tudo que tem na memória):</h3>
    <pre>
        <?php 
            // Tire o comentário da linha abaixo para ver a mágica se precisar de ajuda
            // print_r($smartphonesComDesconto); 
        ?>
    </pre>

</body>
</html>
