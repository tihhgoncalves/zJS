# zJS
Compress JavaScript

## Instalação - Via Composer
Para instalar o zJS, basta ir em um terminal `console` e executar o comando exibido a baixo:

    composer create-project --prefer-dist tihhgoncalves/zJS zjs

## Configurar no PHPStorm

Antes de configurar o zJS, é muito importante que você defina em seu PHPStorm os tipos de arquivos `*.zpjs` e os `*.zjs`.
 - `zpjs` é o arquivo index|root onde será definido a lista de arquivos a ser montado. Esse é um arquivo do tipo JSON, então nas configurações  `settings` em `File Types` você deve adicionar a extesão `*.zpjs` no tipo de arquivos `JSON`.
 - `zjs` é o arquivo JavaScript será montado e minficado, então nas configurações  `settings` em `File Types` você deve adicionar a extesão `*.zjs` no tipo de arquivos `JavaScript`.

Agora deve ser configurado o `File Watchers`, para isso criamos no projeto um arquivo watchers.xml que poderá ser improtado como exemplo e guia da configuração.
