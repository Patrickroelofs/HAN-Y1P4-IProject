<?php

//======================================================================
// ADD AN AUCTION
//======================================================================

if(isset($_POST['auction-submit'])) {

    $token = md5(uniqid(Session::get('username'), true));

    $titel = $_POST['titel'];
    $beschrijving = $_POST['beschrijving'];
    $rubriek = $_POST['rubriek'];
    $startprijs = $_POST['startprijs'];
    $betalingswijzenaam = $_POST['betalingswijze'];
    $betalingsintructies = $_POST['betalingsintructies'];
    $looptijd = $_POST['looptijd'];
    $verzendkosten = $_POST['verzendkosten'];
    $verzendinstructies = $_POST['verzendinstructies'];

    $countfiles = count(array_filter($_FILES['images']['name']));
    $acceptedfiles = array("png", "jpg");
    $images = array();

    for($i = 0; $i < $countfiles; $i++) {
        $ext = pathinfo($_FILES['images']['name'][$i], PATHINFO_EXTENSION);
        $filename = md5(uniqid($_FILES['images']['name'][$i], true));
        $target = 'upload/productfiles/' . $filename . '.' . $ext;
        $size = $_FILES['images']['size'][$i];

        if($size > 2097152) {
            //TODO: Error message
            Redirect::to('createauction.php?r=1');

        } else if (!in_array($ext, $acceptedfiles)) {
            //TODO: Error message
            Redirect::to('createauction.php?r=2');
        }
    }

    if($countfiles > 4) {
        //TODO: Error message
        Redirect::to('createauction.php?r=3');

    } else if ($countfiles == 0) {
        //TODO: Error message
        Redirect::to('createauction.php?r=4');

    } else if (empty($titel)) {
        //TODO: Error message
        Redirect::to('createauction.php?r=5');

    }

    else {
        try {
            for($i = 0; $i < $countfiles; $i++) {
                $ext = pathinfo($_FILES['images']['name'][$i], PATHINFO_EXTENSION);
                $filename = md5(uniqid($_FILES['images']['name'][$i], true));
                $target = 'upload/productfiles/' . $filename . '.' . $ext;
                $size = $_FILES['images']['size'][$i];

                $images[] = $target;
                move_uploaded_file($_FILES['images']['tmp_name'][$i], $target);
            }


            $stmt = Database::getInstance()->insert('Voorwerp', array(
                'token' => $token,
                'titel' => $titel,
                'beschrijving' => $beschrijving,
                'thumbnail' => $images[0],
                'rubriek' => $rubriek,
                'startprijs' => $startprijs,
                'betalingswijzenaam' => $betalingswijzenaam,
                'betalingsinstructies' => $betalingsintructies,
                'postcode' => $user->first()->postcode,
                'plaatsnaam' => $user->first()->plaatsnaam,
                'landnaam' => $user->first()->landnaam,
                'looptijd' => $looptijd,
                'verzendkosten' => $verzendkosten,
                'verzendinstructies' => $verzendinstructies,
                'verkoper' => $user->first()->gebruikersnaam
            ));

            $getItemID = Database::getInstance()->query("SELECT voorwerpnummer FROM Voorwerp WHERE token = '". $token ."'");

            for($i = 0; $i < $countfiles; $i++) {
                $insertImages = Database::getInstance()->insert('Bestanden', array(
                    'bestandnaam' => $images[$i],
                    'voorwerpnummer' => $getItemID->first()->voorwerpnummer
                ));
            }

        } catch(PDOException $e){
            echo $e;
        }
    }
}