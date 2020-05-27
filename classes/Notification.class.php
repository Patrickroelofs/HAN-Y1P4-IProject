<?php

class Notification{

    public static function add($name, $message) {
        Database::getInstance()->insert("Notifications", array(
            'username' => $name,
            'message' =>  $message
        ));
    }
}

