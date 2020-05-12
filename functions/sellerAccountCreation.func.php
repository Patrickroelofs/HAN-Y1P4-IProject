<?php

if(isset($_POST['updateBankgegevens'])) {

    //save data in temporary variables
    $bank           = $_POST['bank'];
    $bankNummer     = $_POST['bankNummer'];
    $controleOptie  = $_POST['controleOptie'];
    $creditcard     = $_POST['creditcard'];

    // TODO: Error messages and other invalid register checks. (koen)
    if(empty($bank) || empty($bankNummer) || empty($controleOptie) || empty($creditcard)) {
        echo 'Fill in all information';
    }
    else if($user->first()->compleet == 0) {
        echo 'Fill all your account information in first';
    }

    else {
        //insert into database
        try {
            $stmt = Database::getInstance()->insert('Verkoper', array(
                'gebruikersnaam' => Session::get('username'),
                'bank' => $bank,
                'bankrekening' => $bankNummer,
                'controleoptie' => $controleOptie,
                'creditcard' => $creditcard
            ));

            $stmt = Database::getInstance()->update('Gebruiker', 'gebruikersnaam', Session::get('username'), array(
                'verkoper' => true
            ));

            Redirect::to('index.php');
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
}