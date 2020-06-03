<!-- open products with bids -->
<div class="section">
    <h2>Open biedingen</h2>

    <?php
    $userBids = Database::getInstance()->query("SELECT * FROM Bids WHERE username = '". Session::get('username') . "' ORDER BY date, time DESC");

    if ($userBids->count() <= 0) {
        echo "U heeft nog geen biedingen uitgebracht";
    } else { ?>
        <div class="ui stackable five column grid">
        <?php foreach ($userBids->results() as $bid) {
            $product = Database::getInstance()->query("SELECT * FROM Items WHERE id = $bid->item AND closed = 'false' AND hidden = 'false'");
            if (!empty($product->count() >= 1)) {
                $highBid = Database::getInstance()->query("SELECT TOP 1 * FROM Bids WHERE item = $bid->item ORDER BY amount DESC"); ?>
                <div class="column">
                    <div class="ui fluid card">
                        <a class="image" href="product.php?p=<?= $product->first()->id; ?>">
                            <img src="<?= ROOT . $product->first()->thumbnail; ?>" alt="Foto van <?= $product->first()->title; ?>">
                        </a>
                        <div class="content">
                            <a class="header" href="product.php?p=<?= $product->first()->id; ?>"><?= $product->first()->title; ?></a>
                            <div class="description"><span class="bold">Tijd over: </span><span data-countdown="<?= $product->first()->durationenddate ?> <?= $product->first()->durationendtime ?>"></span></div>
                            <?php if ($highBid->first()->amount != $bid->amount) { ?>
                                <div class="description"><span class="bold">Hoogste bod: </span>€<?= $highBid->first()->amount ?></div>
                            <?php } ?>
                            <div class="description"><span class="bold">Mijn bod: </span>€<?= $bid->amount ?> </div>
                        </div>
                    </div>
                </div>
        <?php }
        }
        ?>
    </div>
    <?php
        } ?>
</div>


<br><br>


<!-- closed products where buyer is user -->
<div class="section">
    <h2>Gewonnen biedingen</h2>

    <?php
    $userWins = Database::getInstance()->query("SELECT * FROM Items WHERE buyer = '". Session::get('username') . "' AND hidden = 'false'");

    if ($userWins->count() <= 0) {
        echo "U heeft nog geen biedingen gewonnen";
    } else { ?>
        <div class="ui stackable five column grid">
            <?php
            foreach ($userWins->results() as $product) {
                $getSeller = Database::getInstance()->query("SELECT * FROM Users where username = '".$product->trader."'"); ?>
                <div class="column">
                    <div class="ui fluid card">
                        <a class="image" href="product.php?p=<?= $product->id; ?>">
                            <img src="<?= ROOT . $product->thumbnail; ?>" alt="Foto van <?= $product->title; ?>">
                        </a>
                        <div class="content">
                            <a class="header" href="product.php?p=<?= $product->id; ?>"><?= $product->title; ?></a>
                            <div class="description bold">Gekocht voor € <?= $product->saleprice ?></div>
                            <div class="description"><span class="bold">Verkoper: </span> <a href="profile.php?user=<?= $getSeller->first()->id ?>"><?= $product->trader ?></a></div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
</div>