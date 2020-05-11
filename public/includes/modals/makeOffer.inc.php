<?php //include FUNCTIONS . 'makeOffer.func.php'
?>

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
                <div class="ui input labeled input">
                    <label for="amount" class="ui label">€</label>
                    <input type="text" placeholder="Uw bod" name="amount">
                </div>
            </form>
        </div>
    </div>
    <div class="actions">
        <div class="ui input labeled input">
            <button type="submit" form="offer-form" name="offer-submit" class="ui teal labeled icon button">
                <i class="gavel icon"></i>
                Bieden
            </button>
        </div>
    </div>
</div>