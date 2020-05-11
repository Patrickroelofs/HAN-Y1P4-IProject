<?php

if(isset($_POST['updateBankgegevens'])) {

    //save data in temporary variables
    $bank           = $_POST['bank'];
    $bankNummer     = $_POST['bankNummer'];
    $controleOptie  = $_POST['controleOptie'];
    $creditcard     = $_POST['creditcard'];

    // TODO: Error messages and other invalid register checks. (koen)
    if(empty($bank) || empty($bankNummer) || empty($controleOptie) || empty($creditcard)){
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