<?php

class user
{
    private $_db;
    private $_isLoggedIn;

    public function __construct($user = null)
    {
        $this->_db = Database::getInstance();
    }

    public function create($fields = array()) {
        if(!$this->_db->insert('users', $fields)) {
            throw new Exception('There was a problem creating this account.');
        }
    }

    public function logout() {

    }

    public function isLoggedIn(){
        return $this->_isLoggedIn;
    }
}