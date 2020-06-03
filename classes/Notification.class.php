<?php

class Notification{

    /**
     * Add a notification $message to a username $name
     * @param $name
     * @param $message
     */
    public static function add($name, $message) {
        Database::getInstance()->insert("Notifications", array(
            'username' => $name,
            'message' =>  $message
        ));
    }
}

