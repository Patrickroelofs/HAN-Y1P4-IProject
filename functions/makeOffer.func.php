<?php
//======================================================================
// Offer
//======================================================================
if (isset($_GET['id'])) {
    $productID = $_GET['id'];
} else {
    Redirect::to('index.php');
}

// Figure out highest bid
try {
    $stmt = Database::getInstance()->query("SELECT TOP 1 bodbedrag FROM Bod WHERE voorwerpnummer = '1' ORDER BY bodbedrag DESC",array());

    foreach($stmt->results() as $result) {
        $highestBid = $result->bodbedrag;
    }
} catch (PDOException $e) {
    //Error during insert
    echo $e->getMessage();
}

// Check if bid is still open
try {
    $stmt = Database::getInstance()->query("SELECT gesloten FROM Voorwerp WHERE voorwerpnummer = $productID",array());

    $bidClosed = $stmt->first()->gesloten;
} catch (PDOException $e) {
    //Error during select
    echo $e->getMessage();
}

// Is submit pressed?
if(isset($_POST['offer-submit'])) {
    $username = Session::get('username');

    // Save data in temporary variables
    $amount = $_POST['amount'];

    // Check if amount is bigger than startprice
    if ($amount < $highestBid) {
        echo "Bedrag is te laag";
    }
    // Check if amount is smaller than 10x the highest bid
    elseif ($amount < $highestBid*10) {
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