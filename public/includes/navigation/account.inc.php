<div class="ui dropdown item accountdropdown right aligned horizontal-padding-6">
    <span class="image">
        <img alt="user profile picture" src="https://place-hold.it/32x32" class="ui circular image">
    </span>
    <div class="text">
        <span class="bold">Goedemiddag,</span>
        <span>
            <?php echo Session::get('username'); ?>
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
        <a class="item">Mijn Profiel</a>
        <a class="item" href="includes/navigation/logout.inc.php">Uitloggen</a>
<?php
    }
?>
    </div>
</div>
