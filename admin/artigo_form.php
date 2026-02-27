<?php
session_start();
if (empty($_SESSION['logado'])) {
    header("Location: login.php");
    exit;
}

include 'artigo_actions.php';
$artigos = carregarArtigos(__DIR__ . '/../content/artigos_content.php');

$artigoEditando = null;
if (isset($_GET['edit'])) {
    foreach ($artigos as $a) {
        if ($a['view'] == $_GET['edit']) {
            $artigoEditando = $a;
            break;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php $pageTitle = $artigoEditando ? 'Editar Artigo' : 'Novo Artigo'; ?>
    <?php include __DIR__ . '/../partials/admin/head_admin.php'; ?>
</head>
<body>
<div class="container my-4">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light rounded mb-4">
        <div class="container-fluid d-flex align-items-center">
            <a class="navbar-brand" href="#">Admin</a>
            <div class="d-flex align-items-center ms-auto gap-2">
                <span class="me-3">Olá, <?= $_SESSION['usuario'] ?? 'Usuário' ?></span>
                <a href="logout.php" class="btn btn-danger">Sair</a>
            </div>
        </div>
    </nav>

    <!-- Botões de navegação -->
    <div class="mb-3 d-flex gap-2">
        <a href="/admin/artigos_admin.php" class="btn btn-secondary">
            <i class="bi bi-arrow-left-short me-1"></i> Voltar
        </a>
        <a href="/artigos_lista.php" class="btn btn-secondary">
            <i class="bi bi-arrow-left-short me-1"></i> Artigos</a>
    </div>

    <h2 class="mb-4"><?= $artigoEditando ? 'Editar Artigo' : 'Novo Artigo' ?></h2>

    <form action="artigo_actions.php" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
        <?php if ($artigoEditando): ?>
            <input type="hidden" name="view" value="<?= $artigoEditando['view'] ?>">
        <?php endif; ?>

        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo"
                   value="<?= $artigoEditando['titulo'] ?? '' ?>" required>
        </div>

        <div class="mb-3">
            <label for="resumo" class="form-label">Resumo</label>
            <textarea class="form-control" id="resumo" name="resumo" rows="3"><?= $artigoEditando['resumo'] ?? '' ?></textarea>
        </div>

        <div class="mb-3">
            <label for="conteudo" class="form-label">Conteúdo</label>
            <textarea class="form-control" id="conteudo" name="conteudo" rows="10"><?= $artigoEditando['conteudo'] ?? '' ?></textarea>
        </div>

        <!-- CKEditor 5 -->
        <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
        <script>
            // Inicializa CKEditor depois do DOM estar carregado
            document.addEventListener("DOMContentLoaded", function() {
                ClassicEditor
                    .create(document.querySelector('#conteudo'))
                    .catch(error => { console.error(error); });
            });
        </script>

        <div class="mb-3">
            <label for="autor" class="form-label">Autor</label>
            <input type="text" class="form-control" id="autor" name="autor"
                   value="<?= $artigoEditando['autor'] ?? '' ?>">
        </div>

        <!-- Banner -->
        <div class="mb-3">
            <label for="banner" class="form-label">Banner</label>
            <input type="file" class="form-control" id="banner" name="banner" accept="image/*">
            <?php if (!empty($artigoEditando['banner'])): ?>
                <img src="/<?= $artigoEditando['banner'] ?>" alt="Banner atual" class="banner-preview" id="bannerPreview">
            <?php else: ?>
                <img src="" alt="Prévia do banner" class="banner-preview d-none" id="bannerPreview">
            <?php endif; ?>
        </div>

        <!-- Checkbox principal -->
        <div class="form-check mb-3">
            <input type="checkbox" class="form-check-input" id="principal" name="principal"
                    <?= (!empty($artigoEditando['principal'])) ? 'checked' : '' ?>>
            <label class="form-check-label" for="principal">Artigo principal</label>
        </div>

        <button type="submit" class="btn btn-success">
            <?= $artigoEditando ? 'Atualizar' : 'Salvar' ?>
        </button>
    </form>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Validação básica de formulário Bootstrap 5
    (function () {
        'use strict'
        const forms = document.querySelectorAll('.needs-validation')
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
    })()

    // Preview do banner
    const bannerInput = document.getElementById('banner');
    const bannerPreview = document.getElementById('bannerPreview');

    bannerInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                bannerPreview.src = e.target.result;
                bannerPreview.classList.remove('d-none');
            }
            reader.readAsDataURL(file);
        }
    });
</script>
</body>
</html>