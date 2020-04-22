<?php

class Dbh{
    private $servername;
    private $username;
    private $password;
    private $dbname;

    public function connect() {
        $this->servername = "localhost";
        $this->username = "sa";
        $this->password = "sa";
        $this->dbname = "IProject";

        try{
            $dsn = "sqlsrv:Server=" . $this->servername . ";Database=" . $this->dbname;
            $pdo = new PDO($dsn, $this->username, $this->password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $pdo;
        } catch(Exception $e){
            echo "Connection failed:" . $e->getMessage();
        }
    }
}