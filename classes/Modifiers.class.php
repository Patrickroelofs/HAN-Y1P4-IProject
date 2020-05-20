<?php

class Modifiers {

    public static function textlength($x, $length) {
        if(strlen($x) <= $length) {
            return $x;
        } else {
            $y = substr($x, 0, $length);
            return $y;
        }
    }
}