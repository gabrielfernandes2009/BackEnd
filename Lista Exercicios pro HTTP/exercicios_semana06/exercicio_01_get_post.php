<?php
// 1. Catálogo mockado com 6 produtos
$catalogo = [
    ['nome' => 'Notebook Gamer', 'categoria' => 'Eletrônicos', 'preco' => 4500.00],
    ['nome' => 'Smartphone 5G', 'categoria' => 'Eletrônicos', 'preco' => 2500.00],
    ['nome' => 'Fone de Ouvido Bluetooth', 'categoria' => 'Acessórios', 'preco' => 299.90],
    ['nome' => 'Teclado Mecânico', 'categoria' => 'Acessórios', 'preco' => 450.00],
    ['nome' => 'Cadeira Ergonômica', 'categoria' => 'Móveis', 'preco' => 1200.00],
    ['nome' => 'Mesa Escritório', 'categoria' => 'Móveis', 'preco' => 850.00],
];

// 2. Captura dos filtros via GET (com sanitização básica)
$filtro_nome = isset($_GET['nome']) ? trim($_GET['nome']) : '';
$filtro_preco = isset($_GET['preco_maximo']) && $_GET['preco_maximo'] !== '' ? (float)$_GET['preco_maximo'] : null;

// 3. Filtragem utilizando array_filter
$produtos_exibidos = array_filter($catalogo, function($produto) use ($filtro_nome, $filtro_preco) {
    // Se o filtro de nome foi preenchido, verifica se o nome do produto contém o termo (case-insensitive)
    if ($filtro_nome !== '' && mb_stripos($produto['nome'], $filtro_nome) === false) {
        return false;
    }
    // Se o filtro de preço máximo foi preenchido, verifica se o preço é menor ou igual
    if ($filtro_preco !== null && $produto['preco'] > $filtro_preco) {
        return false;
    }
    return true;
});
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Busca de Produtos</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        form { margin-bottom: 20px; padding: 15px; border: 1px solid #ccc; border-radius: 5px; max-width: 400px; }
        .campo { margin-bottom: 10px; }
        label { display: block; font-weight: bold; }
        input[type="text"], input[type="number"] { width: 100%; padding: 5px; box-sizing: border-box; }
        table { border-collapse: collapse; width: 100%; max-width: 600px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .no-results { color: red; font-style: italic; }
    </style>
</head>
<body>

    <h2>Filtro de Produtos</h2>
    
    <!-- Formulário HTML com método GET -->
    <form action="ex01_busca_produtos.php" method="GET">
        <div class="campo">
            <label for="nome">Nome do Produto:</label>
            <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($filtro_nome); ?>">
        </div>
        <div class="campo">
            <label for="preco_maximo">Preço Máximo (R$):</label>
            <input type="number" id="preco_maximo" name="preco_maximo" step="0.01" value="<?php echo $filtro_preco !== null ? $filtro_preco : ''; ?>">
        </div>
        <button type="submit">Filtrar</button>
        <a href="ex01_busca_produtos.php">Limpar Filtros</a>
    </form>

    <h2>Resultados</h2>
    <?php if (!empty($produtos_exibidos)): ?>
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Categoria</th>
                    <th>Preço</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produtos_exibidos as $produto): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($produto['nome']); ?></td>
                        <td><?php echo htmlspecialchars($produto['categoria']); ?></td>
                        <td>R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="no-results">Nenhum produto encontrado para os filtros aplicados.</p>
    <?php endif; ?>

</body>
</html>
