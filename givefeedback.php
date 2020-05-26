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

//Check if the product auction has been closed. If not direct user to index.php with the according error.
if (!$thisItem->first()->closed) {
    // echo("Product is gesloten voor nieuwe biedingen");
    Message::error('index.php', array(
        'm' => 'Product bestaat niet'
    ));
}
?>

<main>
    <div class="ui container">
        <?php
        if(isset($_POST['feedback-submit'])) {

            //Data to insert into the database
            $productID = escape($_GET['p']);
            $review = escape($_POST['review']);
            $feedback = escape($_POST['feedback']);

            // Insert the feedback into the database
            try {
                $stmt = Database::getInstance()->insert('Feedback', array(
                    'username' => $thisItem->first()->trader,
                    'item' => $productID,
                    'review' => $review,
                    'comment' => $feedback

                ));
            } catch (PDOException $e) {
                echo $e;
            }
        }
        ?>
        <h1>Geef uw feedback!</h1>
        <p>U heeft recentelijke het product <?= ($thisItem->first()->title) ?> aangeschaft van de gebruiker <?= ($thisItem->first()->trader) ?>.</p>
        <p>Wij zijn graag benieuwd naar uw ervaring met <?= ($thisItem->first()->trader) ?>. Hieronder kunt u uw ervaring met <?= ($thisItem->first()->trader) ?> doorgeven.</p>
        <form action="" method="post" class="ui form">
            <div class="field">
                <label for="review">Beoordeling *</label>
                <div class="ui selection dropdown fluid">
                    <input type="hidden" name="review" id="review" required>
                    <i class="dropdown icon"></i>
                    <div class="default text">Beoordeling</div>
                    <div class="menu">
                        <div class="item" data-value="negative">Negative</div>
                        <div class="item" data-value="neutral">Neutral</div>
                        <div class="item" data-value="positive">Positive</div>
                    </div>
                </div>
            </div>
            <div class="field">
                <label for="feedback">Feedback *</label>
                <textarea required name="feedback" id="feedback" placeholder="Feedback"></textarea>
            </div>
            <button name="feedback-submit" id="feedback-submit" class="ui button" type="submit">Verstuur feedback</button>
        </form>
    </div>
</main>

<?php include INCLUDES . 'footer.inc.php'; ?>
<?php include INCLUDES . 'foot.inc.php'; ?>