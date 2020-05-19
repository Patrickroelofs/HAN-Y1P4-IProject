<?php
//======================================================================
// Offer
//======================================================================
// Figure out highest bid
$bidHigh = Database::getInstance()->query("SELECT TOP 1 amount FROM Bids WHERE item = $productID ORDER BY amount DESC",array());

// Check if bid is still open
$bidClosed = Database::getInstance()->query("SELECT closed FROM Items WHERE id = $productID",array());

// Check if bid exists in database
$bidExists = Database::getInstance()->query("SELECT amount FROM Bids WHERE item = $productID",array());

// Is submit pressed?
if(isset($_POST['offer-submit'])) {

    $bidHigh = Database::getInstance()->query("SELECT TOP 1 amount FROM Bids WHERE item = $productID ORDER BY amount DESC",array());
    $bidClosed = Database::getInstance()->query("SELECT closed FROM Items WHERE id = $productID",array());
    $bidExists = Database::getInstance()->query("SELECT amount FROM Bids WHERE item = $productID",array());

    // Save data in temporary variables
    $amount = escape($_POST['amount']);

    if($bidClosed->first()->closed == true) {
        echo "biedingen zijn gesloten";

    } else if($amount <= $stmt->first()->startprijs){
        echo "Bedrag lager dan de startprijs";

    } else if ($bidExists->count() >= 1 && $amount <= $bidHigh->first()->amount) {
        echo "Bedrag is te laag";

    } else {
        //Insert into database
        try {
            $bidInsert = Database::getInstance()->query("INSERT INTO Bids (item, amount, username) VALUES ($productID, $amount, '".Session::get('username')."')",array());

            Redirect::to('index.php');

        } catch (PDOException $e) {
            //Error during insert
            echo $e->getMessage();
        }
    }
}