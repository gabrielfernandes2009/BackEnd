
<?php
// Função de escapamento universal contra XSS em contextos HTML normais.
function e(string $texto): string 
{
    return htmlspecialchars($texto, ENT_QUOTES | ENT_HTML5, 'UTF-8');
}

// Salva as mensagens no arquivo JSON.
function salvarMensagens(array $mensagens, string $arquivo): void 
{
    file_put_contents($arquivo, json_encode($mensagens, JSON_PRETTY_PRINT));
}

// Carrega as mensagens do arquivo JSON.
function carregarMensagens(string $arquivo): array 
{
    if (!file_exists($arquivo)) {
        return [];
    }
    $conteudo = file_get_contents($arquivo);
    return json_decode($conteudo, true) ?? [];
}

$arquivoJson = 'mural.json';
$erros = [];
$sucesso = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $mensagem = trim($_POST['mensagem'] ?? '');

    if (mb_strlen($nome) < 3) {
        $erros[] = "O nome deve ter no mínimo 3 caracteres.";
    }
    if (mb_strlen($mensagem) < 5) {
        $erros[] = "A mensagem deve ter no mínimo 5 caracteres.";
    }

    if (empty($erros)) {
        $mensagens = carregarMensagens($arquivoJson);
        $mensagens[] = [
            'nome' => $nome,
            'mensagem' => $mensagem,
            'data' => date('d/M/Y H:i')
        ];
        salvarMensagens($mensagens, $arquivoJson);
        $sucesso = "Recado publicado com sucesso!";
    }
}

$historico = carregarMensagens($arquivoJson);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Mural de Recados</title>
</head>
<body>
    <h1>Mural de Recados Blindado</h1>

    <?php if (!empty($erros)): ?>
        <div style="color: red;"><?= implode('<br>', array_map('e', $erros)) ?></div>
    <?php endif; ?>

    <?php if ($sucesso): ?>
        <div style="color: green;"><?= e($sucesso) ?></div>
    <?php endif; ?>

    <form method="POST">
        <p>
            <label>Nome: <br> <input type="text" name="nome"></label>
        </p>
        <p>
            <label>Mensagem: <br> <textarea name="mensagem"></textarea></label>
        </p>
        <button type="submit">Enviar Recado</button>
    </form>

    <h2>Recados Recentes</h2>
    <?php foreach ($historico as $recado): ?>
        <div style="border: 1px solid #ccc; margin-bottom: 10px; padding: 10px;">
            <strong><?= e($recado['nome']) ?></strong> (<?= e($recado['data']) ?>) falou:<br>
            <!-- nl2br aplicado APÓS o escape para garantir que os <br> gerados não sejam escapados -->
            <p><?= nl2br(e($recado['mensagem'])) ?></p>
        </div>
    <?php endforeach; ?>
</body>
</html>
