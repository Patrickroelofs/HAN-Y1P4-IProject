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
            } else {
                Redirect::to('index.php');
            }
        } catch (PDOException $e) {
            //Error during insert
            echo $e->getMessage();
        }
    }
    else {
        echo "Ingevulde wachtwoorden komen niet overeen";
    }
}

if (isset($_POST['versturen'])) {
    $query = $_POST['email'];
    $stmt = Database::getInstance()->query("SELECT * FROM Users WHERE email = '$query'", array());
    if ($stmt->count() == 0) {
        echo "<p>Voer een geldig emailadres in.</p>";
    } else {
        $to = $stmt->first()->email;
        $subject = "Wachtwoord aanpassen";
        $message = "Hello world!";
        //mail($to, $subject, $message);
        echo '<a href="passwordreset.php?id=' . Hash::make($to) . '&uid=' . $stmt->first()->username . '">Klik hier</a>';
    }
}
?>