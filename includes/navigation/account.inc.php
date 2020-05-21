<div class="ui dropdown select item accountdropdown right aligned horizontal-padding-6">
    <span class="image">
        <img width="48" height="48" alt="user profile picture" class="ui circular image" src="
        <?php
            if(!Session::exists('username') || empty($user->first()->profilepicture)) {
                echo 'upload/profilepictures/default.jpg';
            } else {
                echo escape($user->first()->profilepicture);
            }
        ?>">
    </span>
    <div class="text">
        <span class="bold">
        <?php
        $time = date("H");

        if($time < "12") {
            echo "Goedemorgen,";
        } else if ($time >= "12" && $time < "17") {
            echo "Goedemiddag,";
        } else if ($time >= "17" && $time < "19") {
            echo "Goedeavond,";
        } else if ($time >= "19") {
            echo "Goedenacht,";
        }
        ?>
        </span>
        <span>
            <?php
            if(!Session::exists('username')) {
                echo 'Gebruiker';
            } else if(empty($user->first()->firstname) || empty($user->first()->lastname)) {
                echo escape($user->first()->username);
            } else {
                echo escape($user->first()->firstname) . ' ' . escape($user->first()->lastname);
            } ?>
        </span>
    </div>
    <i class="dropdown icon"></i>
    <div class="menu">
<?php
    //If user is not logged in
    if(!Session::exists('username')){
?>
            <a class="item press-login-modal">Inloggen</a>
            <a class="item press-register-modal">Registreren</a>
<?php
    // If user is logged in
    } else {
?>
        <a class="item" href="editprofile.php">Mijn Profiel</a>

        <?php
            if(!Admin::isLoggedIn()) {
                echo '<a class="item" href="yourbids.php">Jouw biedingen</a>';

                if($user->first()->trader == false) {
                    echo '<a class="item" href="selleraccountcreation.php">Word een verkoper</a>';
                } else {
                    echo '<a class="item" href="createauction.php">Advertentie plaatsen</a>';
                }
            }
        ?>
        <a class="item" href="includes/navigation/logout.inc.php">Uitloggen</a>
<?php
    }
?>
    </div>
</div>
