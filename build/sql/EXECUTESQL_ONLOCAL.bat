:: execute all scripts by calling and running each script individually

:restart
@ECHO OFF
ECHO !!!
ECHO.
ECHO EXECUTING THIS SCRIPT WILL:
ECHO - DELETE ALL TABLES
ECHO - DELETE ALL CONTENT
ECHO - REINSERT TABLES
ECHO - REINSERT CONTENT
ECHO.
PAUSE
@CLS

SQLCMD -i "%~dp0\1.CREATESCRIPT.sql"
ECHO.
ECHO CREATED DATABASE TABLES
ECHO.
PAUSE
@CLS

SQLCMD -i "%~dp0\2.BATCH_CREATESCRIPT.sql"
ECHO.
ECHO CREATED DATABATCH TABLES
ECHO.
PAUSE
@CLS

SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\3.BATCH_INSERT_CATEGORIES.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\4.BATCH_INSERT_COUNTRIES.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\5.BATCH_INSERT_USERS.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\6.BATCH_INSERT_ITEMS.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\888-Sport, fietsen en vakantie\CREATE Users.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\888-Sport, fietsen en vakantie\100287-Bowling.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\888-Sport, fietsen en vakantie\10511-Skating en rolschaatsen.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\888-Sport, fietsen en vakantie\10514-Paardensport.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\888-Sport, fietsen en vakantie\10518-Duiksport.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\888-Sport, fietsen en vakantie\113754-Sportartikelen.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\888-Sport, fietsen en vakantie\119232-Atletiek.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\888-Sport, fietsen en vakantie\1305-Tickets en toegangskaarten.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\888-Sport, fietsen en vakantie\13331-Voetbal.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\888-Sport, fietsen en vakantie\13334-Golf.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\888-Sport, fietsen en vakantie\13340-Tennis.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\888-Sport, fietsen en vakantie\13347-Overige sporten.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\888-Sport, fietsen en vakantie\13361-Fitness en training.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\888-Sport, fietsen en vakantie\13364-Vlieg- en luchtsport.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\888-Sport, fietsen en vakantie\13368-Funsport.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\888-Sport, fietsen en vakantie\13389-Skien en langlaufen.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\888-Sport, fietsen en vakantie\13394-Snowboarden.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\888-Sport, fietsen en vakantie\1492-Hengelsport.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\888-Sport, fietsen en vakantie\159045-Geocaching.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\888-Sport, fietsen en vakantie\160939-Vakantiereizen.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\888-Sport, fietsen en vakantie\202-Sportverzamelartikelen.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\888-Sport, fietsen en vakantie\20835-Boog- en schietsport.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\888-Sport, fietsen en vakantie\20852-IJshockey.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\888-Sport, fietsen en vakantie\21209-Biljarten, pool en snooker.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\888-Sport, fietsen en vakantie\21214-American football.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\888-Sport, fietsen en vakantie\21225-Schaatsen.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\888-Sport, fietsen en vakantie\24369-Formule 1 en racesport.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\888-Sport, fietsen en vakantie\26143-Vechtsporten.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\888-Sport, fietsen en vakantie\26328-Darts.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\888-Sport, fietsen en vakantie\2912-Rugby.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\888-Sport, fietsen en vakantie\30100-Boksen.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\888-Sport, fietsen en vakantie\30760-Triathlon.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\888-Sport, fietsen en vakantie\31365-Badminton.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\888-Sport, fietsen en vakantie\32542-Dans en ballet.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\888-Sport, fietsen en vakantie\33482-Basketbal.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\888-Sport, fietsen en vakantie\33497-Tafeltennis.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\888-Sport, fietsen en vakantie\40876-Squash.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\888-Sport, fietsen en vakantie\4388-Hockey.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\888-Sport, fietsen en vakantie\56801-Hardlopen en jogging.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\888-Sport, fietsen en vakantie\66112-Bergbeklimmen.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\888-Sport, fietsen en vakantie\68787-Handbal.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\888-Sport, fietsen en vakantie\70918-Nordic walking.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\888-Sport, fietsen en vakantie\81616-Honkbal.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\888-Sport, fietsen en vakantie\81625-Polsbandjes.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\888-Sport, fietsen en vakantie\81627-Volleybal.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\888-Sport, fietsen en vakantie\8503-Vakantie- en reisbenodigdheden.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\888-Sport, fietsen en vakantie\85346-Turnen en gymnastiek.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\888-Sport, fietsen en vakantie\88937-Jeu de boules en petanque.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\888-Sport, fietsen en vakantie\9192-Fietsen en fietssport.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\888-Sport, fietsen en vakantie\9202-Watersporten.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\11116-Munten en bankbiljetten\CREATE Users.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\11116-Munten en bankbiljetten\12822-Biljetten Buitenland.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\11116-Munten en bankbiljetten\179197-Virtueel geld.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\11116-Munten en bankbiljetten\18492-Penningen.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\11116-Munten en bankbiljetten\18755-Medailles.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\11116-Munten en bankbiljetten\28683-Nederlandse niet-euromunten.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\11116-Munten en bankbiljetten\3444-Waardepapieren, aandelen.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\11116-Munten en bankbiljetten\34470-Nederlandse bankbiljetten.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\11116-Munten en bankbiljetten\34939-Edelmetalen.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\11116-Munten en bankbiljetten\40718-Muntaccessoires.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\11116-Munten en bankbiljetten\45148-Europese niet-euromunten.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\11116-Munten en bankbiljetten\46004-Overige munten en biljetten.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\11116-Munten en bankbiljetten\4733-Antieke en Middeleeuwse munten.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\11116-Munten en bankbiljetten\7972-Misslagen en proefdrukken.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\11116-Munten en bankbiljetten\7975-Euromunten en -biljetten.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\11116-Munten en bankbiljetten\7990-Wereldwijde munten.sql"
SQLCMD -f 65001 -d iproject19 -x -i "%~dp0\11116-Munten en bankbiljetten\7999-Verzamelingen en partijen.sql"
ECHO.
ECHO INSERTED ALL BATCH DATA
ECHO INSERT ITEMS DATABASE MANUALLY
ECHO.
PAUSE
@CLS

SQLCMD -i "%~dp0\7.BATCH_CONVERSIESCRIPT.sql"
ECHO.
ECHO CONVERTED BATCH TO MAIN DATABASE
ECHO.
PAUSE
@CLS

SQLCMD -i "%~dp0\8.ADMIN_INSERT.sql"
ECHO.
ECHO INSERTED ADMIN USER
ECHO.
PAUSE
@CLS

SQLCMD -i "%~dp0\9.BATCH_DROP.sql"
ECHO.
ECHO DROPPED BATCH DATABASE
ECHO.
PAUSE
@CLS

:choice
set /P c=Rerun script[Y/N]?
if /I "%c%" EQU "Y" goto :restart
if /I "%c%" EQU "N" goto :choice
goto :choice