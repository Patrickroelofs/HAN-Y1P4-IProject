<?php
    //If user is not logged in
    if(!Session::exists('username')){
?>

        <div class="account-login">
            <a href="login.php" class="ui button">Inloggen</a>
            <a href="register.php" class="ui button">Registreren</a>
        </div>

<?php
    // If user is logged in
    } else {
?>

<div class="ui dropdown link item accountdropdown">
    <span class="image">
        <img alt="user profile picture" src="https://place-hold.it/48x48" class="ui circular image">
    </span>
    <div class="text">
        <span class="bold">Goedemiddag,</span>
        <span>Gebruiker</span>
    </div>
    <i class="dropdown icon"></i>
    <div class="menu">
        <div class="item">Mijn Profiel</div>
        <a class="item" href="includes/navigation/logout.inc.php">Uitloggen</a>
    </div>
</div>

<?php
    }
?>

