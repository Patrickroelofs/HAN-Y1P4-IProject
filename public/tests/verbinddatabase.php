<!--Camiel Nijman 15-1-2020-->
<?php
$hostname = 'localhost';
$dbname = 'iproject19';
$user = 'sa';
$pw = 'sa';

try {   $e = new PDO("sqlsrv:Server=localhost;Database=iproject19", "sa", "sa");
}

catch (PDOException $e) {
    echo "Er ging iets mis met de database.<br>";
    echo "De melding is {$e->getMessage()}<br><br>";
}
?>
