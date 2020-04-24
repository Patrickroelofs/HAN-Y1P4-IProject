<?php require_once '../../../core/init.php'; ?>

<?php

//======================================================================
// REGISTER
//======================================================================

// Is submit pressed
if(isset($_POST['register-submit'])) {

    // Save data in temporary variables
    $username           =  $_POST['username'];
    $email              =  $_POST['email'];
    $password           =  $_POST['password'];
    $password_repeat    =  $_POST['password_repeat'];

    // TODO: Error messages and other invalid register checks.
    if(empty($username) || empty($email) || empty($password) || empty($password_repeat)){
        //error
        echo 'error - empty';

    } else if($password !== $password_repeat) {
        echo 'error - password not same';

    } else if(!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        echo 'error - username has incorrect characters';

    } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo 'error - not a correct email';
    }

    else {
        //Insert into database
        try{
            $stmt = Database::getInstance()->insert('Gebruiker', array(
                'gebruikersnaam' => $username,
                'emailadres' => $email,
                'wachtwoord' => Hash::make($password)
            ));

        } catch(PDOException $e){
            //Error during insert
            echo $e->getMessage();
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register | Testfile</title>
</head>
<body>
    <form action="" method="post">
        <div class="field">
            <label for="username">Gebruikersnaam</label>
            <input type="text" name="username" id="username" value="">
        </div>

        <div class="field">
            <label for="email">Emailadres</label>
            <input type="text" name="email" id="email" value="">
        </div>

        <div class="field">
            <label for="password">Wachtwoord</label>
            <input type="password" name="password" id="password" value="">
        </div>

        <div class="field">
            <label for="password_repeat">Wachtwoord herhalen</label>
            <input type="password" name="password_repeat" id="password_repeat" value="">
        </div>

        <div class="field">
            <input type="submit" name="register-submit" value="Submit">
        </div>
    </form>
</body>
</html>