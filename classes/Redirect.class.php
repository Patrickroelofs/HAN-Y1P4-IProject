<?php


class Redirect
{
    public static function to($location = null){
        if($location) {
            //Error catching & Handling
            if(is_numeric($location)){
                switch($location){
                    case 404:
                        header('HTTP/1.0 404 Not found');
                        include('errors/404.php');
                        exit();
                        break;
                }
            }

            header("Location: " . $location);
            exit();
        }
    }
}