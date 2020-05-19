<?php
//check if user pressed change password
if (isset($_POST['veranderen'])) {
    $password = $_POST['password'];
    $password_repeat = $_POST['password_repeat'];
    $email = $_GET['pid'];
    $uid = escape($_GET['uid']);

    $stmt = Database::getInstance()->query("SELECT * FROM Users WHERE username = '$uid'", array());

    // TODO: Error messages and other invalid register checks.
    //check if email is correct and then add new password to database
    if ($password == $password_repeat) {
        try {
            if (Hash::verify($stmt->first()->email, $email)) {

                Database::getInstance()->update('Users', 'username', $uid, array(
                    'password' => Hash::make($password)
                ));
                // succes message
                Message::notice('index.php', array(
                    'm' => 'Wachtwoord is bijgewerkt'
                ));
            } else {
                // error message
                Message::errorMulti('passwordChange.php?pid='.$_GET['pid'].'&uid='.$uid.'', array(
                    'm' => 'Er is iets fout gegaan'
                ));
            }
        } catch (PDOException $e) {
            //Error during insert
            echo $e->getMessage();
        }
    } else {
        // error message
        Message::errorMulti('passwordChange.php?pid='.$_GET['pid'].'&uid='.$uid.'', array(
            'm' => 'Wachtwoorden komen niet overeen'
        ));
    }
}
//check if user pressed send mail
if (isset($_POST['versturen'])) {
    $query = $_POST['email'];

    $stmt = Database::getInstance()->query("SELECT * FROM Users WHERE email = '$query'", array());
    //check if the emailadres is in the database and that it is valid
    if ($stmt->count() == 0) {
        // error message
        Message::error('passwordChange.php', array(
            'm' => 'Voer een geldig emailadres in'
        ));
    } else {
        $username = escape($stmt->first()->username);
        $to = $stmt->first()->email;
        $subject = "EenmaalAndermaal Wachtwoord aanpassen";
        $message = '
        
        Beste '.$username.',
        
        U heeft een verzoek gedaan om uw wachtwoord te veranderen.
        Klik op de onderstaande link om uw wachtwoord te veranderen:
        https://iproject19.icasites.nl/passwordchange.php?pid='.Hash::make($to).'&uid='.$stmt->first()->username.'
        Bent u dit niet neem dan contact op met beveiliging@eenmaalandermaal.nl
        ';

        //check if on production server and use mail function otherwise use echo as verification
        if ($onProduction) {
            mail($to, $subject, $message);
            Message::info("passwordchange.php", array(
                'm' => 'Een email is verstuurd, bekijk ook je spambox!'
            ));

        } else {
            echo '<a href="passwordchange.php?pid=' . Hash::make($to) . '&uid=' . $stmt->first()->username . '">Klik hier</a>';
        }
    }
}

?>