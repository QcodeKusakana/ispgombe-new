@echo off
setlocal
set "PROJECT_ROOT=%~dp0"
set "PHP_EXE=C:\laragon\bin\php\php-8.1.10-Win32-vs16-x64\php.exe"

if not exist "%PHP_EXE%" (
  echo PHP Laragon est introuvable : %PHP_EXE%
  pause
  exit /b 1
)

"%PHP_EXE%" "%PROJECT_ROOT%admin\create_superadmin.php" %*
if errorlevel 1 echo La creation a echoue. Verifiez que MySQL fonctionne et relisez le message ci-dessus.
pause
