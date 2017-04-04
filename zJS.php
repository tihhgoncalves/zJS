<?php

// Carregar vendor
require __DIR__ . '/vendor/autoload.php';

date_default_timezone_set('America/Sao_Paulo');

use Symfony\Component\Console\Input\InputOption;

// Carregar parâmetros
$def = new \Symfony\Component\Console\Input\InputDefinition([]);
$def->addArgument(new \Symfony\Component\Console\Input\InputArgument('path', InputOption::VALUE_REQUIRED, 'Diretorio base'));
$def->addArgument(new \Symfony\Component\Console\Input\InputArgument('in', InputOption::VALUE_REQUIRED, 'Arquivo index Ex.: index.zjs'));
$def->addArgument(new \Symfony\Component\Console\Input\InputArgument('out', InputOption::VALUE_REQUIRED, 'Arquivo output Ex.: script.js'));
$def->addOption(new \Symfony\Component\Console\Input\InputOption('log', 'l', InputOption::VALUE_NONE, 'Habilita ou não o log'));
$def->addOption(new \Symfony\Component\Console\Input\InputOption('minify', 'm', InputOption::VALUE_NONE, 'Habilita minificacao do arquivo'));

// Juntar arquivos
$builder = new \Zjs\Builder(__DIR__, new \Symfony\Component\Console\Input\ArgvInput(null, $def));
$builder->make();