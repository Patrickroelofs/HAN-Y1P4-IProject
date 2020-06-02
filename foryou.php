<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
    include INCLUDES . 'head.inc.php';

    if(!Session::exists('username')){
        Redirect::to('index.php');
    }
?>

<main>
    <div class="ui container">
        <?php if ($user->first()->trader) { // if the user IS a trader
            $traderProducts = Database::getInstance()->query("SELECT * FROM Items WHERE trader = '". Session::get('username') . "' AND closed = 'false' AND hidden = 'false' ORDER BY durationbegindate, durationbegintime DESC", array()); ?>

            <!-- open auctions -->
            <div class="section">
                <h2 id="yourAuctions">Lopende advertenties</h2>

                <?php if ($traderProducts->count() <= 0) {
                    echo '<p>Geen lopende advertenties gevonden...</p>';
                    } else { ?>
                    <div class="ui stackable five column grid">
                        <?php
                        foreach ($traderProducts->results() as $product) {
                            $productBids = Database::getInstance()->query("SELECT * FROM Bids WHERE item = $product->id ORDER BY amount DESC"); ?>
                            <div class="column">
                            <div class="ui fluid card">
                                <a class="image" href="product.php?p=<?= $product->id; ?>">
                                    <img src="<?= ROOT . $product->thumbnail; ?>" alt="Foto van <?= $product->title; ?>">
                                </a>
                                <div class="content">
                                    <a class="header" href="product.php?p=<?= $product->id; ?>"><?= $product->title; ?></a>
                                    <div class="description"><span class="bold">Tijd over: </span><span data-countdown="<?= $product->durationenddate ?> <?= $product->durationendtime ?>"></span></div>
                                    <div class="description"><span class="bold">Aantal biedingen: </span> <?php
                                        if ($productBids->count() <= 0) { // if there are NO bids ?>
                                            0 </div>
                                            <div class="description"><span class="bold">Startprijs: </span> <?= $product->price ?></div>
                                        <?php } else { ?>
                                                <?= $productBids->count() ?> </div>
                                                <div class="description"><span class="bold">Hoogste bod: </span> <?= $productBids->first()->amount ?></div>
                                        <?php } ?>
                                </div>
                            </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>

            <?php
            $traderProducts = Database::getInstance()->query("SELECT * FROM Items WHERE trader = '". Session::get('username') . "' AND closed = 'true' AND hidden = 'false' ORDER BY durationbegindate, durationbegintime DESC", array()); ?>
            <!-- closed auctions -->
            <div class="section">
                <h2>Gesloten advertenties</h2>

                <?php if ($traderProducts->count() <= 0) {
                    echo '<p>Geen gesloten advertenties gevonden...</p>';
                } else { ?>
                    <div class="ui stackable five column grid">
                        <?php
                        foreach ($traderProducts->results() as $product) {
                            $buyer = Database::getInstance()->query("SELECT * FROM Users WHERE username = '".$product->buyer."'") ?>
                            <div class="column">
                                <div class="ui fluid card">
                                    <a class="image" href="product.php?p=<?= $product->id; ?>">
                                        <img src="<?= ROOT . $product->thumbnail; ?>" alt="Foto van <?= $product->title; ?>">
                                    </a>
                                    <div class="content">
                                        <a class="header" href="product.php?p=<?= $product->id; ?>"><?= $product->title; ?></a>
                                        <?php if ($product->saleprice) { // if product had biddings ?>
                                            <div class="description bold">Verkocht voor € <?= $product->saleprice ?></div>
                                            <div class="description"><span class="bold">Koper: </span><a href="profile.php?user=<?= $buyer->first()->id ?>"><?= $product->buyer ?></a></div>
                                        <?php } else { // if product didn't have any biddings ?>
                                            <div class="description bold">Gesloten zonder biedingen</div>
                                            <div class="description">Volgende keer beter!</div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <?php } ?>
            </div>
        <?php } else { // if the user is NOT a trader ?>
            <!-- open products with bids -->
            <div class="section">
                <h2>Open biedingen</h2>
            </div>

            <!-- closed products where buyer is user -->
            <div class="section">
                <h2>Gewonnen biedingen</h2>
            </div>
        <?php } ?>
    </div>
</main>

<?php include INCLUDES . 'footer.inc.php'; ?>
<?php include INCLUDES . 'foot.inc.php'; ?>