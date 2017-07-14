<?php

// Carregar vendor
require __DIR__ . '/../vendor/autoload.php';

date_default_timezone_set('America/Sao_Paulo');

$files = new \Bugotech\IO\Filesystem();

$make = new Maker($files, 'zjs', 'ZJS Pack and Minify', '1.0.0', realpath(__DIR__ . '/../'), 'zjs.php');
$make->build();