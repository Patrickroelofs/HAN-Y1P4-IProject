<?php

class Admin {
    public static function isLoggedIn() {
        // if a session exists
        if(Session::exists('username')) {
            //get admin data
            $admin = Database::getInstance()->query("SELECT * FROM Admins where username = '". Session::get('username') ."'");

            //if an admin is returned
            if($admin->count() >= 1) {
                //if the session and the admin are the same
                if(strtolower(Session::get('username')) === strtolower($admin->first()->username)) {
                    return true;
                }
            } else {
                return false;
            }
        }

        return false;
    }

    public static function adminID() {
        if(Session::exists('username')) {
            $admin = Database::getInstance()->query("SELECT * FROM Admins where username = '". Session::get('username') ."'");

            if($admin->count() >= 1) {
                //if the session and the admin are the same
                if(strtolower(Session::get('username')) === strtolower($admin->first()->username)) {
                    $adminID = Database::getInstance()->query("SELECT * FROM Users where username = '". $admin->first()->username ."'");
                    return $adminID->first()->id;
                }
            } else {
                return false;
            }
        }
        return false;
    }

    public static function banUser($userID) {
        // marks the user as banned
        Database::getInstance()->update("Users", "id", $userID, array(
           'banned' => true
        ));

        //Get user data
        $getUser = Database::getInstance()->query("SELECT * FROM Users WHERE id = '". $userID ."'");

        //Get product data connected to user
        $getItems = Database::getInstance()->query("SELECT * FROM Items WHERE trader = '". $getUser->first()->username ."'");

        //Loop through users items and mark them as hidden
        foreach ($getItems->results() as $item) {
            Database::getInstance()->update("Items", "id", $item->id, array(
               'hidden' => true
            ));
        }
    }

    public static function unbanUser($userID) {
        Database::getInstance()->update("Users", "id", $userID, array(
            'banned' => false
        ));

        //Get user data
        $getUser = Database::getInstance()->query("SELECT * FROM Users WHERE id = '". $userID ."'");

        //Get product data connected to user
        $getItems = Database::getInstance()->query("SELECT * FROM Items WHERE trader = '". $getUser->first()->username ."'");

        //Loop through users items and mark them as visible
        foreach ($getItems->results() as $item) {
            Database::getInstance()->update("Items", "id", $item->id, array(
                'hidden' => false
            ));
        }
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