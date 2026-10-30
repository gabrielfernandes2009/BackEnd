<?php
// 1. Inicialização de variáveis para o Sticky Form e mensagens
$email = $_POST['email'] ?? '';
$erro = null;
$sucesso = false;

// 2. Processamento do formulário POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $senha = $_POST['senha'] ?? '';

    // Validações Server-Side exigidas
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = "Por favor, insira um e-mail válido.";
    } elseif (strlen($senha) < 6) {
        $erro = "A senha deve ter no mínimo 6 caracteres.";
    } else {
        // Dados fictícios para comparação rápida
        $email_correto = 'admin@senai.br';
        $senha_correta = 'senhaSegura123';

        if ($email === $email_correto && $senha === $senha_correta) {
            $sucesso = true;
        } else {
            $erro = "Credenciais inválidas.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Painel de Autenticação</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f6f9; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .card { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); width: 100%; max-width: 360px; }
        h2 { margin-top: 0; color: #333; text-align: center; }
        .campo { margin-bottom: 15px; }
        label { display: block; font-weight: bold; margin-bottom: 5px; color: #555; }
        input[type="text"], input[type="password"] { width: 100%; padding: 10px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        button { background: #28a745; color: white; border: none; padding: 12px; border-radius: 4px; cursor: pointer; width: 100%; font-size: 16px; font-weight: bold; }
        .alert { padding: 12px; border-radius: 4px; margin-bottom: 15px; font-size: 14px; text-align: center; }
        .alert-danger { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
    </style>
</head>
<body>

<div class="card">
    <?php if ($sucesso): ?>
        <!-- Card de Boas-vindas -->
        <div class="alert alert-success">
            <h3>Bem-vindo, Administrador!</h3>
            <p>Login realizado com sucesso no painel do SENAI.</p>
        </div>
        <p style="text-align: center;"><a href="ex03_login_seguro.php">Sair / Voltar</a></p>
    <?php else: ?>
        <h2>Login Seguro</h2>

        <?php if ($erro): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
        <?php endif; ?>

        <!-- Formulário mantém o e-mail (Sticky), mas limpa a senha por segurança -->
        <form action="ex03_login_seguro.php" method="POST">
            <div class="campo">
                <label for="email">E-mail:</label>
                <input type="text" id="email" name="email" value="<?= htmlspecialchars($email) ?>" placeholder="seu@email.com" required>
            </div>
            <div class="campo">
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>
            </div>
            <button type="submit">Entrar</button>
        </form>
    <?php endif; ?>
</div>

</body>
</html>

