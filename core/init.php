<?php
require_once 'globals.inc.php';

//This function turns on output buffering allowing for better Redirect's
//TODO: This function is currently a band-aid fix, better redirects should be made
ob_start();

//This function starts the php session
session_start();

//Define folder structures
$onProduction = false;

if($onProduction == true) {
    define('ROOT', 'http://iproject19.icasites.nl');
} else {
    define('ROOT', '');
}

define('CORE', __DIR__);
define('CLASSES', 'classes/');
define('FUNCTIONS', 'functions/');
define('INCLUDES', 'includes/');
define('MODALS', INCLUDES . 'modals/');

//Define inaccessible picture folder
//TODO: check if it works
define('PICTURES',  "http://iproject19.icasites.nl/pics");

//Load all classes
spl_autoload_register(function($class) {
    require_once CLASSES . $class . '.class.php';
});

//Include sanitize function
include(FUNCTIONS . 'sanitize.func.php');

//Get userdata from current logged in user
if(Session::exists('username')){
    $user = Database::getInstance()->get('Gebruiker', array('gebruikersnaam', '=', Session::get('username')));
}