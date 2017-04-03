@ECHO off
CLS
ECHO %1

php-cgi -f zJS.php path=%1 in=%2 out=%3

set jsFinal=%1/%3
set jsFinal=%jsFinal:\=/%
set jsFinal=%jsFinal:.js=.min.js%


java -jar yuicompressor-2.4.8.jar -o '.js$:-min.js' %jsFinal%