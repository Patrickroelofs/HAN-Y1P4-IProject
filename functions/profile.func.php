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
            $stmt = Database::getInstance()->update('Gebruiker', Session::get('username'), array(
                'wachtwoord' => Hash::make($password)
            ));

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

    // TODO: Error messages and other invalid register checks.
    if(empty($firstname) || empty($lastname) || empty($dob)) {
        //error
        echo 'error - empty';
    }

    else {
        // Insert into database
        try{
            $stmt = Database::getInstance()->update('Gebruiker', Session::get('username'), array(
                'voornaam' => $firstname,
                'achternaam' => $lastname,
                'geboortedag' => $dob
            ));

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
            $stmt = Database::getInstance()->update('Gebruiker', Session::get('username'), array(
                'adresregel1' => $adresregel1,
                'adresregel2' => $adresregel2,
                'postcode' => $postcode,
                'plaatsnaam' => $plaatsnaam,
                'landnaam' => $land
            ));

        } catch(PDOException $e) {
            //Error during insert
            echo $e->getMessage();
        }
    }
}