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
                    <img class="fluid image" src="<?= ROOT . $thisItem->first()->thumbnail; ?>" >
                </div>
                <div class="eight wide column">
                    <div class="ui segment">
                        <h2>Beschrijving</h2>

                        <p><?php echo $thisItem->first()->description ?></p>

                        <p>v.a. <span class="bold">€<?php echo escape($thisItem->first()->price) ?></span> </p>

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

            <div class="ui segment">
                <h2>Meer zoals</h2>
                <!-- Includes the functions random products to pick -->
                <div class="ui stackable five column grid">
                    <?php
                    $randomProducts = Database::getInstance()->query("SELECT TOP 5 * FROM Items WHERE NOT id = $productID ORDER BY NEWID()");

                    if ($randomProducts->count() < 1) {
                        // no data passed by get
                        echo "<p>Geen resultaten</p>";
                    }

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

        </div>
    </main>

<?php include INCLUDES . 'footer.inc.php'; ?>
<?php include INCLUDES . 'foot.inc.php'; ?>