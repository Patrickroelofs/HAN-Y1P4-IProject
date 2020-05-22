<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
include INCLUDES . 'head.inc.php';
?>

<main>
    <div class="ui container">
        <h2>Jouw biedingen</h2>
        <div class="ui stackable five column grid">
            <?php

            //getting all bids
            $yourBids = Database::getInstance()->query("SELECT * FROM Bids WHERE username = '".Session::get('username')."' ORDER BY date DESC");

            if ($yourBids->count() <= 0) {
                // no data passed by get
                echo "<p>Geen biedingen gevonden...</p>";
            }

            foreach($yourBids->results() as $yourBid) {
                $result = Database::getInstance()->query("SELECT * FROM Items WHERE id = $yourBid->item");
                ?>
                <div class="column">
                    <div class="ui fluid card productcards">
                        <a class="image" href="product.php?p=<?= $result->first()->id; ?>">
                            <img src="<?= ROOT . $result->first()->thumbnail; ?>" alt="Foto van <?= $result->first()->title; ?>">
                        </a>
                        <div class="content">
                            <a class="header" href="product.php?p=<?= $result->first()->id; ?>"><?= $result->first()->title; ?></a>
                            <div class="description"><?= escape(Modifiers::textlength($result->first()->description, 100)); ?>...</div>
                            <div class="description bold">€<?= $yourBid->amount; ?></div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</main>

<?php include INCLUDES . 'footer.inc.php'; ?>
<?php include INCLUDES . 'foot.inc.php'; ?>

