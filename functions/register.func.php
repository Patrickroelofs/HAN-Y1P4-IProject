<?php

//======================================================================
// REGISTER
//======================================================================

// Is submit pressed
if (isset($_POST['register-submit'])) {

    // Save data in temporary variables
    $username           =  escape($_POST['username']);
    $email              =  escape($_POST['email']);
    $password           =  $_POST['password'];
    $password_repeat    =  $_POST['password_repeat'];

    // Get usernames if its already taken
    $users = Database::getInstance()->get('Users', array('username', '=', $username));
    $emails = Database::getInstance()->get('Users', array('email', '=', $email));

    // TODO: Error messages and other invalid register checks.
    if (empty($username) || empty($email) || empty($password) || empty($password_repeat)) {
        Message::error('index.php', array(
            'm' => 'Verplichte velden zijn leeg...'
        ));

    } else if ($password !== $password_repeat) {
        Message::error('index.php', array(
            'm' => 'Wachtwoorden zijn niet hetzelfde...',
            'username' => $username,
            'email' => $email
        ));

    } else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        Message::error('index.php', array(
            'm' => 'Incorrecte karakter in gebruikersnaam...',
            'username' => $username,
            'email' => $email
        ));

    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        Message::error('index.php', array(
            'm' => 'Emailadres is niet een correcte emailadres...',
            'username' => $username,
            'email' => $email
        ));

    } else if ($users->count() > 0 || $emails->count() > 0) {
        Message::error('index.php', array(
            'm' => 'Gebruikersnaam of email is al in gebruik...',
            'username' => $username,
            'email' => $email
        ));

    } else if (strlen($password) < 6) {
        Message::error('index.php', array(
            'm' => 'Wachtwoord te kort...',
            'username' => $username,
            'email' => $email
        ));

    } else if (strlen($password_repeat) < 6) {
        Message::error('index.php', array(
            'm' => 'Wachtwoord te kort...',
            'username' => $username,
            'email' => $email
        ));

    } else if (strlen($username) < 4) {
        Message::error('index.php', array(
            'm' => 'Gebruikersnaam te kort...',
            'username' => $username,
            'email' => $email
        ));

    } else if (strlen($username) >= 50) {
        Message::error('index.php', array(
            'm' => 'Gebruikersnaam te lang...',
            'username' => $username,
            'email' => $email
        ));
    } else {
        //Insert into database
        try {
            $stmt = Database::getInstance()->insert('Users', array(
                'username' => $username,
                'email' => $email,
                'password' => Hash::make($password)
            ));

            Session::put('username', $username);
            Redirect::to('index.php?doorsturen=1');

        } catch (PDOException $e) {
            //Error during insert
            echo $e->getMessage();
        }
    }
}

if (isset($_GET['doorsturen'])) {

    //fills variables with information for mail function
    $username = $user->first()->username;
    $to = $user->first()->email;
    $subject = "EenmaalAndermaal Wachtwoord aanpassen";
    $message = '
        
        Beste ' . escape($username) . ',
        
        U heeft een verzoek gedaan om een gebruiker te worden op EenmaalAndermaal.
        Klik op de onderstaande link om uw account te bevestigen.
        https://iproject19.icasites.nl/sellerAccountCreation.php?id=' . Hash::make(Session::get('username')) . '
        Bent u dit niet neem dan contact op met beveiliging@eenmaalandermaal.nl
        ';


    if ($onProduction) {
        mail($to, $subject, $message);
        Message::info("sellerAccountCreation.php", array(
            'm' => 'Een email is verstuurd, bekijk ook je spambox!'
        ));

    } else {
        echo '<a href="index.php?id=' . Hash::make(Session::get('username')) . '">Klik Hier</a>';
    }
}

//insert into database
if (isset($_GET['id'])) {
    if (Hash::verify(Session::get('username'), $_GET['id'])) {
        try {
            $stmt = Database::getInstance()->update('Users', 'username', Session::get('username'), array(
                'verified' => true
            ));


        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
