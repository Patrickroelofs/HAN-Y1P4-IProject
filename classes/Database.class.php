<?php

class Database {
    private static  $_instance = null;
    private         $_pdo;

    private function __construct() {
        try {
            $this->_pdo = new PDO('sqlsrv:Server=' . Config::get('pdo/host') . ',1433;Database=' . Config::get('pdo/database'), Config::get('pdo/username'), Config::get('pdo/password'));
            Console::log("Database Connected succesfully to server: " . Config::get('pdo/host') . ' Database: ' . Config::get('pdo/database'));
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
        //TODO: Basic query into database
    }

    public function update($table, $row, $fields) {
        // Update table, row and field
    }

    public function get($table, $row) {
        //TODO: Basic getter (*) for specific table (and row?)
    }

    public function delete($table, $row) {
        //TODO: Delete row from table
    }
}