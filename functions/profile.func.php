<?php

//======================================================================
// UPDATE INLOGGEGEVENS
//======================================================================

// Is submit pressed
if(isset($_POST['update-inloggegevens-submit'])) {

    // Save data in temporary variables
    // Inloggegevens
    $password           =   $_POST['password'];
    $password_repeat    =   $_POST['password_repeat'];

    // TODO: Error messages and other invalid register checks.
    if(empty($password) || empty($password_repeat)){
        //error
        echo 'error - empty';

    } else if($password !== $password_repeat) {
        echo 'error - password not same';
    }

    else {
        //Insert into database
        try{
            $stmt = Database::getInstance()->update('Gebruiker', 'gebruikersnaam', Session::get('username'), array(
                'wachtwoord' => Hash::make($password)
            ));

            Redirect::to('profile.php');

        } catch(PDOException $e){
            //Error during insert
            echo $e->getMessage();
        }
    }
}

//======================================================================
// UPDATE PERSOONSGEGEVENS
//======================================================================

// Is submit pressed
if(isset($_POST['update-persoonsgegevens-submit'])) {

    // Save data in temporary variables
    //Persoonsgegevens
    $firstname          =   $_POST['firstname'];
    $lastname           =   $_POST['lastname'];
    $dob                =   $_POST['dob'];
    $profilepicture     =   $_FILES['profilepicture']['name'];

    //Randomly hash filename
    $ext = pathinfo($_FILES['profilepicture']['name'], PATHINFO_EXTENSION);
    $filename = md5(basename($profilepicture));
    $target = 'upload/profilepictures/' . $filename . '.' . $ext;
    $supported_image = array('gif','jpg','jpeg','png');
    $size = getimagesize($target);

    // TODO: Error messages and other invalid register checks.
    if(empty($firstname) || empty($lastname) || empty($dob)) {
        //error
        echo 'error - empty';
    } if(!in_array($ext, $supported_image)) {
        echo 'error - unsupported file format';
    }

    else {
        // Insert into database
        try{
            //Move uploaded profilepicture to folder
            //TODO: Secure image upload
            move_uploaded_file($_FILES['profilepicture']['tmp_name'], $target);

            // If there is no profile picture uploaded
            if(empty($profilepicture)) {
                $stmt = Database::getInstance()->update('Gebruiker', 'gebruikersnaam', Session::get('username'), array(
                    'voornaam' => $firstname,
                    'achternaam' => $lastname,
                    'geboortedag' => $dob,
                ));
            }
            // If there is a profile picture uploaded
            else {
                $stmt = Database::getInstance()->update('Gebruiker', 'gebruikersnaam', Session::get('username'), array(
                    'voornaam' => $firstname,
                    'achternaam' => $lastname,
                    'geboortedag' => $dob,
                    'profielfoto' => $target
                ));
            }

            Redirect::to('profile.php');

        } catch(PDOException $e) {
            //Error during insert
            echo $e->getMessage();
        }
    }
}

//======================================================================
// UPDATE LOCATIEGEGEVENS
//======================================================================

// Is submit pressed
if(isset($_POST['update-locatiegegevens-submit'])) {

    // Save data in temporary variables
    //Locatiegegevens
    $adresregel1        =   $_POST['adresregel1'];
    $adresregel2        =   $_POST['adresregel2'];
    $postcode           =   $_POST['postcode'];
    $plaatsnaam         =   $_POST['plaatsnaam'];
    $land               =   $_POST['land'];

    // TODO: Error messages and other invalid register checks.
    if(empty($adresregel1) || empty($postcode) || empty($postcode) || empty($land)){
        //error
        echo 'error - empty';
    }

    else {
        // Insert into database
        try {
            $stmt = Database::getInstance()->update('Gebruiker', 'gebruikersnaam', Session::get('username'), array(
                'adresregel1' => $adresregel1,
                'adresregel2' => $adresregel2,
                'postcode' => $postcode,
                'plaatsnaam' => $plaatsnaam,
                'landnaam' => $land,
                'compleet' => true
                //TODO: Compleet goed in database zetten
            ));

            Redirect::to('profile.php');

        } catch(PDOException $e) {
            //Error during insert
            echo $e->getMessage();
        }
    }
}

//======================================================================
// DELETE Account
//======================================================================

// Is submit pressed
if(isset($_POST['delete-account-submit'])) {
    $email = $_POST['email'];
    // Logged in, delete account from database
    if(Session::exists('username')){
        $user = Database::getInstance()->delete('Gebruiker', array('gebruikersnaam', '=', Session::get('username')));

        session_unset();
        session_destroy();
    }

    // Logged out, delete account from database
    else {
        $emails = Database::getInstance()->delete('Gebruiker', array('emailadres', '=', $email));
    }
    Redirect::to('index.php');
}