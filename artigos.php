<?php
// Pega o ID do artigo via parâmetro "artigo"
$artigoId = $_GET['artigo'] ?? null;

// Se não tiver parâmetro, volta para a lista
if (!$artigoId) {
    header('Location: artigos_lista.php');
    exit;
}

// Inclui os artigos
include __DIR__ . '/content/artigos_content.php';

// Procura o artigo atual pelo ID
$artigoAtual = null;
foreach ($artigos as $artigo) {
    if ($artigo['view'] == $artigoId) { // compara com o ID interno "view"
        $artigoAtual = $artigo;
        break;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<?php $pageTitle = $artigoAtual['titulo'] ?? 'Artigos e Formações'; ?>
<?php include __DIR__ . '/partials/head.php'; ?>

<body>

<header>
    <?php include __DIR__ . '/partials/nav.php'; ?>
</header>

<main class="container my-5">

    <?php if ($artigoAtual): ?>
        <!-- Banner e título -->
        <div class="title-banner text-center mb-4">
            <img src="<?= $artigoAtual['banner'] ?>" alt="Banner do artigo" class="banner-img">
            <h1><?= $artigoAtual['titulo'] ?></h1>
        </div>

        <!-- Conteúdo -->
        <div class="artigo-conteudo">
            <?= $artigoAtual['conteudo'] ?>
        </div>

        <!-- Autor -->
        <p class="text-end mt-4">
            <em>Texto desenvolvido por <?= $artigoAtual['autor'] ?>.</em>
        </p>

    <?php else: ?>
        <div class="alert alert-warning text-center">
            Artigo não encontrado.
        </div>
    <?php endif; ?>

</main>

<?php include __DIR__ . '/partials/footer.php'; ?>

<script src="assets/js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>