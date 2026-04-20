<?php

$slug = $_GET['pastoral'] ?? null;

include __DIR__ . '/content/pastorais_content.php';

$pastoralAtual = $pastoraisConteudo[$slug] ?? null;

?>
<!DOCTYPE html>
<html lang="pt-BR">

<?php $pageTitle = $pastoralAtual['titulo'] ?? 'Pastorais'; ?>
<?php include __DIR__ . '/partials/head.php'; ?>

<>

<header>
    <?php include __DIR__ . '/partials/nav.php'; ?>
</header>

<main class="container my-5">

<?php if ($pastoralAtual): ?>

    <div class="title-banner text-center mb-4">
        <img src="<?= $pastoralAtual['banner'] ?>" class="banner-img">
        <h1><?= $pastoralAtual['titulo'] ?></h1>
    </div>

    <div class="artigo-conteudo">
        <?= $pastoralAtual['conteudo'] ?>
    </div>

    <p class="text-end mt-4">
        <em><?= $pastoralAtual['responsavel'] ?></em>
    </p>

<?php else: ?>

    <div class="text-center">
        <h1><?= ucwords(str_replace('-', ' ', $slug)) ?></h1>

        <div class="alert alert-info mt-4">
            Esta pastoral ainda está em desenvolvimento.
        </div>
    </div>

<?php endif; ?>

</main>

<?php include __DIR__ . '/partials/footer.php'; ?>

<script src="assets/js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>