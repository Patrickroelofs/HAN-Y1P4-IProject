<?php
if (isset($_POST['veranderen'])) {
    $password = $_POST['password'];
    $password_repeat = $_POST['password_repeat'];
    $email = $_GET['id'];
    $uid = $_GET['uid'];
    $stmt = Database::getInstance()->query("SELECT * FROM Users WHERE username = '$uid'", array());
    // TODO: Error messages and other invalid register checks.
    if ($password == $password_repeat) {
        try {
            if (Hash::verify($stmt->first()->email, $email)) {

                Database::getInstance()->update('Users', 'username', $uid, array(
                    'password' => Hash::make($password)
                ));
                Redirect::to('index.php');
            } else {
                Redirect::to('index.php');
            }
        } catch (PDOException $e) {
            //Error during insert
            echo $e->getMessage();
        }
    } else {
        echo "Ingevulde wachtwoorden komen niet overeen";
    }
}

if (isset($_POST['versturen'])) {
    $query = $_POST['email'];
    $stmt = Database::getInstance()->query("SELECT * FROM Users WHERE email = '$query'", array());
    if ($stmt->count() == 0) {
        echo "<p>Voer een geldig emailadres in.</p>";
    } else {
        $username = $stmt->first()->username;
        $to = $stmt->first()->email;
        $subject = "EenmaalAndermaal Wachtwoord aanpassen";
        $message = '
        
        Beste '.$username.',
        
        U heeft een verzoek gedaan om uw wachtwoord te veranderen.
        Klik op de onderstaande link om uw wachtwoord te veranderen:
        https://iproject19.icasites.nl/passwordchange.php?id='.Hash::make($to).'&uid='.$stmt->first()->username.'
        Bent u dit niet neem dan contact op met beveiliging@eenmaalandermaal.nl
        ';
        if ($onProduction) {
            mail($to, $subject, $message);
            Message::info("passwordchange.php", array(
                'm' => 'Een email is verstuurd, bekijk ook je spambox!'
            ));

        } else {
            echo '<a href="passwordchange.php?id=' . Hash::make($to) . '&uid=' . $stmt->first()->username . '">Klik hier</a>';
        }
    }
}
?>