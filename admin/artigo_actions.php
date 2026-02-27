<?php

$arquivo = __DIR__ . '/../content/artigos_content.php';

function carregarArtigos($arquivo) {
    include $arquivo;
    return $artigos ?? [];
}

function salvarArtigos($arquivo, $artigos) {
    $conteudo = "<?php\n\$artigos = " . var_export($artigos, true) . ";\n";

    file_put_contents($arquivo, $conteudo);

    clearstatcache();

    if (function_exists('opcache_invalidate')) {
        opcache_invalidate($arquivo, true);
    }
}

/* ============================= */
/* CREATE OU UPDATE */
/* ============================= */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $artigos = carregarArtigos($arquivo);

    $view      = $_POST['view'] ?? null;
    $titulo    = $_POST['titulo'];
    $resumo    = $_POST['resumo'];
    $conteudo  = $_POST['conteudo'];
    $autor     = $_POST['autor'];
    $principal = isset($_POST['principal']);

    // ============================
    // Upload de banner
    // ============================
    $bannerPath = null;
    if (isset($_FILES['banner']) && $_FILES['banner']['error'] === UPLOAD_ERR_OK) {
        $tmpName = $_FILES['banner']['tmp_name'];
        $ext = pathinfo($_FILES['banner']['name'], PATHINFO_EXTENSION);
        $nomeArquivo = uniqid('banner_') . '.' . $ext;
        $uploadDir = realpath(__DIR__ . '/../assets/images') . '/';

        if (!empty($_FILES['banner']['name'])) {
            $nomeArquivo = basename($_FILES['banner']['name']);
            $tmpName     = $_FILES['banner']['tmp_name'];

            $destino = $uploadDir . $nomeArquivo;

            if (move_uploaded_file($tmpName, $destino)) {
                $bannerPath = 'assets/images/' . $nomeArquivo;
            }
        }
        $destino = $uploadDir . $nomeArquivo;

        if (move_uploaded_file($tmpName, $destino)) {
            $bannerPath = 'assets/images/' . $nomeArquivo;
        }
    }

    if ($principal) {
        foreach ($artigos as &$a) {
            $a['principal'] = false;
        }
    }

    if ($view) {
        // UPDATE
        foreach ($artigos as &$a) {
            if ($a['view'] == $view) {
                $a['titulo'] = $titulo;
                $a['resumo'] = $resumo;
                $a['conteudo'] = $conteudo;
                $a['autor'] = $autor;
                $a['principal'] = $principal;
                if ($bannerPath) {
                    $a['banner'] = $bannerPath;
                }
                break;
            }
        }
    } else {
        // CREATE
        $novoView = count($artigos) > 0
            ? max(array_column($artigos, 'view')) + 1
            : 1;

        $artigos[] = [
            'view' => $novoView,
            'principal' => $principal,
            'titulo' => $titulo,
            'banner' => $bannerPath ?? 'assets/images/padrao.jpg',
            'resumo' => $resumo,
            'conteudo' => $conteudo,
            'autor' => $autor
        ];
    }

    salvarArtigos($arquivo, $artigos);
    header("Location: artigos_admin.php");
    exit;
}

/* ============================= */
/* DELETE */
/* ============================= */
if (isset($_GET['delete'])) {

    $artigos = carregarArtigos($arquivo);
    $deleteView = $_GET['delete'];

    $eraPrincipal = false;
    foreach ($artigos as $a) {
        if ($a['view'] == $deleteView && $a['principal']) {
            $eraPrincipal = true;
            break;
        }
    }

    $artigos = array_filter($artigos, fn($a) => $a['view'] != $deleteView);

    if ($eraPrincipal && count($artigos) > 0) {
        $primeiroKey = array_key_first($artigos);
        $artigos[$primeiroKey]['principal'] = true;
    }

    salvarArtigos($arquivo, $artigos);

    header("Location: artigos_admin.php");
    exit;
}