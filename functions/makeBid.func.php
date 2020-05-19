<?php
//======================================================================
// Offer
//======================================================================

// Is submit pressed?
if(isset($_POST['offer-submit'])) {

    $bidHigh = Database::getInstance()->query("SELECT TOP 1 amount FROM Bids WHERE item = $productID ORDER BY amount DESC",array());
    $bidClosed = Database::getInstance()->query("SELECT closed FROM Items WHERE id = $productID",array());
    $bidExists = Database::getInstance()->query("SELECT amount FROM Bids WHERE item = $productID",array());

    // Save data in temporary variables
    $amount = escape($_POST['amount']);

    if($amount <= $thisItem->first()->price){
        // error message
        Message::errorMulti('product.php?p='.$productID.'', array(
            'm' => 'Bedrag is lager dan de startprijs'
        ));

    } else if ($bidExists->count() >= 1 && $amount <= $bidHigh->first()->amount) {
        // error message
        Message::errorMulti('product.php?p='.$productID.'', array(
            'm' => 'Bedrag is te laag'
        ));

    } else {
        //Insert into database
        try {
            $bidInsert = Database::getInstance()->query("INSERT INTO Bids (item, amount, username) VALUES ($productID, $amount, '".Session::get('username')."')",array());
            $thisID = $thisItem->first()->id;

            header("Location:product.php?p=$thisID&notice&m=Uw bod is uitgebracht!");

        } catch (PDOException $e) {
            //Error during insert
            echo $e->getMessage();
        }

        // succes message
        Message::noticeMulti('product.php?p='.$productID.'', array(
            'm' => 'Bieding succesvol'
        ));
    }
}