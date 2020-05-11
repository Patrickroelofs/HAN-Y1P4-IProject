<?php


class Random
{
    public static function selectRandomProduct()
    {
        $id = Database::getInstance()->query("SELECT voorwerpnummer FROM Voorwerp");
        return mt_rand(0, $id->count());
    }
}