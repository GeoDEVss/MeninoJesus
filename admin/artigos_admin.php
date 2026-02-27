<?php
session_start();

// Se não estiver logado, redireciona para o login
if (empty($_SESSION['logado'])) {
    header("Location: login.php");
    exit;
}

include 'artigo_actions.php';
$artigos = carregarArtigos(__DIR__ . '/../content/artigos_content.php');

// Ordena: principal primeiro, depois os demais por view decrescente
usort($artigos, function($a, $b) {
    if ($a['principal'] && !$b['principal']) return -1;
    if (!$a['principal'] && $b['principal']) return 1;
    return $b['view'] <=> $a['view']; // mais recente primeiro
});
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Admin - Artigos</title>
    <link href="/assets/css/admin.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body>
<div class="container my-4">

    <nav class="navbar navbar-expand-lg navbar-light bg-light rounded mb-4">
        <div class="container-fluid d-flex align-items-center">
            <a class="navbar-brand" href="#">Admin</a>
            <div class="d-flex align-items-center ms-auto gap-2">
                <a href="logout.php" class="btn btn-danger">Sair</a>
            </div>
        </div>
    </nav>

    <div class="mb-3 d-flex justify-content-between align-items-center">
        <a href="/artigos_lista.php" class="btn btn-secondary">
            <i class="bi bi-arrow-left-short me-1"></i> Artigos
        </a>
        <a href="artigo_form.php" class="btn btn-primary">
            + Novo Artigo
        </a>
    </div>

    <h2 class="mt-5 mb-5">Lista de Artigos</h2>

    <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle">
            <thead class="table-dark">
            <tr>
                <th class="text-center">ID</th>
                <th class="text-center">Banner</th>
                <th class="text-center">Título</th>
                <th class="text-center">Principal</th>
                <th class="text-center">Ações</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($artigos as $a): ?>
                <tr class="<?= $a['principal'] ? 'table-warning fw-bold text-center' : '' ?>">
                    <td class="text-center"><?= $a['view'] ?></td>
                    <td class="text-center">
                        <?php if (!empty($a['banner'])): ?>
                            <!-- Link para o site público, usando artigo= -->
                            <a href="/artigos.php?artigo=<?= $a['view'] ?>" target="_blank">
                                <img src="/<?= $a['banner'] ?>" class="banner-thumb w-100" alt="Banner <?= $a['titulo'] ?>">
                            </a>
                        <?php endif; ?>
                    </td>
                    <td class="text-center"><?= $a['titulo'] ?></td>
                    <td class="text-center"><?= $a['principal'] ? 'Sim' : 'Não' ?></td>
                    <td class="text-center">
                        <a href="artigo_form.php?edit=<?= $a['view'] ?>" class="btn btn-sm btn-info text-white">
                            Editar
                        </a>
                        <a href="artigo_actions.php?delete=<?= $a['view'] ?>"
                           class="btn btn-sm btn-danger"
                           onclick="return confirm('Deseja excluir este artigo?');">
                            Excluir
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>
<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>