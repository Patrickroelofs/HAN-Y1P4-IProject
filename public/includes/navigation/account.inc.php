<div class="ui dropdown item accountdropdown right aligned horizontal-padding-6">
    <span class="image">
        <img alt="user profile picture" src="https://place-hold.it/32x32" class="ui circular image">
    </span>
    <div class="text">
        <span class="bold">Goedemiddag,</span>
        <span>
            <?php
            if(!Session::exists('username')) {
                echo 'Gebruiker';
            } else if(empty($user->first()->voornaam) || empty($user->first()->achternaam)) {
                echo $user->first()->gebruikersnaam;
            } else {
                echo $user->first()->voornaam . ' ' . $user->first()->achternaam;
            } ?>
        </span>
    </div>
    <i class="dropdown icon"></i>
    <div class="menu">
<?php
    //If user is not logged in
    if(!Session::exists('username')){
?>
            <a id="login-modal" class="item">Inloggen</a>
            <a id="register-modal" class="item">Registreren</a>
<?php
    // If user is logged in
    } else {
?>
        <a class="item" href="profile.php">Mijn Profiel</a>
        <a class="item" href="includes/navigation/logout.inc.php">Uitloggen</a>
<?php
    }
?>
    </div>
</div>
