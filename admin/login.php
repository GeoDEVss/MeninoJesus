<?php
session_start();

include __DIR__ . '/../config/env.php';

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'] ?? '';
    $senha   = $_POST['senha'] ?? '';

    // Verifica usuário e senha do arquivo env.php
    if ($usuario === ENV_USUARIO && $senha === ENV_SENHA) {
        $_SESSION['logado'] = true;
        $_SESSION['usuario'] = $usuario;
        header("Location: artigos_admin.php");
        exit;
    } else {
        $erro = "Usuário ou senha incorretos";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow p-4" style="max-width: 400px; width: 100%;">
        <h3 class="text-center mb-4">Login Admin</h3>

        <?php if (!empty($erro)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label for="usuario" class="form-label">Usuário</label>
                <input type="text" class="form-control" id="usuario" name="usuario" required>
            </div>
            <div class="mb-3">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" class="form-control" id="senha" name="senha" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Entrar</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>