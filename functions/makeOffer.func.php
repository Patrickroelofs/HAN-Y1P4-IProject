<?php
//======================================================================
// Offer
//======================================================================
$productID = '1';

// Check if user has filled in all credentials
if(Session::exists('username')) {
    try {
        $stmt = Database::getInstance()->query("SELECT compleet FROM Gebruiker WHERE gebruikersnaam = '".Session::get('username')."' ",array());

        if($stmt->first()->compleet == 1) {
            $completedProfile = 1;
        } else {
            $completedProfile = 0;
        }
    } catch (PDOException $e) {
        //Error during select
        echo $e->getMessage();
    }
}

// Figure out highest bid
$highestBid = '0';

try {
    $stmt = Database::getInstance()->query("SELECT TOP 1 bodbedrag FROM Bod WHERE voorwerpnummer = '1' ORDER BY bodbedrag DESC",array());

    foreach($stmt->results() as $result) {
        $highestBid = $result->bodbedrag;
    }
} catch (PDOException $e) {
    //Error during insert
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
    } else {
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