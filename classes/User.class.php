<?php

class User {
    private $_db;
    private $_data;
    private $_sessionName;

    public function __construct($user = null)
    {
        $this->_db = Database::getInstance();

        $this->_sessionName = Config::get('session/session_name');
    }

    public function create($fields = array()) {
        if(!$this->_db->insert('Gebruiker', $fields)){
            throw new Exception('There was a problem creating an account');
        }
    }

    public function find($user = null){

        if($user){

            $field = (is_numeric($user)) ? 'id' : 'gebruikersnaam';
            $data = $this->_db->get('Gebruiker', array($field, '=', $user));

            if($data->count()) {
                //TODO: System does not do count(); ???
                $this->_data = $data->first();
                return true;
            }
        }
        return false;
    }

    public function login($username = null, $password = null) {
        $user = $this->find($username);
        echo $user;

        if($user) {
            if(password_verify($password, $this->_data->wachtwoord)){
                Session::put($this->_sessionName, $this->_data->id);
            }
        }

        return false;
    }
}