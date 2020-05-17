<?php
// Retrieve correct user
$sellerName = Database::getInstance()->query("SELECT trader FROM Items WHERE id = $productID", array());

$sellerName = $sellerName->first()->trader;

// Retrieve user info
$usrInfo = Database::getInstance()->query("SELECT * FROM Users WHERE username = '$sellerName'", array());

$usrExits = Database::getInstance()->query("SELECT username FROM Users WHERE username = '$sellerName'",array());

// Check if user is logged in
if (!Session::exists('username')) { ?>
    <div class="ui mini modal contactSeller">
        <div class="ui header">
            Niet ingelogd
        </div>
        <div class="content">
            U moet ingelogd zijn om contact informatie te bekijken.
        </div>
        <div class="actions">
            <div class="ui green ok inverted button">
                <i class='checkmark icon'></i>
                Okay
            </div>
        </div>
    </div>
<?php }
elseif($usrExits->count() == 0) { ?>
    <div class="ui mini modal contactSeller">
        <div class="ui header">
    Er is iets misgegaan
    </div>
        <div class="content">
    Gebruikersinformatie niet gevonden
        </div>
        <div class="actions">
            <div class="ui green ok inverted button">
                <i class='checkmark icon'></i>
    Okay
            </div>
        </div>
    </div>
<?php }
// Show contact info if user is logged in
else { ?>
    <div class="ui modal contactSeller">
        <i class="close icon"></i>
        <div class="header">
            Neem contact op
        </div>
        <div class="image content">
            <div class="ui medium image">
            <img src="
                <?php
                if(empty($usrInfo->first()->profilepicture)) {
                    echo 'https://place-hold.it/400';
                } else {
                echo $usrInfo->first()->profilepicture;
                } ?>">
            </div>
            <div class="description">
                <div class="ui header">
                    <?php echo $usrInfo->first()->username ?>
                </div>

                <p><span class="bold">Emailadres: </span>
                <a href="<?php echo 'mailto:' .$usrInfo->first()->email ?>">
                    <?php echo $usrInfo->first()->email ?></a></p>

                <p><span class="bold">Plaats: </span>
                    <?php if(empty($usrInfo->first()->city)) {
                        echo "niet beschikbaar";
                    } else {
                    echo $usrInfo->first()->city;
                    }  ?>
                </p>

                <p><span class="bold">Telefoonnummer: </span>
                    <?php if(empty($usrInfo->first()->phone)) {
                        echo "niet beschikbaar";
                    } else {
                        echo $usrInfo->first()->phone;
                    }  ?>
                </p>
            </div>
        </div>
        <div class="actions">
            <div class="ui positive right labeled icon button">
                Sluiten
                <i class="checkmark icon"></i>
            </div>
        </div>
    </div>
<?php }