@echo off
setlocal
set "MYSQL_HOME=C:\laragon\bin\mysql\mysql-8.0.30-winx64"

if not exist "%MYSQL_HOME%\bin\mysqld.exe" (
  echo MySQL Laragon est introuvable : %MYSQL_HOME%
  pause
  exit /b 1
)

echo Demarrage de MySQL Laragon. Laissez cette fenetre ouverte.
echo Si Windows affiche une erreur sur ibdata1, relancez CMD en tant qu'administrateur.
"%MYSQL_HOME%\bin\mysqld.exe" --defaults-file="%MYSQL_HOME%\my.ini" --console
echo MySQL s'est arrete. Consultez le message ci-dessus.
pause
