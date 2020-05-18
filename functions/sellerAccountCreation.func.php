<?php

if (isset($_POST['updateBankgegevens'])) {

    //save data in temporary variables
    $bank = $_POST['bank'];
    $bankNummer = $_POST['bankNummer'];
    $controleOptie = $_POST['controleOptie'];
    $creditcard = $_POST['creditcard'];

    // TODO: Error messages and other invalid register checks. (koen)
    if (empty($bank) || empty($bankNummer) || empty($controleOptie) || empty($creditcard)) {
        echo 'Vul alle velden in';
    } else if ($user->first()->complete == 0) {
        echo "Maak eerst uw <a href='profile.php'>profiel</a> compleet";
    } else {

        $username = $user->first()->username;
        $to = $user->first()->email;
        $subject = "EenmaalAndermaal Wachtwoord aanpassen";
        $message = '
        
        Beste ' . $username . ',
        
        U heeft een verzoek gedaan om een verkoper te worden.
        Klik op de onderstaande link om een verkoper te worden:
        https://iproject19.icasites.nl/sellerAccountCreation.php?id=' . Hash::make(Session::get('username')) . '
        Bent u dit niet neem dan contact op met beveiliging@eenmaalandermaal.nl
        ';
        $stmt = Database::getInstance()->insert('Trader', array(
            'username' => Session::get('username'),
            'bank' => $bank,
            'bankaccount' => Hash::make($bankNummer),
            'controloption' => $controleOptie,
            'creditcard' => Hash::make($creditcard)
        ));

        if ($onProduction) {
            mail($to, $subject, $message);
            Message::info("sellerAccountCreation.php", array(
                'm' => 'Een email is verstuurd, bekijk ook je spambox!'
            ));

        } else {
            echo '<a href="sellerAccountCreation.php?id=' . Hash::make(Session::get('username')) . '">Klik Hier</a>';
        }
    }
}

//insert into database
if (isset($_GET['id'])) {
    if (Hash::verify(Session::get('username'), $_GET['id'])) {
        try {
            $stmt = Database::getInstance()->update('Trader', 'username', Session::get('username'), array(
                'activated' => true
            ));
            $stmt = Database::getInstance()->update('Users', 'username', Session::get('username'), array(
                'trader' => true
            ));


            Message::info('index.php', array(
                'm' => 'Je bent succesvol geactiveerd als verkoper'
            ));

        } catch
        (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
