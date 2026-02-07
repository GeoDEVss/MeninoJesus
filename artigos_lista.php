<!DOCTYPE html>
<html lang="pt-BR">

<?php $pageTitle = 'Artigos'; ?>
<?php include __DIR__ . '/partials/head.php'; ?>

<body>

    <header>
        <?php include __DIR__ . '/partials/nav.php'; ?>
    </header>

    <?php include __DIR__ . '/content/artigos_content.php'; ?>

    <main class="container my-5 px-4 px-lg-5">

        <?php
        // separa o post principal
        $principal = array_filter($artigos, fn($a) => !empty($a['principal']));
        $secundarios = array_filter($artigos, fn($a) => empty($a['principal']));
        ?>

        <!-- POST PRINCIPAL -->
        <?php if (!empty($principal)):
            $post = array_values($principal)[0];
        ?>
            <div class="row mb-5">
                <div class="col-12">
                    <div class="card shadow destaque-card">
                        <img src="<?= $post['banner'] ?>" class="card-img-top destaque-img" alt="">
                        <div class="destaque-overlay">
                            <h2 class="destaque-titulo"><?= $post['titulo'] ?></h2>
                            <p class="destaque-resumo"><?= $post['resumo'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- DEMAIS ARTIGOS -->
        <div class="row g-5">
            <?php foreach ($secundarios as $artigo): ?>
                <div class="col-12 col-md-6 col-lg-4">

                    <!-- Card Desktop (clássico) -->
                    <div class="card h-100 d-none d-lg-flex flex-column">
                        <img src="<?= $artigo['banner'] ?>" class="card-secondary-image" alt="">
                        <div class="card-body d-flex flex-column flex-grow-1">
                            <h5 class="card-title"><?= $artigo['titulo'] ?></h5>
                            <p class="card-text"><?= $artigo['resumo'] ?></p>
                            <a href="/artigos.php?view=<?= $artigo['view'] ?>" class="btn btn-artigo-page mt-auto">
                                Ler mais
                            </a>
                        </div>
                    </div>

                    <!-- Card Mobile (hero style) -->
                    <div class="destaque-card d-flex d-lg-none">
                        <img src="<?= $artigo['banner'] ?>" class="destaque-img" alt="">
                        <div class="destaque-overlay">
                            <h5 class="destaque-titulo"><?= $artigo['titulo'] ?></h5>
                            <p class="destaque-resumo"><?= $artigo['resumo'] ?></p>
                        </div>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>


    </main>

    <?php include __DIR__ . '/partials/footer.php'; ?>

    <script src="assets/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>