:: execute all scripts by calling each script individually
:: has not been tested when running multiple scripts
:: SQLCMD -E -dmaster -i (location of script)\actualscript.sql

SQLCMD -E -dmaster -i H:\HAN-Y1P4-IProject\build\sql\createTables\bod.sql
PAUSE