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
        //error
        echo 'error - empty';

    } else if($password !== $password_repeat) {
        echo 'error - password not same';

    } else if(!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        echo 'error - username has incorrect characters';

    } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo 'error - not a correct email';

    } else if ($users->count() > 0 || $emails->count() > 0) {
        echo 'error - username or email taken';
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