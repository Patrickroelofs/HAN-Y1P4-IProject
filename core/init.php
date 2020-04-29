<?php

require_once 'globals.inc.php';

ob_start();
session_start();



spl_autoload_register(function($class) {
    require_once __DIR__ . '/../classes/' . $class . '.class.php';
});


include(__DIR__ . '/../functions/sanitize.func.php');