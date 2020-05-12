<?php

class Message {

    public static function error($location, $fields) {
        $set = '';
        $x = 1;

        $set .= "?error&";

        foreach($fields as $name => $value) {
            $set .= "{$name}=".escape($value)."";
            if ($x < count($fields)) {
                $set .= '&';
            }
            $x++;
        }
        Redirect::to($location.$set);
    }

    public static function warning($location, $fields) {
        $set = '';
        $x = 1;

        $set .= "?warning&";

        foreach($fields as $name => $value) {
            $set .= "{$name}=".escape($value)."";
            if ($x < count($fields)) {
                $set .= '&';
            }
            $x++;
        }

        Redirect::to($location.$set);
    }

    public static function notice($location, $fields) {
        $set = '';
        $x = 1;

        $set .= "?notice&";

        foreach($fields as $name => $value) {
            $set .= "{$name}=".escape($value)."";
            if ($x < count($fields)) {
                $set .= '&';
            }
            $x++;
        }

        Redirect::to($location.$set);
    }

    public static function info ($location, $fields) {
        $set = '';
        $x = 1;

        $set .= "?info&";

        foreach($fields as $name => $value) {
            $set .= "{$name}=".escape($value)."";
            if ($x < count($fields)) {
                $set .= '&';
            }
            $x++;
        }

        Redirect::to($location.$set);
    }
}