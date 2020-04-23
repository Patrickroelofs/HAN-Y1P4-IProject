<?php


class Redirect
{
    public static function to($location = null){
        if($location) {
            if(is_numeric($location)){
                header("Location: login");
            }

            header("Location: " . $location);
            exit();
        }
    }
}