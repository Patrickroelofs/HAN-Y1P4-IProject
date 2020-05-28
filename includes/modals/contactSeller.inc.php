<?php
// Retrieve correct user
$sellerName = Database::getInstance()->query("SELECT trader FROM Items WHERE id = $productID", array());

$sellerName = escape($sellerName->first()->trader);

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

    <?php if(strtolower(Session::get('username')) == strtolower($thisItem->first()->trader)) {
        $buyer = Database::getInstance()->query("SELECT * FROM Users where username = '". $thisItem->first()->buyer ."'"); ?>
        <div class="ui modal contactSeller">
            <i class="close icon"></i>
            <div class="header">
                Neem contact op met koper
            </div>
            <div class="image content">
                <div class="ui medium image">
                    <img src="
                <?php
                    if(empty($buyer->first()->profilepicture)) {
                        echo 'https://place-hold.it/400';
                    } else {
                        echo $buyer->first()->profilepicture;
                    } ?>">
                </div>
                <div class="description">
                    <div class="ui header">
                        <?php echo escape($buyer->first()->username) ?>
                    </div>

                    <p><span class="bold">Emailadres: </span>
                        <a href="<?php echo 'mailto:' .escape($buyer->first()->email) ?>">
                            <?php echo escape($buyer->first()->email) ?></a></p>

                    <p><span class="bold">Plaats: </span>
                        <?php if(empty(escape($buyer->first()->city))) {
                            echo "niet beschikbaar";
                        } else {
                            echo ucfirst(escape($buyer->first()->city));
                        }  ?>
                    </p>

                    <p><span class="bold">Telefoonnummer: </span>
                        <?php if(empty($buyer->first()->phone)) {
                            echo "niet beschikbaar";
                        } else {
                            echo escape($buyer->first()->phone);
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
        <?php
    } else {
        ?>
        <div class="ui modal contactSeller">
            <i class="close icon"></i>
            <div class="header">
                Neem contact op met verkoper
            </div>
            <div class="image content">
                <div class="ui medium image">
                    <img src="
                <?php
                    if(empty($usrInfo->first()->profilepicture)) {
                        echo 'upload/profilepictures/default.jpg';
                    } else {
                        echo $usrInfo->first()->profilepicture;
                    } ?>">
                </div>
                <div class="description">
                    <div class="ui header">
                        <?php echo escape($usrInfo->first()->username) ?>
                    </div>

                    <p><span class="bold">Emailadres: </span>
                        <a href="<?php echo 'mailto:' .escape($usrInfo->first()->email) ?>">
                            <?php echo escape($usrInfo->first()->email) ?></a><br>

                    <span class="bold">Plaats: </span>
                        <?php if(empty(escape($usrInfo->first()->city))) {
                            echo "niet beschikbaar";
                        } else {
                            echo ucfirst(escape($usrInfo->first()->city));
                        }  ?><br>

                        <?php
                            $countryCode = $usrInfo->first()->country;
                            $countryName = Database::getInstance()->query("SELECT * FROM Country WHERE code = $countryCode",array());
                        ?>
                    <span class="bold">Land: </span>
                        <?php if(empty(escape($usrInfo->first()->country)) || escape($usrInfo->first()->country) == '0000') {
                            echo "niet beschikbaar";
                        } else {
                            echo ucfirst(escape($countryName->first()->name));
                        }  ?><br>

                    <span class="bold">Telefoonnummer: </span>
                        <?php if(empty($usrInfo->first()->phone)) {
                            echo "niet beschikbaar";
                        } else {
                            echo escape($usrInfo->first()->phone);
                        }  ?>
                    </p>
                    <p>
                        <span class="bold">Betaalmethode: </span><?= $thisItem->first()->paymentname ?><br>
                        <?php // if payment instructions exist
                            if (!empty($thisItem->first()->paymentinstruction)) { ?>
                                <span class="bold">Betaalinstructies: </span><?= $thisItem->first()->paymentinstruction; ?>
                        <?php } ?>
                    </p>
                    <p>
                        <span class="bold">Verzendkosten: </span><?= $thisItem->first()->shippingcost ?><br>
                        <?php // if shipping instrucitons exist
                            if (!empty($thisItem->first()->shippinginstructions)) { ?>
                                <span class="bold">Verzendinstructies: </span><?= $thisItem->first()->shippinginstructions; ?>
                            <?php } ?>
                    </p>
                </div>
            </div>
            <div class="actions">
                <?php if ($thisItem->first()->closed && $thisItem->first()->buyer == Session::get('username')) {?>
                <a href="feedback.php?p=<?=$thisItem->first()->id ?>" class="ui primary right labeled icon button">
                    Feedback achterlaten
                    <i class="balance scale icon"></i>
                </a>
            <?php } ?>
                <div class="ui positive right labeled icon button">
                    Sluiten
                    <i class="checkmark icon"></i>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
<?php } ?>