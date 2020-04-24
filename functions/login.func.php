<?php

//======================================================================
// LOGIN
//======================================================================

// Is submit pressed
if(isset($_POST['login-submit'])) {

    // Save data in temporary variables
    $username           =  $_POST['username'];
    $password           =  $_POST['password'];

    // Get (hashed) password from $username
    $stmt = Database::getInstance()->prepare('SELECT wachtwoord FROM Gebruiker WHERE gebruikersnaam=:username');
    $stmt->execute(array(
        ':username' => $username
    ));

    //Fetch actual password
    $result = $stmt->fetch(PDO::FETCH_COLUMN);

    // TODO: Error messages and other invalid register checks.
    if(empty($username) || empty($password)){
        //error
        echo 'error - empty';

    } else if(!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        echo 'error - username has incorrect characters';

    }

    //Verify password hash
    else if(Hash::get($password, $result)) {
        //Username and password correct -> log user in
        Session::put('username', Hash::make($username));

    } else {
        echo 'error - password or username incorrect';
    }
}