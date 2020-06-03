<?php

class Console{
    /**
     * A quick and dirty function to console.log inserted data
     * @param $data
     */
    public static function log($data) {
        echo "<script>console.log('$data')</script>";
    }
}