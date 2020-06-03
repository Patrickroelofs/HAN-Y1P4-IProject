<?php

class Modifiers {

    /**
     * Cut text from a string given the $length
     * @param $x
     * @param $length
     * @return false|string
     */
    public static function textlength($x, $length) {
        if(strlen($x) <= $length) {
            return $x;
        } else {
            $y = substr($x, 0, $length);
            return $y;
        }
    }
}