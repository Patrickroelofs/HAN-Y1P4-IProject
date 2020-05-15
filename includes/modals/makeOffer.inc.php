<?php
// If user is not logged in display error message
if(!Session::exists('username')) {
    $error = true;
    $errorTitle = "U bent uitgelogd";
    $errorText = "<p>Om te kunnen bieden op producten moet u eerst inloggen of registreren.</p>";

// if user account is not complete display error message
} else if(!$user->first()->compleet) {
    $error = true;
    $errorTitle = "Profiel niet compleet";
    $errorText = "<p>Om te kunnen bieden op producten moet u eerst uw profielgegevens aanvullen op uw <a href='profile.php'>profiel pagina</a>.</p>";

//if bidding for this item is closed display error message
} else if ($bidClosed->first()->gesloten) {
    $error = true;
    $errorTitle = "Bieding gesloten";
    $errorText = "<p>Deze bieding is helaas al gesloten.</p>";

} else {
    $error = false;
}

// User is allowed to make a modal
if (!$error) { ?>
    <div class="ui modal makeOffer">
        <i class="close icon"></i>
        <div class="header">
            Maak een bod
        </div>
        <div class="image content">
            <div class="ui medium image">
                <img src="<?= ROOT . $stmt->first()->thumbnail; ?>">
            </div>
            <div class="description">
                <div class="ui header">Product</div>
                <p> <?php
                    // Show current highest bid if product exists in bod table
                    if($bidExists->count(1) == 1) {
                        echo '<span class="bold">Hoogste bod: €' . $bidHigh->first()->bodbedrag . '</span>';
                    } else {
                        echo '<span class="bold">Maak nu het startbod van €' . $stmt->first()->startprijs . '!</span>';
                    }
                    ?></p>

                <form method="post" id="offer-form">
                    <div class="ui input labeled input required">
                        <label for="amount" class="ui label">€</label>
                        <input type="text" required autocomplete="off" placeholder="Uw bod" name="amount">
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
<?php
    // An error occurred
    } else if ($error) {
?>
    <div class="ui mini modal makeOffer">
        <div class="ui header">
            <?= $errorTitle ?>
        </div>
        <div class="content">
            <?= $errorText ?>
        </div>
        <div class="actions">
            <div class="ui green ok inverted button">
                <i class='checkmark icon'></i>
                Okay
            </div>
        </div>
    </div>
<?php } ?>
