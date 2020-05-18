<?php

if(isset($_POST['updateBankgegevens'])) {

    //save data in temporary variables
    $bank           = $_POST['bank'];
    $bankNummer     = $_POST['bankNummer'];
    $controleOptie  = $_POST['controleOptie'];
    $creditcard     = $_POST['creditcard'];

    // TODO: Error messages and other invalid register checks. (koen)
    if(empty($bank) || empty($bankNummer) || empty($controleOptie) || empty($creditcard)) {
        echo 'Vul alle velden in';
    }
    else if($user->first()->complete == 0) {
        echo "Maak eerst uw <a href='profile.php'>profiel</a> compleet";
    }

    else {
        //insert into database
        try {
            $stmt = Database::getInstance()->insert('Trader', array(
                'username' => Session::get('username'),
                'bank' => $bank,
                'bankaccount' => $bankNummer,
                'controloption' => $controleOptie,
                'creditcard' => $creditcard
            ));

            $stmt = Database::getInstance()->update('Users', 'username', Session::get('username'), array(
                'trader' => true
            ));

            Redirect::to('index.php');
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
}