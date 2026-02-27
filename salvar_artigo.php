    <?php

include 'content/artigos_content.php';

$titulo    = $_POST['titulo'];
$resumo    = $_POST['resumo'];
$conteudo  = $_POST['conteudo'];
$autor     = $_POST['autor'];
$principal = isset($_POST['principal']);

$novoView = count($artigos) + 1;

$artigos[] = [
    'view' => $novoView,
    'principal' => $principal,
    'titulo' => $titulo,
    'banner' => 'assets/images/padrao.jpg',
    'resumo' => $resumo,
    'conteudo' => $conteudo,
    'autor' => $autor
];

/* Recria o conteúdo do arquivo */
$conteudoArquivo = "<?php\n\$artigos = " . var_export($artigos, true) . ";\n";

/* Salva no arquivo */
file_put_contents('content/artigos_content.php', $conteudoArquivo);

header("Location: admin_artigo.php?sucesso=1");
exit;