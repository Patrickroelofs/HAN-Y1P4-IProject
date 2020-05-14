<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
include INCLUDES . 'head.inc.php';

// Check which product
if (isset($_GET['p'])) {
    $productID = $_GET['p'];
} else {
    Redirect::to('index.php');
}

// Get data from database
$stmt = Database::getInstance()->query("SELECT * FROM Voorwerp WHERE voorwerpnummer = $productID",array());

// Calculate time left in offer
$currentDate = new DateTime(date("Y-m-d"));
$endDate = new DateTime($stmt->first()->looptijdeindedag);
if ($endDate > $currentDate) {
    $timeLeft = $currentDate->diff($endDate)->format("%d");
} else {
    $timeLeft = 0;
}

include FUNCTIONS . 'makeOffer.func.php';
include INCLUDES . 'modals/makeoffer.inc.php';
include INCLUDES . 'modals/contactseller.inc.php';
?>

    <main>
        <div class="ui container">

            <h2><?php echo $stmt->first()->titel ?></h2>
            <div class="vertical-margin-12">
                <div class="ui label">
                    <i>Lorem Ipsum</i>
                </div>
                <div class="ui label">
                    <i>Lorem Ipsum</i>
                </div>
                <div class="ui label">
                    <i>Lorem Ipsum</i>
                </div>
            </div>

            <div class="ui stackable grid" >
                <div class="eight wide column">
                    <img class="fluid image" src="http://iproject19.icasites.nl/pics/dt_1_<?= $stmt->first()->thumbnail; ?>" >
                </div>
                <div class="eight wide column">
                    <div class="ui segment">
                        <h2>Beschrijving</h2>

                        <p><?php echo $stmt->first()->beschrijving ?></p>

                        <p>v.a. <span class="bold">€<?php echo $stmt->first()->startprijs ?></span> </p>

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
                    $randomProducts = Database::getInstance()->query("SELECT TOP 5 * FROM Voorwerp ORDER BY NEWID()");

                    if ($randomProducts->count() < 1) {
                        // no data passed by get
                        echo "<p>Geen resultaten</p>";
                    }

                    foreach($randomProducts->results() as $result) { ?>
                        <div class="column">
                            <div class="ui fluid card productcards">
                                <a class="image" href="product.php?p=<?= $result->voorwerpnummer; ?>">
                                    <img src="http://iproject19.icasites.nl/pics/dt_1_<?= $result->thumbnail; ?>" alt="Foto van <?= $result->titel; ?>">
                                </a>
                                <div class="content">
                                    <a class="header" href="product.php?p=<?= $result->voorwerpnummer; ?>"><?= $result->titel; ?></a>
                                    <div class="description"><?= $result->beschrijving; ?></div>
                                    <div class="description bold">€<?= $result->startprijs; ?></div>
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