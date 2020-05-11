<?php

//======================================================================
// ADD AN AUCTION
//======================================================================

if(isset($_POST['auction-submit'])) {

    // Save input in temporary variables
    $titel = $_POST['titel'];
    $beschrijving = $_POST['beschrijving'];
    $startprijs = $_POST['startprijs'];
    $betalingsinstructies = $_POST['betalingsintructies'];

    // User has to have all data filled in so this is available
    $plaatsnaam = $user->first()->plaatsnaam;
    $landnaam = $user->first()->landnaam;

    $looptijd = $_POST['looptijd'];
    $verzendkosten = $_POST['verzendkosten'];
    $verzendinstructies = $_POST['verzendinstructies'];

    $gebruikersnaam = $user->first()->gebruikersnaam;


    if(empty($titel) || empty($beschrijving) || empty($startprijs) || empty($looptijd)) {
        echo 'error - empty';
    }

    else {
        try {
            $stmt = Database::getInstance()->insert('Voorwerp', array(
               'titel' => $titel,
               'beschrijving' => $beschrijving,
                'startprijs' => $startprijs,
                'betalingsinstructies' => $betalingsinstructies,
                'plaatsnaam' => $plaatsnaam,
                'landnaam' => $landnaam,
                'looptijd' => $looptijd,
                'verzendkosten' => $verzendkosten,
                'verzendinstructies' => $verzendinstructies,
                'verkoper' => $gebruikersnaam
            ));

        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
}