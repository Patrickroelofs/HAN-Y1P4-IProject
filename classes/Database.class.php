<?php

class Database {
    private static $_instance = null;
    private $_pdo;
    private $_query;
    private $_error = false;
    private $_results;
    private $_count = 0;

    private function __construct()
    {
        try{
            $this->_pdo = new PDO('sqlsrv:Server=' . Config::get('pdo/host') . ';Database' . Config::get('pdo/database'), Config::get('pdo/username'), Config::get('pdo/password'));
            echo 'Works!';
        } catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function getInstance() {
        if(!isset(self::$_instance)) {
            self::$_instance = new Database();
        }
        return self::$_instance;
    }

    public function query($sql, $params = array()) {
        $this->_error = false;

        if($this->_query = $this->_pdo->prepare($sql)) {
            $x = 1;
            if(count($params)) {
                foreach($params as $param) {
                    $this->_query->bindValue($x, $param);
                    $x++;
                }
            }

            if($this->_query->execute()) {
                $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                $this->_count = $this->_query->rowCount();
            } else {
                $this->_error = true;
            }
        }
    }

    public function insert($fields = array()) {
        if(count($fields)) {
            $keys = array_keys($fields);
            $values = null;
            $x = 1;

            foreach($fields as $field) {
                $values .= "?";
                if($x < count($fields)) {
                    $values .= ', ';
                }
                $x++;
            }

            $sql = "INSERT INTO TEST_register (`".implode('`, `', $keys)."`) VALUES ({$values})";

            if(!$this->query($sql, $fields)->error()) {
                return true;
            }
        }

        return false;
    }

    public function error() {
        return $this->_error;
    }

    public function count() {
        return $this->_count;
    }
}