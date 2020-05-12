:: execute all scripts by calling and running each script individually

:restart
@ECHO OFF
ECHO !!!
ECHO.
ECHO EXECUTING THIS SCRIPT WILL:
ECHO - DELETE TABLES
ECHO - ALL CONTENT
ECHO.
PAUSE
@cls

SQLCMD -i "%~dp0\batch\CREATE Tables.sql"
SQLCMD -i "%~dp0\batch\CREATE Categorieen.sql"
SQLCMD -i "%~dp0\batch\GBALanden.sql"
ECHO.
ECHO EXECUTED BATCH FILE INTO BATCH-IPROJECT19
ECHO.
PAUSE
@cls

:choice
set /P c=Rerun script[Y/N]?
if /I "%c%" EQU "Y" goto :restart
if /I "%c%" EQU "N" goto :choice
goto :choice