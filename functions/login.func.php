<?php

//======================================================================
// LOGIN
//======================================================================

// Is submit pressed
if(isset($_POST['login-submit'])) {

    // Save data in temporary variables
    $username           =  escape($_POST['username']);
    $password           =  escape($_POST['password']);

    // Get (hashed) password from $username
    $stmt = Database::getInstance()->prepare('SELECT password FROM Users WHERE username=:username');
    $stmt->execute(array(
        ':username' => $username
    ));

    //Fetch actual password
    $result = $stmt->fetch(PDO::FETCH_COLUMN);

    // TODO: Error messages and other invalid register checks.
    if(empty($username) || empty($password)){
        Message::error('index.php', array(
            'm' => 'Een van de verplichte velden zijn leeg...',
            'username' => $username
        ));

    } else if(!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        Message::error('index.php', array(
            'm' => 'Incorrecte karakter in gebruikersnaam...',
            'username' => $username,
        ));
    }

    //Verify password hash
    else if(Hash::verify($password, $result)) {
        //Username and password correct -> log user in
        Session::put('username', $username);
        Redirect::to('index.php');

    } else {
        Message::error('index.php', array(
            'm' => 'Wachtwoord of gebruikersnaam incorrect.',
            'username' => $username,
        ));
    }
}