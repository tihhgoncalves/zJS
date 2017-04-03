<?php


ini_set('error_log', dirname(__FILE__) . '/zJS_log.txt'); 

echo("\n\n\n");
echo("---------------------------------------------------------------\n");
echo("---------------    BEM VINDO AO zJS 1.0    --------------------\n");
echo("---------------------------------------------------------------\n");
echo("\n\n\n");

print_r($_GET);

$path = $_GET['path'];
//$path = str_replace('\\', '/', $path);
$in = $_GET['in'];
$out = $_GET['out'];
//$minimal = (!empty(@$_GET['minimal']));


echo("\n\n\n");
//die($path . '/' . $in);
$arquivo = fopen($path . '/' . $in, 'r');

$scripts = array();
while (!feof ($arquivo)) {
  $linha = fgets($arquivo);

  $linha = str_replace("\r", null, $linha);
  $linha = str_replace("\n", null, $linha);
  $scripts[] = $linha;
}

$unificado = null;
echo("\n\n\n");
foreach($scripts as $script){

  $code = fopen($path . '/' . $script, 'r');
  $code_str = null;
  while (!feof ($code)) {
    $code_str .= fgets($code);
  }

  $unificado .= $code_str . "\n";
}

//escreve unificado
//die($path . '/' . $out);
$arquivo_unificado = fopen($path . '/' . $out, 'w+');
//die('ENTROU no PHP');
fwrite($arquivo_unificado, $unificado);
fclose($arquivo_unificado);

//Copia o .min.hs (temporário)
copy($path . '/' . $out, $path . '/' . str_replace('.js', '.min.js', $out));

$jsfinal = $path . '/' . $out;
die($jsfinal);

//comprime (minimal)
/*if($minimal == 'minimal') {
  echo("\n\n --> Arquivo foi comprimido!\n\n");
}*/
?>