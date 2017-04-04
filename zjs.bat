@ECHO off
CLS
ECHO %1

php -f "%~dp0zjs.php" %1 %2 %3 -m