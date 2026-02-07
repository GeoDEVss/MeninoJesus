<?php
if (!isset($_GET['view'])) {
  header('Location: artigos_lista.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<?php $pageTitle = 'Artigos e Formações'; ?>
<?php include __DIR__ .  '/partials/head.php'; ?>

<body>

  <header>
    <?php include __DIR__ .  '/partials/nav.php'; ?>
  </header>

  <?php include __DIR__ .  '/content/artigos_content.php'; ?>

  <main class="container my-5">

    <?php
    $view = $_GET['view'] ?? null;
    $artigoAtual = null;

    foreach ($artigos as $artigo) {
      if ($artigo['view'] == $view) {
        $artigoAtual = $artigo;
        break;
      }
    }
    ?>

    <?php if ($artigoAtual): ?>

      <div class="title-banner text-center mb-4">
        <img src="<?= $artigoAtual['banner'] ?>" alt="Banner do artigo" class="banner-img">
        <h1><?= $artigoAtual['titulo'] ?></h1>
      </div>

      <?= $artigoAtual['conteudo'] ?>

      <p class="text-end">
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