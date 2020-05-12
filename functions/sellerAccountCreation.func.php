<?php

if(Session::exists('username')) {
    try {
        $stmt = Database::getInstance()->query("SELECT compleet FROM Gebruiker WHERE gebruikersnaam = '".Session::get('username')."' ",array());

        if($stmt->first()->compleet == 1) {
            $completedProfile = 1;
        } else {
            $completedProfile = 0;
        }
    } catch (PDOException $e) {
        //Error during select
        echo $e->getMessage();
    }
}

if(isset($_POST['updateBankgegevens'])) {

    //save data in temporary variables
    $bank           = $_POST['bank'];
    $bankNummer     = $_POST['bankNummer'];
    $controleOptie  = $_POST['controleOptie'];
    $creditcard     = $_POST['creditcard'];

    // TODO: Error messages and other invalid register checks. (koen)
    if(empty($bank) || empty($bankNummer) || empty($controleOptie) || empty($creditcard || $completedProfile == 0)){
        //error
        echo 'error - empty';
    }

    else {
        //insert into database
        try {
            $stmt = Database::getInstance()->insert('Verkoper', array(
                'gebruiker' => Session::get('username'),
                'bank' => $bank,
                'bankrekening' => $bankNummer,
                'controleoptie' => $controleOptie,
                'creditcard' => $creditcard

            ));

            Redirect::to('index.php');
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
}