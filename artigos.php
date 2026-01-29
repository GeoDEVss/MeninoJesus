<!DOCTYPE html>
<html lang="pt-BR">

<?php $pageTitle = 'Artigos e Formações'; ?>
<?php include __DIR__ .  '/partials/head.php'; ?>

<body>

  <header>
    <?php include __DIR__ .  '/partials/nav.php'; ?>
  </header>

  <?php include __DIR__ .  '/content/artigos.php'; ?>

  <main class="container my-5">
    <?php foreach ($artigos as $artigo): ?>
      <div class="title-banner text-center mb-4">
        <img src="<?= $artigo['banner'] ?>" alt="Banner do artigo" class="banner-img">
        <h1><?= $artigo['titulo'] ?></h1>
      </div>
      <?= $artigo['conteudo'] ?>
      <p class="text-end"><em>Texto elaborado por <?= $artigo['autor'] ?>.</em></p>
    <?php endforeach; ?>
  </main>

  <?php include __DIR__ . '/partials/footer.php'; ?>

  <script src="assets/js/script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>