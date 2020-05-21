<?php

class Admin {
    public static function isLoggedIn() {
        if(Session::exists('username')) {
            $admin = Database::getInstance()->query("SELECT * FROM Admins where username = '". Session::get('username') ."'");

            if($admin->count() >= 1) {
                if(strtolower(Session::get('username')) === strtolower($admin->first()->username)) {
                    return true;
                }
            } else {
                return false;
            }
        }

        return false;
    }

    public static function banUser($userID) {
        Database::getInstance()->update("Users", "id", $userID, array(
           'banned' => true
        ));
    }

    public static function unbanUser($userID) {
        Database::getInstance()->update("Users", "id", $userID, array(
            'banned' => false
        ));
    }

    public static function hideItem($itemID) {
        Database::getInstance()->update("Items", "id", $itemID, array(
           'hidden' => true
        ));
    }

    public static function showItem($itemID) {
        Database::getInstance()->update("", "id", $itemID, array(
           'hidden' => false
        ));
    }

    public static function addAdmin($username) {
        Database::getInstance()->insert("Admins", array(
           'username' => $username
        ));
    }
}