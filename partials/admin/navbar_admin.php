<?php
// navbar_admin.php
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light rounded mb-4">
    <div class="container-fluid d-flex align-items-center">
        <a class="navbar-brand" href="#">Admin</a>
        <div class="d-flex align-items-center ms-auto gap-2">
            <span class="me-2">Olá, <?= $_SESSION['usuario'] ?? 'Usuário' ?></span>
            <a href="logout.php" class="btn btn-danger">Sair</a>
        </div>
    </div>
</nav>