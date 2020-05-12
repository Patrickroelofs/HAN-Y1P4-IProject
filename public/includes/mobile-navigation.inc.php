<div class="ui sidebar vertical menu inverted" id="sidebar">
    <div class="ui item right aligned horizontal-padding-6">
    <span class="image">
        <img width="48" height="48" alt="user profile picture" class="ui circular image vertical-margin-12" src="
        <?php
        if(!Session::exists('username') || empty($user->first()->profielfoto)) {
            echo 'https://place-hold.it/64x64';
        } else {
            echo $user->first()->profielfoto;
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
            } else if(empty($user->first()->voornaam) || empty($user->first()->achternaam)) {
                echo $user->first()->gebruikersnaam;
            } else {
                echo $user->first()->voornaam . ' ' . $user->first()->achternaam;
            } ?>
        </span>
        </div>
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
                <a class="item" href="profile.php">Mijn Profiel</a>
                <?php
                if($user->first()->verkoper == false) {
                    echo '<a class="item" href="selleraccountcreation.php">Word een verkoper</a>';
                } else {
                    echo '<a class="item" href="createauction.php">Advertentie plaatsen</a>';
                }
                ?>
                <a class="item" href="includes/navigation/logout.inc.php">Uitloggen</a>
                <?php
            }
            ?>
            <a class="item" href="categories.php">Alle categorieën</a>
            <a class="item" href="foryou.php">Voor Jou</a>
            <a class="item" href="nearby.php">Dichtbij</a>
            <a class="item" href="#">Nieuw</a>
        </div>
    </div>
</div>