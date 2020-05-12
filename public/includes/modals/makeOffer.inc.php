<?php
// Error messages
$errorUserTitle = "U bent uitgelogd";
$errorUserText = "<p>Om te kunnen bieden op producten moet u eerst inloggen of registreren.</p>";
$errorProfileTitle = "Profiel niet compleet";
$errorProfileText = "<p>Om te kunnen bieden op producten moet u eerst uw profielgegevens aanvullen op uw <a href='profile.php'>profiel pagina</a> .</p>";
$errorBidTitle = "Bieding gesloten";
$errorBidText = "<p>Deze bieding is helaas al gesloten.</p>";

if(!Session::exists('username')) {
    $error = true;
    $errorTitle = $errorUserTitle;
    $errorText = $errorUserText;
} elseif($user->first()->compleet == 0) {
    $error = true;
    $errorTitle = $errorProfileTitle;
    $errorText = $errorProfileText;
} elseif ($bidClosed == true) {
    $error = true;
    $errorTitle = $errorBidTitle;
    $errorText = $errorBidTitle;
} else {
    $error = false;
}

// User has everything
if ($error == false) { ?>
    <div class="ui modal makeOffer">
        <i class="close icon"></i>
        <div class="header">
            Maak een bod
        </div>
        <div class="image content">
            <div class="ui medium image">
                <img src="https://place-hold.it/400x400">
            </div>
            <div class="description">
                <div class="ui header">Product</div>

                <form method="post" id="offer-form">
                    <div class="ui input labeled input required">
                        <label for="amount" class="ui label">€</label>
                        <input type="text" placeholder="Uw bod" name="amount">
                    </div>
                </form>
            </div>
        </div>
        <div class="actions">
            <div class="ui input labeled input">
                <button type="submit" form="offer-form" name="offer-submit" class="ui primary labeled icon button">
                    <i class="gavel icon"></i>
                    Bieden
                </button>
            </div>
        </div>
    </div>
<?php } else if ($error == true) { ?>
    <div class="ui mini modal makeOffer">
        <div class="ui header">
            <?php echo $errorTitle ?>
        </div>
        <div class="content">
            <?php echo $errorText ?>
        </div>
        <div class="actions">
            <div class="ui green ok inverted button">
                <i class='checkmark icon'></i>
                Okay
            </div>
        </div>
    </div>
    <?php
}
?>
