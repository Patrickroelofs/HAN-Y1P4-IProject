<?php

class Database {
    private static  $_pdo = null;
    private         $_query;
    private         $_error = false;
    private         $_results;
    private         $_count = 0;

    /**
     * Database constructor.
     */
    private function __construct() {
        try {
            if(self::$_pdo == null) {
                self::$_pdo = new PDO('sqlsrv:Server=' . Config::get('pdo/host') . ',1433;Database=' . Config::get('pdo/database'), Config::get('pdo/username'), Config::get('pdo/password'));
            }
        } catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    /**
     * Returns the current database
     * @return Database
     */
    public static function getInstance() {
        return new Database();
    }

    /**
     * Closes the connection to the database
     */
    public function closeConnection() {
        self::$_pdo = null;
    }

    /**
     * Query the database with an sql statement
     * @param $sql
     * @param array $params
     * @return $this
     */
    public function query($sql, $params = array()) {
        $this->_error = false;
        if($this->_query = self::$_pdo->prepare($sql)) {
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

        return $this;
    }

    /**
     * Insert data into a $table, array $fields correspond with tables in database
     * @param $table
     * @param array $fields
     * @return bool
     */
    public function insert($table, $fields = array()) {
        if(count($fields)) {
            $keys = array_keys($fields);
            $values = null;
            $x = 1;

            foreach($fields as $field){
                $values .= '?';
                if($x < count($fields)) {
                    $values .= ', ';
                }
                $x++;
            }

            $sql = "INSERT INTO $table (".implode(', ', $keys).") VALUES ({$values})";

            if(!$this->query($sql, $fields)->error()) {
                return true;
            }
        }

        return false;
    }

    /**
     * Update data in a $table, check the $row with $key, array $fields correspond with tables in database
     * @param $table
     * @param $row
     * @param $key
     * @param $fields
     * @return bool
     */
    public function update($table, $row, $key, $fields) {
        $set = '';
        $x = 1;

        foreach($fields as $name => $value) {
            $set .= "{$name} = ?";
            if ($x < count($fields)) {
                $set .= ', ';
            }
            $x++;
        }

        $sql = "UPDATE {$table} SET {$set} WHERE {$row} = '{$key}'";

        if(!$this->query($sql, $fields)->error()) {
            return true;
        }
        return false;
    }

    /**
     * An easier way of getting data from the database, with limiting operators for better security
     * @param $action
     * @param $table
     * @param array $where
     * @return $this|bool
     */
    public function action($action, $table, $where = array()) {
        if(count($where) === 3) {
            $operators = array('=', '>', '<', '>=', '<=');

            $field      = $where[0];
            $operator   = $where[1];
            $value      = $where[2];

            if(in_array($operator, $operators)) {
                $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";
                if(!$this->query($sql, array($value))->error()) {
                    return $this;
                }
            }
        }
        return false;
    }

    /**
     * A quick way to get data
     * @param $table
     * @param $where
     * @return $this|bool
     */
    public function get($table, $where) {
        return $this->action('SELECT *', $table, $where);
    }

    /**
     * A quick way to delete data
     * @param $table
     * @param $where
     * @return $this|bool
     */
    public function delete($table, $where) {
        return $this->action('DELETE', $table, $where);
    }

    /**
     * Prepare a statement
     * @param $sql
     * @return bool|PDOStatement
     */
    public function prepare($sql){
        return self::$_pdo->prepare($sql);
    }

    /**
     * returns the result of any query
     * @return mixed
     */
    public function results() {
        return $this->_results;
    }

    /**
     * Returns the first result
     * @return mixed
     */
    public function first() {
        return $this->results()[0];
    }

    /**
     * returns the specific array key $id of a result
     * @param $id
     * @return mixed
     */
    public function id($id) {
        return $this->results()[$id];
    }

    /**
     * returns true if there is an error in the database
     * @return bool
     */
    public function error() {
        return $this->_error;
    }

    /**
     * returns the amount of rows returned from a query
     * @return int
     */
    public function count() {
        return $this->_count;
    }
}