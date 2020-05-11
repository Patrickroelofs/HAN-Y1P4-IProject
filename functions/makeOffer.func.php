<?php
//======================================================================
// Offer
//======================================================================

// Is submit pressed?
if(isset($_POST['offer-submit'])) {

    // TODO take product id
    // Save data in temporary variables
    $amount = $_POST['amount'];
    unset($_POST['offer-submit']);

    try{
        $stmt = Database::getInstance()->insert('Voorwerp', array(
            'verkoopprijs' => $amount
        ));

    } catch(PDOException $e){
        //Error during insert
        echo $e->getMessage();
    }
}