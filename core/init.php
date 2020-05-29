<?php
require_once 'globals.inc.php';

//This function turns on output buffering allowing for better Redirect's
//TODO: This function is currently a band-aid fix, better redirects should be made
ob_start();

//This function starts the php session
session_start();

//Define folder structures
$onProduction = false;

define('ROOT', '');
define('DS', '/');
define('DIR', dirname(__DIR__));
define('CLASSES', 'classes' . DS);
define('FUNCTIONS', 'functions'. DS);
define('INCLUDES', 'includes' . DS);
define('MODALS', INCLUDES . 'modals' . DS);

//Load all classes
spl_autoload_register(function($class) {
    require_once DIR . DS . CLASSES . $class . '.class.php';
});

//Include sanitize function
include(DIR . DS . FUNCTIONS . 'sanitize.func.php');

//Get userdata from current logged in user
if(Session::exists('username')){
    $user = Database::getInstance()->get('Users', array('username', '=', Session::get('username')));

    // if the user is banned from the site
    if($user->first()->banned) {
        Session::delete('username');
        Session::destroy('username');

        Message::warning('index.php', array('m' => 'Dit account is geblokeert, neem contact op met de klantenservice'));
    }
}

$selectTraders = Database::getInstance()->query("SELECT username FROM Users WHERE trader = 1");
foreach ($selectTraders->results() as $result) {
    Trader::checkItems($result->username);
}