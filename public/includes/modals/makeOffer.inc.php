<?php
// Check if the user is logged in
if (!Session::exists('username')) { ?>
    <div class="ui mini modal makeOffer">
      <div class="ui header">
        U bent uitgelogd
      </div>
      <div class="content">
        <p>Om te kunnen bieden op producten moet u eerst inloggen of registreren.</p>
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
// Check if user profile is complete
elseif ($user->first()->compleet == 0) { ?>
    <div class="ui mini modal makeOffer">
      <div class="ui header">
        Profiel niet compleet
      </div>
      <div class="content">
        <p>Om te kunnen bieden op producten moet u eerst uw profielgegevens aanvullen op uw <a href='profile.php'>profiel pagina</a> .</p>
      </div>
      <div class="actions">
        <div class="ui green ok inverted button">
            <i class='checkmark icon'></i>
          Okay
        </div>
      </div>
    </div>
<?php }
elseif ($bidClosed == 1) { ?>
    <div class="ui mini modal makeOffer">
        <div class="ui header">
            Bieding gesloten
        </div>
        <div class="content">
            <p>Deze bieding is helaas al gesloten.</p>
        </div>
        <div class="actions">
            <div class="ui green ok inverted button">
                <i class='checkmark icon'></i>
                Okay
            </div>
        </div>
    </div>
<?php }

// User has everything
else { ?>
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
<?php }
?>