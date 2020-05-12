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
try {
    $stmt = Database::getInstance()->query("SELECT * FROM Voorwerp WHERE voorwerpnummer = $productID",array());

    foreach($stmt->results() as $result) {
        $title = $result->titel;
        $description = $result->beschrijving;
        $startPrice = $result->startprijs;
    }
} catch (PDOException $e) {
    //Error during insert
    echo $e->getMessage();
}

include FUNCTIONS . 'makeOffer.func.php';
include INCLUDES . 'modals/makeoffer.inc.php';
include INCLUDES . 'modals/contactseller.inc.php';
?>

    <main>
        <div class="ui container">

            <h2><?php echo $title ?></h2>
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

            <div class="ui grid" >
                <div class="eight wide column">
                    <img src="https://place-hold.it/400x400">
                </div>
                <div class="eight wide column">
                    <div class="ui segment">
                        <h2>Beschrijving</h2>
                        <p><?php echo $description ?></p>

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
                <div class="ui grid">
                    <div class="two wide column">
                        <img src="https://place-hold.it/90x90">
                    </div>
                    <div class="two wide column">
                        <img src="https://place-hold.it/90x90">
                    </div>
                    <div class="two wide column">
                        <img src="https://place-hold.it/90x90">
                    </div>
                    <div class="two wide column">
                        <img src="https://place-hold.it/90x90">
                    </div>
                    <div class="two wide column">
                        <img src="https://place-hold.it/90x90">
                    </div>
                    <div class="two wide column">
                        <img src="https://place-hold.it/90x90">
                    </div>
                    <div class="two wide column">
                        <img src="https://place-hold.it/90x90">
                    </div>
                    <div class="two wide column">
                        <img src="https://place-hold.it/90x90">
                    </div>
                </div>
            </div>

        </div>
    </main>

<?php include INCLUDES . 'footer.inc.php'; ?>
<?php include INCLUDES . 'foot.inc.php'; ?>