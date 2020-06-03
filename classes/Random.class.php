<?php


class Random
{
    /**
     * Select a random product from the Items database
     * @return int
     */
    public static function selectRandomProduct()
    {
        $id = Database::getInstance()->query("SELECT id FROM Items");
        return mt_rand(0, $id->count());
    }
}