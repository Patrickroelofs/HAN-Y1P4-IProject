<?php
require_once 'globals.inc.php';

//This function turns on output buffering allowing for better Redirect's
//TODO: This function is currently a band-aid fix, better redirects should be made
ob_start();

//This function starts the php session
session_start();

//Define folder structures
define('ROOT', $_SERVER['DOCUMENT_ROOT']);
define('PUBLIC_ROOT', ROOT . 'public');
define('CORE', __DIR__);
define('CLASSES', '../classes/');
define('FUNCTIONS', '../functions/');
define('INCLUDES', '../public/includes/');
define('MODALS', INCLUDES . 'modals/');

//Load all classes
spl_autoload_register(function($class) {
    require_once CORE . DIRECTORY_SEPARATOR . CLASSES . $class . '.class.php';
});

//Include sanitize function
include(FUNCTIONS . 'sanitize.func.php');

//Get userdata from current logged in user
if(Session::exists('username')){
    $user = Database::getInstance()->get('Gebruiker', array('gebruikersnaam', '=', Session::get('username')));
}