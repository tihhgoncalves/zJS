# zJS
Compress JavaScript

## Instala��o - Via Composer
Para instalar o zJS, basta ir em um terminal `console` e executar o comando exibido a baixo:

    composer create-project --prefer-dist tihhgoncalves/zJS zjs

## Configurar no PHPStorm

Antes de configurar o zJS, � muito importante que voc� defina em seu PHPStorm os tipos de arquivos `*.zpjs` e os `*.zjs`.
 - `zpjs` � o arquivo index|root onde ser� definido a lista de arquivos a ser montado. Esse � um arquivo do tipo JSON, ent�o nas configura��es  `settings` em `File Types` voc� deve adicionar a extes�o `*.zpjs` no tipo de arquivos `JSON`.
 - `zjs` � o arquivo JavaScript ser� montado e minficado, ent�o nas configura��es  `settings` em `File Types` voc� deve adicionar a extes�o `*.zjs` no tipo de arquivos `JavaScript`.

Agora deve ser configurado o `File Watchers`, para isso criamos no projeto um arquivo watchers.xml que poder� ser improtado como exemplo e guia da configura��o.
