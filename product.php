<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
include INCLUDES . 'head.inc.php';

// Check which product
if (isset($_GET['p'])) {
    $productID = escape($_GET['p']);
} else {
    Message::error('index.php', array(
        'm' => 'Product bestaat niet'
    ));
}

// Get data from database
$thisItem = Database::getInstance()->query("SELECT * FROM Items WHERE id = $productID", array());
$thisUser = Database::getInstance()->query("SELECT * FROM Users where username = '". $thisItem->first()->trader ."'", array());
$rubriek = Database::getInstance()->query("SELECT * FROM Categories WHERE id = '". $thisItem->first()->category . "'", array());

// Figure out highest bid
$bidHigh = Database::getInstance()->query("SELECT TOP 1 amount FROM Bids WHERE item = $productID ORDER BY amount DESC",array());

// Check if bid is still open
$bidClosed = Database::getInstance()->query("SELECT closed FROM Items WHERE id = $productID",array());

// Check if bid exists in database
$bidExists = Database::getInstance()->query("SELECT amount FROM Bids WHERE item = $productID",array());

// Get all bids
$bidAll = Database::getInstance()->query("SELECT TOP (5) * FROM Bids WHERE item = $productID ORDER BY amount DESC",array());

// Check if product exists
if ($thisItem->count() == false) {
    Message::error('index.php', array(
        'm' => 'Product bestaat niet'
    ));
}

// Calculate time left in offer
$currentDate = new DateTime(date("Y-m-d"));
$currentTime = new DateTime(strftime("%H:%M:%S"));

$endDate = new DateTime($thisItem->first()->durationenddate);
$endTime = new DateTime($thisItem->first()->durationendtime);

$timeLeft = $currentDate->diff($endDate)->format("%d");

if ($endDate > $currentDate) {

} else {
    //close item
    if($endTime <= $currentTime) {
        if(!$thisItem->first()->closed) {
            if($bidExists->count() >= 1) {
                Database::getInstance()->update("Items", "id", "$productID", array(
                    'closed' => true,
                    'saleprice' => $bidHigh->first()->amount
                ));
            }

            Database::getInstance()->update("Items", "id", "$productID", array(
                'closed' => true
            ));
        }
    }
}

include FUNCTIONS . 'makeBid.func.php';
include INCLUDES . 'modals/makeBid.inc.php';
include INCLUDES . 'modals/contactseller.inc.php';
include FUNCTIONS . 'admin.func.php';
?>

    <main>
        <div class="ui container">
            <div class="ui stackable two column grid">
                <div class="column">
                    <h2><?php echo escape($thisItem->first()->title) ?></h2>
                </div>

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
            </div>

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
                    <?php $images = Database::getInstance()->query("SELECT * FROM Files WHERE item = '". $thisItem->first()->id ."'"); ?>
                    <div class="product-gallery">
                        <div class="product-image">
                            <img class="active" src="<?= $images->first()->filename; ?>">
                        </div>
                        <ul class="image-list">
                            <?php
                            if($images->count() > 1) {
                                foreach($images->results() as $image) { ?>
                                    <li class="image-item"><img src="<?php echo $image->filename; ?>"></li>
                            <?php }
                            } ?>
                        </ul>
                    </div>
                </div>
                <div class="eight wide column">
                    <div class="ui segment">
                        <h2>Beschrijving</h2>

                        <p><?php echo $thisItem->first()->description ?></p>
                        <em>Geplaatst door: <a href="profile.php?user=<?php echo $thisUser->first()->id ?>">
                                <?php
                                if(empty($thisUser->first()->firstname) || empty($thisUser->first()->lastname)) {
                                    echo escape($thisUser->first()->username);
                                } else {
                                    echo escape($thisUser->first()->firstname) . ' ' . escape($thisUser->first()->lastname);
                                }
                                ?>
                            </a></em><br><br>

                        <?php if(!$thisItem->first()->closed) { ?>
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
                        <?php } ?>

                        <?php if(!$thisItem->first()->closed) { ?>
                        <p><span class="bold">Tijd over om te bieden: </span>
                            <?php
                            if($timeLeft <= 0) {
                                echo '<span id="timer"></span>';
                            } else {
                                echo $timeLeft . ' dagen';
                            }
                            ?>

                            </p>
                        <?php
                        } else if($bidExists->count() >= 1) {
                            ?>
                            <p><span class="bold">Dit artikel is gesloten voor biedingen</span></p>
                            <p>En is verkocht voor: € <?= $thisItem->first()->saleprice; ?></p>
                            <p><em>Exclusief €<?= escape($thisItem->first()->shippingcost) ?> verzendkosten</em></p>

                        <?php
                        } else {
                            echo '<p><span class="bold">Dit artikel is gesloten voor biedingen, maar heeft geen biedingen ontvangen</span></p>';
                        }
                        ?>
                        <!-- bidding -->
                        <?php if ($thisItem->first()->closed != false || Session::exists('username') != $thisItem->first()->trader) { ?>
                        <div class="ui input labeled input">
                            <button type="submit" id="makeOffer" class="ui primary labeled icon button">
                                <i class="gavel icon"></i>
                                Bieden
                            </button>
                        </div>
                        <?php } ?>

                        <!-- contact -->
                        <div class="ui input labeled input">
                            <button type="submit" id="contactSeller" class="ui primary labeled icon button">
                                <i class="envelope icon"></i>
                                Neem contact op
                            </button>
                        </div>
                    </div>


                    <div class="ui segment">
                        <h3>Biedingen</h3>
                        <ul class="bidlist">
                        <?php foreach($bidAll->results() as $bid) { ?>

                            <li><span><?= $bid->username; ?></span> <span>€ <?= $bid->amount; ?></span></li>

                        <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>

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

<?php if($timeLeft <= 0) { ?>
    <script>
        // Set the date we're counting down to
        var countDownDate = new Date("<?= date('F j\, Y'); ?> <?= $thisItem->first()->durationendtime ?>").getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {

            // Get today's date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Display the result in the element with id="demo"
            document.getElementById("timer").innerHTML = hours + "h "
                + minutes + "m " + seconds + "s ";

            // If the count down is finished, write some text
            if (distance < 0) {
                clearInterval(x);
                location.reload();
            }
        }, 1000);
    </script>
<?php } ?>
<?php include INCLUDES . 'footer.inc.php'; ?>
<?php include INCLUDES . 'foot.inc.php'; ?>