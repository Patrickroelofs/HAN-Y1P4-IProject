<?php
//======================================================================
// Offer
//======================================================================
// Figure out highest bid
$bidHigh = Database::getInstance()->query("SELECT TOP 1 bodbedrag FROM Bod WHERE voorwerpnummer = $productID ORDER BY bodbedrag DESC",array());

// Check if bid is still open
$bidClosed = Database::getInstance()->query("SELECT gesloten FROM Voorwerp WHERE voorwerpnummer = $productID",array());

// Is submit pressed?
if(isset($_POST['offer-submit'])) {
    $username = Session::get('username');

    // Save data in temporary variables
    $amount = $_POST['amount'];

    if($amount < $startPrice){
        echo "Bedrag te laag";
    }
    // Check if amount is bigger than startprice
    elseif (isset($bidHigh->first()->bodbedrag) && $amount < $bidHigh->first()->bodbedrag) {
        echo "Bedrag is te laag";
    }
    // Check if amount is smaller than 10x the highest bid
    elseif (isset($bidHigh->first()->bodbedrag) && $amount > $bidHigh->first()->bodbedrag*10) {
        echo "Bedrag is te hoog";
    }
    else {
        //Insert into database
        try {
            $stmt = Database::getInstance()->query("INSERT INTO Bod (voorwerpnummer, bodbedrag, gebruiker) VALUES ($productID, $amount, '".Session::get('username')."')",array());

            Redirect::to('index.php');

        } catch (PDOException $e) {
            //Error during insert
            echo $e->getMessage();
        }
    }
}