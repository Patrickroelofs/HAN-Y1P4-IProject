<?php

//======================================================================
// ADD AN AUCTION
//======================================================================

if(isset($_POST['auction-submit'])) {

    $token = md5(uniqid(Session::get('username'), true));

    $titel = escape($_POST['titel']);
    $beschrijving = escape($_POST['beschrijving']);
    $rubriek = escape($_POST['rubriek']);
    $startprijs = escape($_POST['startprijs']);
    $betalingswijzenaam = escape($_POST['betalingswijze']);
    $betalingsintructies = escape($_POST['betalingsintructies']);
    $looptijd = escape($_POST['looptijd']);
    $verzendkosten = escape($_POST['verzendkosten']);
    $verzendinstructies = escape($_POST['verzendinstructies']);

    $countfiles = count(array_filter($_FILES['images']['name']));
    $acceptedfiles = array("png", "jpg");
    $images = array();

    $date = date("Y-m-d");
    $time = date("H:i:s");

    for($i = 0; $i < $countfiles; $i++) {
        $ext = pathinfo($_FILES['images']['name'][$i], PATHINFO_EXTENSION);
        $filename = md5(uniqid($_FILES['images']['name'][$i], true));
        $target = 'upload/productpictures/' . $filename . '.' . $ext;
        $size = $_FILES['images']['size'][$i];

        if($size > 2097152) {
            // error message
            Message::error('createauction.php', array(
                'm' => 'Afbeeldingen zijn te groot'
            ));

        } else if (!in_array($ext, $acceptedfiles)) {
            // error message
            Message::error('createauction.php', array(
                'm' => 'Afbeeldingsextensie niet geaccepteerd'
            ));
        }
    }

    if($countfiles > 4) {
        // error message
        Message::error('createauction.php', array(
            'm' => 'Te veel afbeeldingen!'
        ));

    } else if ($countfiles == 0) {
        // error message
        Message::error('createauction.php', array(
            'm' => 'U moet ten minste 1 afbeelding toevoegen'
        ));

    } else if (empty($titel)) {
        // error message
        Message::error('createauction.php', array(
            'm' => 'U moet een titel toevoegen'
        ));

    }

    else {
        try {
            for($i = 0; $i < $countfiles; $i++) {
                $ext = pathinfo($_FILES['images']['name'][$i], PATHINFO_EXTENSION);
                $filename = md5(uniqid($_FILES['images']['name'][$i], true));
                $target = 'upload/productpictures/' . $filename . '.' . $ext;
                $size = $_FILES['images']['size'][$i];

                $images[] = $target;
                move_uploaded_file($_FILES['images']['tmp_name'][$i], $target);
            }


            $stmt = Database::getInstance()->insert('Items', array(
                'token' => $token,
                'title' => $titel,
                'description' => $beschrijving,
                'thumbnail' => $images[0],
                'category' => $rubriek,
                'price' => $startprijs,
                'paymentname' => $betalingswijzenaam,
                'paymentinstruction' => $betalingsintructies,
                'postalcode' => $user->first()->postalcode,
                'city' => $user->first()->city,
                'country' => $user->first()->country,
                'duration' => $looptijd,
                'durationbegindate' => $date,
                'durationbegintime' => $time,
                'durationenddate' => date("Y-m-d", strtotime($date. ' + '. $looptijd .' days')),
                'durationendtime' => $time,
                'shippingcost' => $verzendkosten,
                'shippinginstructions' => $verzendinstructies,
                'closed' => false,
                'trader' => $user->first()->username
            ));

            $getItemID = Database::getInstance()->query("SELECT id FROM Items WHERE token = '". $token ."'");

            for($i = 0; $i < $countfiles; $i++) {
                $insertImages = Database::getInstance()->insert('Files', array(
                    'filename' => $images[$i],
                    'item' => $getItemID->first()->id
                ));
            }

            Redirect::to('product.php?p='.$getItemID->first()->id.'');

        } catch(PDOException $e){
            echo $e;
        }
    }
}