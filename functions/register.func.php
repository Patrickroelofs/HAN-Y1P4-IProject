<?php

//======================================================================
// REGISTER
//======================================================================

// Is submit pressed
if(isset($_POST['register-submit'])) {

    // Save data in temporary variables
    $username           =  $_POST['username'];
    $email              =  $_POST['email'];
    $password           =  $_POST['password'];
    $password_repeat    =  $_POST['password_repeat'];

    // Get usernames if its already taken
    $users = Database::getInstance()->get('Gebruiker', array('gebruikersnaam', '=', $username));
    $emails = Database::getInstance()->get('Gebruiker', array('emailadres', '=', $email));

    // TODO: Error messages and other invalid register checks.
    if(empty($username) || empty($email) || empty($password) || empty($password_repeat)){
        Message::error('index.php', array(
            'm' => 'Verplichte velden zijn leeg...'
        ));

    } else if($password !== $password_repeat) {
        Message::error('index.php', array(
            'm' => 'Wachtwoorden zijn niet hetzelfde...'
        ));

    } else if(!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        Message::error('index.php', array(
            'm' => 'Incorrecte karakter in gebruikersnaam...'
        ));

    } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        Message::error('index.php', array(
            'm' => 'Emailadres is niet een correcte emailadres'
        ));

    } else if ($users->count() > 0 || $emails->count() > 0) {
        Message::error('index.php', array(
            'm' => 'Gebruikersnaam of email is al in gebruik'
        ));
    }

    else {
        //Insert into database
        try{
            $stmt = Database::getInstance()->insert('Gebruiker', array(
                'gebruikersnaam' => $username,
                'emailadres' => $email,
                'wachtwoord' => Hash::make($password)
            ));

            Session::put('username', $username);
            Redirect::to('profile.php');

        } catch(PDOException $e){
            //Error during insert
            echo $e->getMessage();
        }
    }
}