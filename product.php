<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
include INCLUDES . 'head.inc.php';

// Check if product is filled in
if (isset($_GET['p'])) {
    $productID = escape($_GET['p']);
} else {
    Message::error('index.php', array(
        'm' => 'Product bestaat niet'
    ));
}

// Retrieve product info from db
$thisItem = Database::getInstance()->query("SELECT * FROM Items WHERE id = $productID", array());
// Figure out highest bid
$bidHigh = Database::getInstance()->query("SELECT TOP 1 * FROM Bids WHERE item = $productID ORDER BY amount DESC",array());
// Check if bid is still open
$bidClosed = Database::getInstance()->query("SELECT closed FROM Items WHERE id = $productID",array());
// Check if bid exists in database
$bidExists = Database::getInstance()->query("SELECT amount FROM Bids WHERE item = $productID",array());
// Get all bids
$bidAll = Database::getInstance()->query("SELECT TOP (5) * FROM Bids WHERE item = $productID ORDER BY amount DESC",array());

// Check if item is blocked
if ($thisItem->first()->hidden == true && Admin::isLoggedIn() == false) {
    Message::error('index.php', array(
        'm' => 'Product geblokkeerd door admin'
    ));
}

// Check if items exists in db
if ($thisItem->count() < 1) {
    Message::error('index.php', array(
        'm' => 'Product bestaat niet'
    ));
}

// Check if the product has been bought by the user
if(Session::exists('username')) {
    if (strtolower($thisItem->first()->buyer) != strtolower(Session::get('username')) && $thisItem->first()->closed) {
        if(strtolower($thisItem->first()->trader) != strtolower(Session::get('username'))) {
            Message::error('index.php', array(
                'm' => 'Een andere gebruiker heeft dit product gekocht'
            ));
        }
    }
} else {
    if($thisItem->first()->closed) {
        Message::error('index.php', array(
            'm' => 'Een andere gebruiker heeft dit product gekocht'
        ));
    }
}

// Calculate time left in offer
$currentDate = new DateTime(date("Y-m-d"));
$endDate = new DateTime($thisItem->first()->durationenddate);
$timeLeft = $currentDate->diff($endDate)->format("%d");

Trader::checkItems($thisItem->first()->trader);

include FUNCTIONS . 'makeBid.func.php';
include INCLUDES . 'modals/makeBid.inc.php';
include INCLUDES . 'modals/contactseller.inc.php';
include FUNCTIONS . 'admin.func.php';
?>

<main>
    <div class="ui container">
        <div class="ui stackable two column grid">
            <!-- Product title -->
            <div class="column">
                <h2><?= $thisItem->first()->title ?></h2>
            </div>

            <!-- Admin buttons -->
            <div class="column">
                <?php
                    //if an admin is logged in
                    if(Admin::isLoggedIn()) {
                        //if this banned user is false display banuser otherwise unbanuser.
                        if($thisItem->first()->hidden == false) {
                            ?>
                            <div class="column">
                                <form class="ui form vertical-margin-12" action="" method="post">
                                    <input type="submit" name="hideitem" id="hideitem" class="negative ui button" value="Blokkeer product">
                                </form>
                            </div>
                        <?php } else { ?>

                            <div class="column">
                                <form class="ui form vertical-margin-12" action="" method="post">
                                    <input type="submit" name="unhideitem" id="unhideitem" class="positive ui button" value="Deblokkeer product">
                                </form>
                            </div>
                            <?php
                        }
                    }
                ?>
            </div>

            <!-- Breadcrumbs with link to category -->
            <div class="vertical-margin-12">
                <div class="ui breadcrumb">
                    <?php $rubriek = Database::getInstance()->query("SELECT * FROM Categories WHERE id = '". $thisItem->first()->category . "'", array()); ?>
                    <a href="index.php" class="section">Home</a>
                    <div class="divider"> / </div>
                    <a href="categories.php" class="section">Categorieën</a>
                    <div class="divider"> / </div>
                    <div class="active section"><a href="category.php?cat=<?= $rubriek->first()->id ?>"> <?= escape($rubriek->first()->name); ?> </a></div>
                </div>
            </div>
        </div>

        <!-- Product information -->
        <div class="ui stackable grid">
            <!-- Product image(s) -->
            <div class="eight wide stackable column">
                <?php $images = Database::getInstance()->query("SELECT TOP 4 * FROM Files WHERE item = '". $thisItem->first()->id ."' ORDER BY NEWID()"); ?>
                <div class="product-gallery">
                    <div class="product-image">
                        <?php if (($images->count() <= 0)) {
                            $bigimage = "upload/highlightedCategories/nopic.png";
                        } else {
                            $bigimage = $images->first()->filename;
                        }?>
                        <img class="active" src="<?= $bigimage; ?>">
                    </div>
                    <ul class="image-list">
                        <?php // Check if there are multiple images
                        if($images->count() > 1) {
                            foreach($images->results() as $image) { ?>
                                <li class="image-item"><img src="<?php echo $image->filename; ?>"></li>
                            <?php }
                        } ?>
                    </ul>
                </div>
            </div>
            <!-- Product info & actions -->
            <div class="eight wide column">
                <div class="ui segment">
                    <?php $thisUser = Database::getInstance()->query("SELECT * FROM Users where username = '". $thisItem->first()->trader ."'", array()); ?>
                    <h2>Product info</h2>
                    <!-- Product trader, description -->
                    <p><strong>Geplaatst door:</strong>
                        <a href="profile.php?user=<?= $thisUser->first()->id ?>">
                            <?php // Check if user filled in first name & lastname
                                if(empty($thisUser->first()->firstname) || empty($thisUser->first()->lastname)) {
                                    echo escape($thisUser->first()->username);
                                } else {
                                    echo escape($thisUser->first()->firstname) . ' ' . escape($thisUser->first()->lastname);
                                }
                            ?>
                        </a><br>
                    <strong>Beschrijving:</strong> <?= $thisItem->first()->description ?></p>

                    <!-- Product price -->
                    <?php // Check if product is NOT closed
                        if (!$thisItem->first()->closed) { ?>
                            <p>v.a. <strong>€
                                    <?php
                                        if ($bidExists->count() >= 1) {
                                            echo $bidHigh->first()->amount;
                                        } else {
                                            echo escape($thisItem->first()->price);
                                        }
                                    ?></strong><br>
                            <!-- Product shipping cost -->
                            <em>Exclusief €<?= escape($thisItem->first()->shippingcost) ?> verzendkosten</em></p>
                            <!-- Time left -->
                            <p><strong>Tijd over om te bieden:</strong>
                                <span data-countdown="<?= $thisItem->first()->durationenddate ?> <?= $thisItem->first()->durationendtime ?>"></span>
                            </p>
                            <!-- Bidding -->
                            <?php // check if the user isn't the same as the trader
                            if (Session::exists('username') && strtolower(Session::get('username')) != strtolower($thisItem->first()->trader)) {
                                if(!$user->first()->trader) {
                                ?>
                                <div class="ui input labeled input">
                                    <button type="submit" id="makeOffer" class="ui primary labeled icon button">
                                        <i class="gavel icon"></i>
                                        Bieden
                                    </button>
                                </div>
                                <?php
                                }
                                    else {
                                        echo 'Een verkoper kan geen biedingen uitbrengen, gebruik een kopers-account <br><br>';
                                    }
                                } elseif (!Session::exists('username')) { ?>
                                <div class="ui input labeled input">
                                    <button type="submit" id="makeOffer" class="ui primary labeled icon button">
                                        <i class="gavel icon"></i>
                                        Bieden
                                    </button>
                                </div>
                            <?php } ?>
                            <!-- Contact -->
                            <?php
                            if(Session::exists('username')) {
                                if(strtolower(Session::get('username')) != strtolower($thisItem->first()->trader)) { ?>
                            <div class="ui input labeled input">
                                <button type="submit" id="contactSeller" class="ui primary labeled icon button">
                                    <i class="envelope icon"></i>
                                    Neem contact op
                                </button>
                            </div>
                            <?php }
                            } ?>
                        <?php } // Check if product IS closed
                            elseif ($thisItem->first()->closed) { ?>
                                <?php $buyer = Database::getInstance()->query("SELECT * FROM Users where username = '". $thisItem->first()->buyer ."'");
                                    if(!$buyer->count()  <= 0) {
                                ?>
                                <!-- Saleprice -->
                                <p><strong>Dit artikel is verkocht voor €<?= $thisItem->first()->saleprice ?></strong><br>
                                    aan: <a href="profile.php?user=<?= $buyer->first()->id ?>"><?= $thisItem->first()->buyer ?></a><br>
                                <!-- Product shipping cost -->
                                <em>Exclusief €<?= escape($thisItem->first()->shippingcost) ?> verzendkosten</em></p>
                                <!-- Contact -->
                                <?php if(strtolower(Session::get('username')) == strtolower($thisItem->first()->trader)) { ?>
                                <div class="ui input labeled input">
                                    <button type="submit" id="contactSeller" class="ui primary labeled icon button">
                                        <i class="envelope icon"></i>
                                        Neem contact op met koper
                                    </button>
                                </div>
                                <?php } else { ?>
                                    <div class="ui input labeled input">
                                        <button type="submit" id="contactSeller" class="ui primary labeled icon button">
                                            <i class="envelope icon"></i>
                                            Neem contact op met verkoper
                                        </button>
                                    </div>
                                    <?php } ?>
                            <?php } else echo '<br><br>Dit product is gesloten zonder biedingen.';
                        }
                        ?>
                </div>

                <!-- Recent bids -->
                <div class="ui segment">
                    <h3>Biedingen</h3>
                    <ul class="bidlist">
                        <?php
                        if ($bidAll->count() <= 0) {
                            echo 'Geen biedingen uitgebracht.';
                        }
                        ?>
                        <?php foreach($bidAll->results() as $bid) {
                            // Get link to user profile
                            $linkUser = Database::getInstance()->query("SELECT id FROM Users WHERE username = '$bid->username'",array());?>

                            <li><span><a href="profile.php?user=<?= $linkUser->first()->id ?>"><?= $bid->username; ?></a></span> <span>€ <?= $bid->amount; ?></span></li>

                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Show related products, if they exist -->
        <?php
        $randomCatProducts = Database::getInstance()->query("SELECT TOP 5 * FROM Items WHERE NOT id = $productID AND category = '".escape($rubriek->first()->id)."' ORDER BY NEWID()");

        // If the current category has >= 5 products show them
        if($randomCatProducts->count() >= 5) {
            ?>
            <div class="ui segment">
                <h2>Meer uit <?= escape($rubriek->first()->name) ?></h2>
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
                                    <div class="description"><?= Modifiers::textlength(escape($result->description), 100); ?></div>
                                    <em data-countdown="<?= $result->durationenddate ?> <?= $result->durationendtime ?>"></em>
                                    <div class="description bold">€<?= escape($result->price); ?></div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>

        <?php } // if  the current category has < 5 products show random products
        elseif ($randomCatProducts->count() < 5) {
            $randomProducts = Database::getInstance()->query("SELECT TOP 5 * FROM Items WHERE NOT id = $productID AND NOT hidden = 'true' AND NOT closed = 'true' ORDER BY NEWID()");

            // if there are no products, show none
            if ($randomProducts->count() < 1) {

            } else {

                ?>

                <div class="ui segment">
                    <h2>Andere producten</h2>
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
                                        <div class="description"><?= escape(Modifiers::textlength($result->description, 100)); ?>...</div>
                                        <em data-countdown="<?= $result->durationenddate ?> <?= $result->durationendtime ?>"></em>
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

<!-- Javascript countdown timer -->
<?php if($timeLeft <= 0 && $thisItem->first()->closed != true) { ?>
    <script>
        // Set the date we're counting down to
        var countDownDate = new Date("<?= date('F j\, Y'); ?> <?= $thisItem->first()->durationendtime ?>").getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {

            // Get today's date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            if (distance <= 0) {
                clearInterval(x);
                location.reload();
            }
        }, 1000);
    </script>
<?php } ?>

<?php
include INCLUDES . 'footer.inc.php';
include INCLUDES . 'foot.inc.php'; ?>
