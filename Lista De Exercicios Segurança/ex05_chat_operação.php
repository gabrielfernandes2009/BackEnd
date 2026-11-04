<?php
declare(strict_types=1);

function e(string $texto): string 
{
    return htmlspecialchars($texto, ENT_QUOTES | ENT_HTML5, 'UTF-8');
}

function salvarChat(array $mensagens, string $arquivo): void 
{
    file_put_contents($arquivo, json_encode($mensagens, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

function carregarChat(string $arquivo): array 
{
    if (!file_exists($arquivo)) {
        return [];
    }
    return json_decode(file_get_contents($arquivo), true) ?? [];
}

$arquivoJson = 'chat.json';
$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $msgInput = trim($_POST['mensagem'] ?? '');

    if (mb_strlen($msgInput) > 250) {
        $erro = "Erro: A mensagem excede o limite estrito de 250 caracteres.";
    } elseif ($msgInput === '') {
        $erro = "Erro: Mensagem vazia.";
    } else {
        $historico = carregarChat($arquivoJson);
        $historico[] = [
            'texto' => $msgInput,
            'horario' => date('H:i:s')
        ];
        salvarChat($historico, $arquivoJson);
    }
}

$mensagens = carregarChat($arquivoJson);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Chat Operação</title>
</head>
<body>
    <h1>Chat de Operação Industrial</h1>

    <?php if ($erro): ?>
        <div style="color: red;"><?= e($erro) ?></div>
    <?php endif; ?>

    <form method="POST">
        <textarea name="mensagem" placeholder="Digite uma instrução (máx 250 caracteres)..." style="width:300px; height:80px;"></textarea><br>
        <button type="submit">Enviar ao Supervisor</button>
    </form>

    <h2>Histórico da Linha de Produção</h2>
    <div style="background: #f4f4f4; padding: 10px; max-width: 400px;">
        <?php foreach ($mensagens as $msg): ?>
            <p>
                <small>[<?= e($msg['horario']) ?>]</small> 
                
                <!-- DESAFIO DE ORDEM DE EXECUÇÃO:
                     Fazer e(nl2br($mensagem)) seria um erro GRAVÍSSIMO porque o nl2br() introduz tags HTML literais 
                     como "<br>" ou "<br />" na string. Se passarmos o retorno do nl2br() para dentro da função e(), 
                     o htmlspecialchars() irá converter os caracteres "<" e ">" gerados pelo próprio PHP em "&lt;" e "&gt;".
                     Como consequência, as quebras de linha seriam renderizadas na tela do usuário textualmente como a string 
                     "<br />" ao invés de quebrarem a linha de fato, destruindo o layout e falhando na missão do design.
                     Portanto, a ordem correta e imutável é nl2br(e($mensagem)). -->
                     
                <?= nl2br(e($msg['texto'])) ?>
            </p>
            <hr>
        <?php endforeach; ?>
    </div>
</body>
</html>
