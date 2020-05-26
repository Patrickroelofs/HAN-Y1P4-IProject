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
                'm' => 'Afbeeldingen zijn te groot',
                'titel' => $titel,
                'startprijs' => $startprijs,
                'beschrijving' => $beschrijving,
                'betalingsinstructies' => $betalingsintructies,
                'verzendkosten' => $verzendkosten,
                'verzendinstructies' => $verzendinstructies
            ));

        } else if (!in_array($ext, $acceptedfiles)) {
            // error message
            Message::error('createauction.php', array(
                'm' => 'Afbeeldingsextensie niet geaccepteerd',
                'titel' => $titel,
                'startprijs' => $startprijs,
                'beschrijving' => $beschrijving,
                'betalingsinstructies' => $betalingsintructies,
                'verzendkosten' => $verzendkosten,
                'verzendinstructies' => $verzendinstructies
            ));
        }
    }

    if($countfiles > 4) {
        // error message
        Message::error('createauction.php', array(
            'm' => 'Te veel afbeeldingen!',
            'titel' => $titel,
            'startprijs' => $startprijs,
            'beschrijving' => $beschrijving,
            'betalingsinstructies' => $betalingsintructies,
            'verzendkosten' => $verzendkosten,
            'verzendinstructies' => $verzendinstructies
        ));

    } else if ($countfiles == 0) {
        // error message
        Message::error('createauction.php', array(
            'm' => 'U moet ten minste 1 afbeelding toevoegen',
            'titel' => $titel,
            'startprijs' => $startprijs,
            'beschrijving' => $beschrijving,
            'betalingsinstructies' => $betalingsintructies,
            'verzendkosten' => $verzendkosten,
            'verzendinstructies' => $verzendinstructies
        ));

    }
    // Check if fields are filled
    else if (empty($titel)) {
        // error message
        Message::error('createauction.php', array(
            'm' => 'U moet een titel toevoegen',
            'startprijs' => $startprijs,
            'beschrijving' => $beschrijving,
            'betalingsinstructies' => $betalingsintructies,
            'verzendkosten' => $verzendkosten,
            'verzendinstructies' => $verzendinstructies
        ));

    } elseif (empty($startprijs)) {
        // error message
        Message::error('createauction.php', array(
            'm' => 'U moet een startprijs opgeven',
            'titel' => $titel,
            'beschrijving' => $beschrijving,
            'betalingsinstructies' => $betalingsintructies,
            'verzendkosten' => $verzendkosten,
            'verzendinstructies' => $verzendinstructies
        ));

    } elseif (empty($looptijd)) {
        // error message
        Message::error('createauction.php', array(
            'm' => 'U moet een looptijd opgeven',
            'titel' => $titel,
            'startprijs' => $startprijs,
            'beschrijving' => $beschrijving,
            'betalingsinstructies' => $betalingsintructies,
            'verzendkosten' => $verzendkosten,
            'verzendinstructies' => $verzendinstructies
        ));
    } elseif (empty($beschrijving)) {
        // error message
        Message::error('createauction.php', array(
            'm' => 'U moet een beschrijving opgeven',
            'titel' => $titel,
            'startprijs' => $startprijs,
            'betalingsinstructies' => $betalingsintructies,
            'verzendkosten' => $verzendkosten,
            'verzendinstructies' => $verzendinstructies
        ));
    } elseif (empty($rubriek)) {
        // error message
        Message::error('createauction.php', array(
            'm' => 'U moet een rubriek opgeven',
            'titel' => $titel,
            'startprijs' => $startprijs,
            'beschrijving' => $beschrijving,
            'betalingsinstructies' => $betalingsintructies,
            'verzendkosten' => $verzendkosten,
            'verzendinstructies' => $verzendinstructies
        ));
    } elseif (empty($betalingswijzenaam)) {
        // error message
        Message::error('createauction.php', array(
            'm' => 'U moet een betalingswijze opgeven',
            'titel' => $titel,
            'startprijs' => $startprijs,
            'beschrijving' => $beschrijving,
            'betalingsinstructies' => $betalingsintructies,
            'verzendkosten' => $verzendkosten,
            'verzendinstructies' => $verzendinstructies
        ));
    } elseif (empty($verzendkosten)) {
        // error message
        Message::error('createauction.php', array(
            'm' => 'U moet de verzendkosten opgeven',
            'titel' => $titel,
            'startprijs' => $startprijs,
            'beschrijving' => $beschrijving,
            'betalingsinstructies' => $betalingsintructies,
            'verzendinstructies' => $verzendinstructies
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
                'hidden' => false,
                'trader' => $user->first()->username
            ));

            $getItemID = Database::getInstance()->query("SELECT id FROM Items WHERE token = '". $token ."'");

            for($i = 0; $i < $countfiles; $i++) {
                $insertImages = Database::getInstance()->insert('Files', array(
                    'filename' => $images[$i],
                    'item' => $getItemID->first()->id
                ));
            }

            // succes message
            Message::noticeMulti('product.php?p='.$getItemID->first()->id.'&', array(
                'm' => 'Product succesvol toegevoegd'
            ));

        } catch(PDOException $e){
            echo $e;
        }
    }
}