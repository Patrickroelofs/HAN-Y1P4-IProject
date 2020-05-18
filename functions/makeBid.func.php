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

    // Save data in temporary variables
    $amount = $_POST['amount'];

    // Check if amount is less than starting price
    if($amount < $stmt->first()->startprijs){
        echo "Bedrag lager dan de startprijs";
    }

    // Check if product exists in bid table and
    // bid is less than the current highest bid
    elseif ($bidExists->count() == 1 && $amount < $bidHigh->first()->bodbedrag) {
        echo "Bedrag is te laag";
    }

    // Check if product exists in bid table and
    // bid is more than 10* the current bid
    elseif ($bidExists->count() == 1 && $amount > $bidHigh->first()->bodbedrag*10) {
        echo "Bedrag is te hoog";
    }

    // Everything is correct
    else {
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