<?php

class Hash {
    /**
     * Hash a string using the safe password_hash function
     * @param $string
     * @return false|string|null
     */
    public static function make($string) {
        return password_hash($string, PASSWORD_DEFAULT);
    }

    /**
     * Verify a string and hash using the password_verify function
     * @param $string
     * @param $hash
     * @return bool
     */
    public static function verify($string, $hash) {
        return password_verify($string, $hash);
    }
}