<?php
//======================================================================
// Offer
//======================================================================

// Is submit pressed?
if(isset($_POST['offer-submit'])) {

    // TODO take product id
    // Save data in temporary variables
    $amount = $_POST['amount'];

    //Insert into database
    try{
        $stmt = Database::getInstance()->update('Voorwerp','voorwerpnummer',1,
        array(
            'verkoopprijs' => $amount
        ));

        Redirect::to('index.php');

    } catch(PDOException $e){
        //Error during insert
        echo $e->getMessage();
    }
}