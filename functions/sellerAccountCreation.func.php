<?php

//check if user completed account
if ($user->first()->complete == 0) {
    Message::info('profile.php', array(
        'm' => 'Maak eerst uw account volledig voordat u een verkoper wordt'
    ));

} else {
    if (isset($_POST['updateBankgegevens'])) {

        //save data in temporary variables
        $bank = escape($_POST['bank']);
        $bankNummer = escape($_POST['bankNummer']);
        $controleOptie = escape($_POST['controleOptie']);
        $creditcard = escape($_POST['creditcard']);

        // TODO: Error messages and other invalid register checks. (koen)
        //check if user filled everything in
        if (empty($bank) || empty($bankNummer) || empty($controleOptie) || empty($creditcard)) {
            Message::info('sellerAccountCreation.func.php', array(
                'm' => 'Vul alle velden in'
            ));

        } else {

            //insert bank details into database
            $stmt = Database::getInstance()->insert('Trader', array(
                'username' => Session::get('username'),
                'bank' => $bank,
                'bankaccount' => Hash::make($bankNummer),
                'controloption' => $controleOptie,
                'creditcard' => Hash::make($creditcard),
                'activated' => false
            ));

            //send mail or link depending on if its on a production server or not
            if ($onProduction) {
                //fills variables with information for mail function
                $username = escape($user->first()->username);
                $to = escape ($user->first()->email);
                $subject = "EenmaalAndermaal Wachtwoord aanpassen";
                $message = '
        
        Beste ' . escape($username) . ',
        
        U heeft een verzoek gedaan om een verkoper te worden.
        Klik op de onderstaande link om een verkoper te worden:
        https://iproject19.icasites.nl/sellerAccountCreation.php?id=' . Hash::make(Session::get('username')) . '
        Bent u dit niet neem dan contact op met beveiliging@eenmaalandermaal.nl
        ';

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

            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
}
