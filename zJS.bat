@ECHO off
CLS
ECHO %1

php -f "%~dp0zJS.php" %1 %2 %3 -m