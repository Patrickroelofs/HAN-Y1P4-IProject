<?php

//======================================================================
// UPDATE INLOGGEGEVENS
//======================================================================

// Is submit pressed
if (isset($_POST['update-inloggegevens-submit'])) {

    // Save data in temporary variables
    // Inloggegevens
    $password = $_POST['password'];
    $password_repeat = $_POST['password_repeat'];

    // TODO: Error messages and other invalid register checks.
    if (empty($password) || empty($password_repeat)) {
        //error
        echo 'error - empty';

    } else if ($password !== $password_repeat) {
        // succes message
        Message::error('profile.php', array(
            'm' => 'Wachtwoorden zijn niet hetzelfde'
        ));
    } else {
        //Insert into database
        try {
            $stmt = Database::getInstance()->update('Users', 'username', Session::get('username'), array(
                'password' => Hash::make($password)
            ));

            // succes message
            Message::notice('profile.php', array(
                'm' => 'Wachtwoorden succesvol aangepast'
            ));

        } catch (PDOException $e) {
            //Error during insert
            echo $e->getMessage();
        }
    }
}

//======================================================================
// UPDATE PERSOONSGEGEVENS
//======================================================================

// Is submit pressed
if (isset($_POST['update-persoonsgegevens-submit'])) {

    // Save data in temporary variables
    //Persoonsgegevens
    $firstname = escape($_POST['firstname']);
    $lastname = escape($_POST['lastname']);
    $dob = $_POST['dob'];
    $profilepicture = $_FILES['profilepicture']['name'];
    $phone = escape($_POST['phone']);

    //Randomly hash filename
    $ext = pathinfo($_FILES['profilepicture']['name'], PATHINFO_EXTENSION);
    $filename = md5(basename($profilepicture));
    $target = 'upload/profilepictures/' . $filename . '.' . $ext;
    $supported_image = array('gif', 'jpg', 'jpeg', 'png');


    // TODO: Error messages and other invalid register checks.
    if (empty($firstname) || empty($lastname) || empty($dob)) {
        //error
        echo 'error - empty';
    }
    if (!empty($profilepicture) && !in_array($ext, $supported_image)) {
        echo 'error - unsupported file format';
    } else {
        // Insert into database
        try {
            //Move uploaded profilepicture to folder
            //TODO: Secure image upload
            move_uploaded_file($_FILES['profilepicture']['tmp_name'], $target);

            // If there is no profile picture uploaded
            if (empty($profilepicture)) {
                $stmt = Database::getInstance()->update('Users', 'username', Session::get('username'), array(
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'birthdate' => $dob,
                    'phone' => $phone
                ));
            } // If there is a profile picture uploaded
            else {
                $stmt = Database::getInstance()->update('Users', 'username', Session::get('username'), array(
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'birthdate' => $dob,
                    'profilepicture' => $target,
                    'phone' => $phone
                ));
            }

            // succes message
            Message::notice('profile.php', array(
                'm' => 'Uw persoonsgegevens zijn succesvol bijgewerkt'
            ));

        } catch (PDOException $e) {
            //Error during insert
            echo $e->getMessage();
        }
    }
}

//======================================================================
// UPDATE LOCATIEGEGEVENS
//======================================================================

// Is submit pressed
if (isset($_POST['update-locatiegegevens-submit'])) {

    // Save data in temporary variables
    //Locatiegegevens
    $adresregel1 = escape($_POST['adresregel1']);
    $adresregel2 = escape($_POST['adresregel2']);
    $postcode = escape($_POST['postcode']);
    $plaatsnaam = escape($_POST['plaatsnaam']);
    $land = $_POST['land'];

    // TODO: Error messages and other invalid register checks.
    if (empty($adresregel1) || empty($postcode) || empty($postcode) || empty($land)) {
        //error
        Message::error('profile.php', array(
            'm' => 'Vul alle locatiegegevens in'
        ));
    } else {
        // Insert into database
        try {
            $stmt = Database::getInstance()->update('Users', 'username', Session::get('username'), array(
                'address1' => $adresregel1,
                'address2' => $adresregel2,
                'postalcode' => $postcode,
                'city' => $plaatsnaam,
                'country' => $land,
                'complete' => true
                //TODO: Compleet goed in database zetten
            ));

            // succes message
            Message::notice('profile.php', array(
                'm' => 'Uw locatiegegevens zijn succesvol bijgewerkt'
            ));

        } catch (PDOException $e) {
            //Error during insert
            echo $e->getMessage();
        }
    }
}

//======================================================================
// DELETE Account
//======================================================================

// Is submit pressed
if (isset($_POST['delete-account-submit'])) {
    $email = $_POST['email'];

    // Logged in, delete account from database
    if (Session::exists('username')) {

        //Get the users profilepicture and delete it
        $stmt = Database::getInstance()->get('Users', array('username', '=', Session::get('username')));
        unlink($stmt->first()->profilepicture);

        // if the user is a trader delete that user
        if ($user->first()->trader == true) {
            $trader = Database::getInstance()->delete('Trader', array('username', '=', Session::get('username')));
        }
        //Delete user and ends session
        $user = Database::getInstance()->delete('Users', array('username', '=', Session::get('username')));

        session_unset();
        session_destroy();

        Message::notice('index.php', array(
            'm' => 'Uw account is succesvol verwijderd'
        ));
        
    }

    // Logged out, delete account from database
    else {
        if ($onProduction) {
            //Send user the verification mail
            $stmt = Database::getInstance()->query("SELECT * FROM Users WHERE email = '" . escape($email) . "'");
            $username = escape($stmt->first()->username);
            $to = escape($stmt->first()->email);
            $subject = "EenmaalAndermaal Account Verwijderen";
            $message = '

        Beste ' . escape($username) . ',

        U heeft een verzoek gedaan om uw EenmaalAndermaal account te verwijderen.
        Klik op de onderstaande link om uw gegevens te verwijderen:
        https://iproject19.icasites.nl/removeaccount.php?rmid=' . Hash::make(escape($username)) . '
        Bent u dit niet neem dan contact op met beveiliging@eenmaalandermaal.nl
        ';

            mail($to, $subject, $message);
            Message::info("removeaccount.php", array(
                'm' => 'Een email is verstuurd, bekijk ook je spambox!'
            ));
        } else {
            //Immediately show verification link if not on production server
            $stmt = Database::getInstance()->query("SELECT * FROM Users WHERE email = '" . escape($email) . "'");
            $username = escape($stmt->first()->username);
            $email = escape($stmt->first()->email);
            echo '<a href="removeaccount.php?rmid=' . Hash::make(escape($email)) . '&rmuid=' . escape($username) . '">Klik Hier</a>';
        }
    }

}
//If the rmid is valid delete all user information and redirect to index.php
if (isset($_GET['rmid'])) {

    $stmt = Database::getInstance()->get('Users', array('username', '=', $_GET['rmuid']));

    if (Hash::verify($stmt->first()->email, $_GET['rmid'])) {

        unlink($stmt->first()->profilepicture);

        // if the user is a trader delete that user
        if ($stmt->first()->trader == true) {
            $trader = Database::getInstance()->delete('Trader', array('username', '=', $_GET['rmuid']));
        }

        $user = Database::getInstance()->delete('Users', array('username', '=', $_GET['rmuid']));

        Message::notice('index.php', array(
            'm' => 'Uw account is succesvol verwijderd'
        ));
    }

}