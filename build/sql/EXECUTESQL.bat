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

SQLCMD -i %~dp0\DELETESCRIPT.sql
ECHO.
ECHO STEP 1 - 4
ECHO DELETED ALL TABLES AND CONTENTS
ECHO.
PAUSE
@cls

SQLCMD -i %~dp0\FUNCTIONS.sql
ECHO.
ECHO STEP 2 - 4
ECHO CREATED ALL FUNCTIONS
ECHO.
PAUSE
@cls

SQLCMD -i %~dp0\TMP_CREATESCRIPT.sql
ECHO.
ECHO STEP 3 - 4
ECHO CREATED ALL TABLES
ECHO.
PAUSE
@cls

SQLCMD -i %~dp0\insertscripts\Rubriek_insert.sql
ECHO.
ECHO STEP 3 - 5
ECHO INSERTED ALL DATA INTO TABLES
ECHO.
PAUSE
@cls

:choice
set /P c=Rerun script[Y/N]?
if /I "%c%" EQU "Y" goto :restart
if /I "%c%" EQU "N" goto :choice
goto :choice