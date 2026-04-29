<?php include 'pastorais.php'; ?>

<nav class="navbar navbar-expand-lg bg-white py-3 shadow-sm navbar-light">
  <div class="container-fluid">
    <div class="nav-left">
      <img src="assets/images/listras.png" alt="Listras esquerda" class="nav-stripe" />
      <img src="assets/images/logo.JPG" alt="Logo da comunidade" class="nav-logo" />
    </div>
    <div class="ms-3">
      <span class="navbar-title d-lg-none ms-5 text-center fw-bold">
        Menino Jeus de Praga
      </span>
    </div>

    <button
      class="navbar-toggler ms-auto"
      type="button"
      data-bs-toggle="collapse"
      data-bs-target="#navbarMain"
      aria-controls="navbarMain"
      aria-expanded="false"
      aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div
      class="collapse navbar-collapse justify-content-center"
      id="navbarMain">
      <ul class="navbar-nav gap-lg-4">
        <li class="nav-item">
          <a class="nav-link fw-semibold" href="/">Início</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fw-semibold" href="artigos_lista.php">Artigos e Formações</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fw-semibold" href="#">Horários</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fw-semibold" href="#">Histórias</a>
        </li>
          <li class="nav-item dropdown position-static">
            <a class="nav-link fw-semibold dropdown-toggle" href="#" id="pastoraisDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Pastorais e Movimentos
            </a>
            <?php
              function gerarSlug($texto) {
                  return strtolower(str_replace(
                      [' ', 'ã', 'á', 'é', 'í', 'ó', 'ú', 'ç'],
                      ['-', 'a', 'a', 'e', 'i', 'o', 'u', 'c'],
                      $texto
                  ));
              }
              ?>
              <div class="dropdown-menu mega-menu p-4">
                <div class="row">

                  <?php foreach ($pastorais as $coluna): ?>
                    <div class="col-md-4">
                      <?php foreach ($coluna as $item): ?>
                        <a class="dropdown-item" href="/pastoral.php?pastoral=<?= gerarSlug($item) ?>">
                          <?= $item ?>
                        </a>
                      <?php endforeach; ?>
                    </div>
                  <?php endforeach; ?>
                </div>
              </div>
          </li>
      </ul>
    </div>
    <div class="nav-right d-none d-lg-flex">
      <img src="assets/images/listras.png" alt="Listras direita" class="nav-stripe" />
    </div>
  </div>
</nav>