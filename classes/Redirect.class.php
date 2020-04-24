<?php


class Redirect
{
    public static function to($location = null){
        if($location) {

            //TODO: Error catching & Handling
            if(is_numeric($location)){
                switch($location){
                    case 404:
                        echo '404';
                        break;
                }
            }

            header("Location: " . $location);
            exit();
        }
    }
}