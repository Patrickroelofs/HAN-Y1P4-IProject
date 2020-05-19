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
                'trader' => $user->first()->username
            ));

            $getItemID = Database::getInstance()->query("SELECT id FROM Items WHERE token = '". $token ."'");

            for($i = 0; $i < $countfiles; $i++) {
                $insertImages = Database::getInstance()->insert('Files', array(
                    'filename' => $images[$i],
                    'item' => $getItemID->first()->id
                ));
            }

        } catch(PDOException $e){
            echo $e;
        }
    }
}