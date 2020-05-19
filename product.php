<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
include INCLUDES . 'head.inc.php';

// Check which product
if (isset($_GET['p'])) {
    $productID = escape($_GET['p']);
} else {
    Redirect::to('index.php');
}

// Get data from database

$thisItem = Database::getInstance()->query("SELECT * FROM Items WHERE id = $productID",array());
$rubriek = Database::getInstance()->query("SELECT * FROM Categories WHERE id = '". $thisItem->first()->category . "'", array());

// Calculate time left in offer
$currentDate = new DateTime(date("Y-m-d"));
$endDate = new DateTime($thisItem->first()->durationenddate);
if ($endDate > $currentDate) {
    $timeLeft = $currentDate->diff($endDate)->format("%d");
} else {
    $timeLeft = 0;
}

// Figure out highest bid
$bidHigh = Database::getInstance()->query("SELECT TOP 1 amount FROM Bids WHERE item = $productID ORDER BY amount DESC",array());

// Check if bid is still open
$bidClosed = Database::getInstance()->query("SELECT closed FROM Items WHERE id = $productID",array());

// Check if bid exists in database
$bidExists = Database::getInstance()->query("SELECT amount FROM Bids WHERE item = $productID",array());

include FUNCTIONS . 'makeBid.func.php';
include INCLUDES . 'modals/makeBid.inc.php';
include INCLUDES . 'modals/contactseller.inc.php';
?>

    <main>
        <div class="ui container">

            <h2><?php echo escape($thisItem->first()->title) ?></h2>
            <div class="vertical-margin-12">
                <div class="ui breadcrumb">
                    <a href="index.php" class="section">Home</a>
                    <div class="divider"> / </div>
                    <a href="categories.php" class="section">Categorieën</a>
                    <div class="divider"> / </div>
                    <div class="active section"><?= escape($rubriek->first()->name); ?></div>
                </div>
            </div>

            <div class="ui stackable grid" >
                <div class="eight wide column">
                    <img class="ui centered image" style="max-width: 100%; max-height: 450px;"  src="<?= ROOT . $thisItem->first()->thumbnail; ?>" >
                </div>
                <div class="eight wide column">
                    <div class="ui segment">
                        <h2>Beschrijving</h2>

                        <p><?php echo $thisItem->first()->description ?></p>

                        <p>v.a. <span class="bold">€
                                <?php
                                if ($bidExists->count() >= 1) {
                                    echo $bidHigh->first()->amount;
                                } else {
                                    echo escape($thisItem->first()->price);
                                }
                                ?>
                            </span> <br>
                        <em>Exclusief €<?= escape($thisItem->first()->shippingcost) ?> verzendkosten</em></p>

                        <p><span class="bold">Tijd over om te bieden:</span> <?= $timeLeft ?> dagen</p>

                        <!-- bidding -->
                        <div class="ui input labeled input">
                            <button type="submit" id="makeOffer" class="ui primary labeled icon button">
                                <i class="gavel icon"></i>
                                Bieden
                            </button>
                        </div>

                        <!-- contact -->
                        <div class="ui input labeled input">
                            <button type="submit" id="contactSeller" class="ui primary labeled icon button">
                                <i class="envelope icon"></i>
                                Neem contact op
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            $randomCatProducts = Database::getInstance()->query("SELECT TOP 5 * FROM Items WHERE NOT id = $productID AND category = '".escape($rubriek->first()->id)."' ORDER BY NEWID()");

            // If the current category has >= 5 products show them
            if($randomCatProducts->count() >= 5) {
            ?>
            <div class="ui segment">
                <h2>Meer zoals</h2>
                <!-- Includes the functions random products to pick -->
                <div class="ui stackable five column grid">
                    <?php
                    foreach($randomCatProducts->results() as $result) { ?>
                        <div class="column">
                            <div class="ui fluid card product productcards">
                                <a class="image" href="product.php?p=<?= escape($result->id); ?>">
                                    <img src="<?= ROOT . $result->thumbnail; ?>" alt="Foto van <?= escape($result->title); ?>">
                                </a>
                                <div class="content">
                                    <a class="header" href="product.php?p=<?= escape($result->id); ?>"><?= escape($result->title); ?></a>
                                    <div class="description"><?= escape($result->description); ?></div>
                                    <div class="description bold">€<?= escape($result->price); ?></div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>

        <?php } // if  the current category has < 5 products show random products
            elseif ($randomCatProducts->count() < 5) {
                $randomProducts = Database::getInstance()->query("SELECT TOP 5 * FROM Items WHERE NOT id = $productID ORDER BY NEWID()");

                // if there are no products, show none
                if ($randomProducts->count() < 1) {
                } else {

                ?>

                <div class="ui segment">
                    <h2>Meer zoals</h2>
                    <!-- Includes the functions random products to pick -->
                    <div class="ui stackable five column grid">
                        <?php
                        foreach($randomProducts->results() as $result) { ?>
                            <div class="column">
                                <div class="ui fluid card product productcards">
                                    <a class="image" href="product.php?p=<?= escape($result->id); ?>">
                                        <img src="<?= ROOT . $result->thumbnail; ?>" alt="Foto van <?= escape($result->title); ?>">
                                    </a>
                                    <div class="content">
                                        <a class="header" href="product.php?p=<?= escape($result->id); ?>"><?= escape($result->title); ?></a>
                                        <div class="description"><?= escape($result->description); ?></div>
                                        <div class="description bold">€<?= escape($result->price); ?></div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <?php } } ?>
        </div>
    </main>

<?php include INCLUDES . 'footer.inc.php'; ?>
<?php include INCLUDES . 'foot.inc.php'; ?>