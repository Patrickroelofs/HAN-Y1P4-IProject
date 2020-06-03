<?php


class Redirect
{
    /**
     * Redirects to a specific page
     * @param null $location
     */
    public static function to($location = null){
        if($location) {

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

    /**
     * Refreshes the page the user is currently on
     */
    public static function refresh() {
        header("Refresh: 0");
    }
}