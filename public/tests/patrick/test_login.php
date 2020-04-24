<?php require_once '../../../core/init.php'; ?>

<?php

//======================================================================
// LOGIN
//======================================================================

// Is submit pressed
if(isset($_POST['login-submit'])) {

    // Save data in temporary variables
    $username           =  $_POST['username'];
    $password           =  $_POST['password'];

    // Get (hashed) password from $username
    $stmt = Database::getInstance()->prepare('SELECT wachtwoord FROM Gebruiker WHERE gebruikersnaam=:username');
    $stmt->execute(array(
       ':username' => $username
    ));

    //Fetch actual password
    $result = $stmt->fetch(PDO::FETCH_COLUMN);

    // TODO: Error messages and other invalid register checks.
    if(empty($username) || empty($password)){
        //error
        echo 'error - empty';

    } else if(!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        echo 'error - username has incorrect characters';

    }

    //Verify password hash
    else if(Hash::get($password, $result)) {
        //Username and password correct -> log user in
        Session::put('username', Hash::make($username));

    } else {
        echo 'error - password or username incorrect';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login | Testfile</title>
</head>
<body>
<form action="" method="post">
    <div class="field">
        <label for="username">Gebruikersnaam</label>
        <input type="text" name="username" id="username" value="">
    </div>

    <div class="field">
        <label for="password">Wachtwoord</label>
        <input type="password" name="password" id="password" value="">
    </div>

    <div class="field">
        <input type="hidden" name="token" value="">
        <input type="submit" name="login-submit" value="Submit">
    </div>
</form>
</body>
</html>