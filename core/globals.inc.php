<?php

$GLOBALS['config'] = array(
    'PDO' => array( // Database config
        'host' => 'localhost',
        'username' => 'sa',
        'password' => 'sa',
        'db' => 'iproject19'
    ),
    'remember' => array( // User remember account request
        'cookie_name' => 'hash',
        'cookie_expiry' => 262974383 // Seconds
    ),
    'session' => array( // User session
        'session_name' => 'user',
        'token_name' => 'token'
    )
);