<?php

//======================================================================
// UPDATE INLOGGEGEVENS
//======================================================================

// Is submit pressed
if (isset($_POST['update-inloggegevens-submit'])) {

    // Save data in temporary variables
    // Inloggegevens
    $password = $_POST['password'];
    $password_repeat = $_POST['password_repeat'];

    // TODO: Error messages and other invalid register checks.
    if (empty($password) || empty($password_repeat)) {
        //error
        echo 'error - empty';

    } else if ($password !== $password_repeat) {
        // succes message
        Message::error('editprofile.php', array(
            'm' => 'Wachtwoorden zijn niet hetzelfde'
        ));
    } else {
        //Insert into database
        try {
            $stmt = Database::getInstance()->update('Users', 'username', Session::get('username'), array(
                'password' => Hash::make($password)
            ));

            // succes message
            Message::notice('editprofile.php', array(
                'm' => 'Wachtwoorden succesvol aangepast'
            ));

        } catch (PDOException $e) {
            //Error during insert
            echo $e->getMessage();
        }
    }
}

//======================================================================
// UPDATE PERSOONSGEGEVENS
//======================================================================

// Is submit pressed
if (isset($_POST['update-persoonsgegevens-submit'])) {

    // Save data in temporary variables
    //Persoonsgegevens
    $firstname = escape($_POST['firstname']);
    $lastname = escape($_POST['lastname']);
    $dob = $_POST['dob'];
    $profilepicture = $_FILES['profilepicture']['name'];
    $phone = escape($_POST['phone']);

    $getuserinfo = Database::getInstance()->query("SELECT * FROM Users WHERE username = '". Session::get('username') ."'");

    //Randomly hash filename
    $ext = pathinfo($_FILES['profilepicture']['name'], PATHINFO_EXTENSION);
    $filename = md5(basename($profilepicture));
    $target = 'upload/profilepictures/' . $filename . '.' . $ext;
    $supported_image = array('gif', 'jpg', 'jpeg', 'png');


    // TODO: Error messages and other invalid register checks.
    if (empty($firstname) || empty($lastname) || empty($dob)) {
        //error
        echo 'error - empty';
    }
    if (!empty($profilepicture) && !in_array($ext, $supported_image)) {
        echo 'error - unsupported file format';
    } else {
        // Insert into database
        try {
            //Move uploaded profilepicture to folder
            //TODO: Secure image upload
            move_uploaded_file($_FILES['profilepicture']['tmp_name'], $target);

            // If there is no profile picture uploaded
            if (empty($profilepicture)) {
                if (empty($getuserinfo->first()->address1) || empty($getuserinfo->first()->postalcode) || empty($getuserinfo->first()->city) || empty($getuserinfo->first()->country) || empty($getuserinfo->first()->verified)) {
                    $stmt = Database::getInstance()->update('Users', 'username', Session::get('username'), array(
                        'firstname' => $firstname,
                        'lastname' => $lastname,
                        'birthdate' => $dob,
                        'phone' => $phone
                    ));
                    Message::notice('editprofile.php', array(
                        'm' => 'Uw persoonsgegevens zijn succesvol bijgewerkt. <br> Uw profiel is nog niet compleet, vul ook uw locatiegegevens in.'
                    ));
                } else {
                    $stmt = Database::getInstance()->update('Users', 'username', Session::get('username'), array(
                        'firstname' => $firstname,
                        'lastname' => $lastname,
                        'birthdate' => $dob,
                        'phone' => $phone,
                        'complete' => true
                    ));
                    Message::notice('editprofile.php', array(
                        'm' => 'Uw persoonsgegevens zijn succesvol bijgewerkt en uw profiel is compleet.'
                    ));
                }
            } // If there is a profile picture uploaded
            else {
                if (empty($getuserinfo->first()->address1) || empty($getuserinfo->first()->postalcode) || empty($getuserinfo->first()->city) || empty($getuserinfo->first()->country)) {
                    $stmt = Database::getInstance()->update('Users', 'username', Session::get('username'), array(
                        'firstname' => $firstname,
                        'lastname' => $lastname,
                        'birthdate' => $dob,
                        'profilepicture' => $target,
                        'phone' => $phone
                    ));
                    Message::notice('editprofile.php', array(
                        'm' => 'Uw persoonsgevens zijn succesvol bijgewerkt. Vul ook uw locatiegegevens in om uw profiel compleet te maken.'
                    ));
                } else {
                    $stmt = Database::getInstance()->update('Users', 'username', Session::get('username'), array(
                        'firstname' => $firstname,
                        'lastname' => $lastname,
                        'birthdate' => $dob,
                        'profilepicture' => $target,
                        'phone' => $phone,
                        'complete' => true
                    ));
                    Message::notice('editprofile.php', array(
                        'm' => 'Uw persoonsgegevens zijn succesvol bijgewerkt en uw profiel is compleet.'
                    ));
                }
            }
        } catch
        (PDOException $e) {
            //Error during insert
            echo $e->getMessage();
        }
    }
}

//======================================================================
// UPDATE LOCATIEGEGEVENS
//======================================================================

// Is submit pressed
if (isset($_POST['update-locatiegegevens-submit'])) {

    // Save data in temporary variables
    //Locatiegegevens
    $adresregel1 = escape($_POST['adresregel1']);
    $adresregel2 = escape($_POST['adresregel2']);
    $postcode = escape($_POST['postcode']);
    $plaatsnaam = escape($_POST['plaatsnaam']);
    $land = $_POST['land'];

    $getuserinfo = Database::getInstance()->query("SELECT * FROM Users WHERE username = '". Session::get('username') ."'");

    // TODO: Error messages and other invalid register checks.
    if (empty($adresregel1) || empty($postcode) || empty($plaatsnaam) || empty($land)) {
        //error
        Message::error('editprofile.php', array(
            'm' => 'Vul alle locatiegegevens in'
        ));
    } else if (empty($getuserinfo->first()->firstname) || empty($getuserinfo->first()->lastname) || empty($getuserinfo->first()->birthdate) || empty($getuserinfo->first()->verified)) {
        // Insert into data
        try {
            $stmt = Database::getInstance()->update('Users', 'username', Session::get('username'), array(
                'address1' => $adresregel1,
                'address2' => $adresregel2,
                'postalcode' => $postcode,
                'city' => $plaatsnaam,
                'country' => $land
            ));

            // succes message
            Message::notice('editprofile.php', array(
                'm' => 'Uw locatiegegevens zijn succesvol bijgewerkt. Vul ook uw persoonsgegevens in om uw profiel compleet te maken.'
            ));

        } catch (PDOException $e) {
            //Error during insert
            echo $e->getMessage();
        }
    } else {
        // Insert into db
        try {
            $stmt = Database::getInstance()->update('Users', 'username', Session::get('username'), array(
                'address1' => $adresregel1,
                'address2' => $adresregel2,
                'postalcode' => $postcode,
                'city' => $plaatsnaam,
                'country' => $land,
                'complete' => true
            ));

            // succes message
            Message::notice('editprofile.php', array(
                'm' => 'Uw locatiegegevens zijn succesvol bijgewerkt en uw profiel is compleet.'
            ));

        } catch (PDOException $e) {
            //Error during insert
            echo $e->getMessage();
        }
    }
}

//======================================================================
// DELETE Account
//======================================================================

// Is submit pressed
if (isset($_POST['delete-account-submit'])) {
    // Logged in, delete account from database
    if (Session::exists('username')) {
        //Get the users profilepicture and delete it
        $stmt = Database::getInstance()->get('Users', array('username', '=', Session::get('username')));

        //Check if user has profilepicture and if so remove it
        if (!empty($stmt->first()->profilepicture)) {
            unlink($stmt->first()->profilepicture);
        }

        //Delete user bids (if they exist)
        $yourBids = Database::getInstance()->query("SELECT * FROM Bids WHERE username = '" . Session::get('username') . "' ORDER BY date DESC");

        if ($yourBids->count() > 0) {
            $bidsDel = Database::getInstance()->delete('Bids', array('username', '=', Session::get('username')));
        }

        // Delete user notifications
        $yourNoti = Database::getInstance()->query("SELECT * FROM Notifications WHERE username = '" . Session::get('username') . "'");

        if ($yourNoti->count() > 0) {
            $notiDelete = Database::getInstance()->delete('Notifications', array('username', '=', Session::get('username')));
        }

        // if the user is a trader delete that trader & items, files, bids associated
        if ($user->first()->trader == true) {
            $itemsID = Database::getInstance()->query("SELECT id FROM Items WHERE trader = '" . Session::get('username') . "'", array());

            //Remove bids, files, items, trader, feedback from database
            foreach ($itemsID->results() as $result) {
                $id = $result->id;

                $productBids = Database::getInstance()->delete('Bids', array('item', '=', $id));

                $yourFeedback = Database::getInstance()->query("SELECT * FROM Feedback WHERE item = $id");

                if ($yourFeedback->count() > 0) {
                    $feedbackDelete = Database::getInstance()->delete('Feedback', array('item', '=', $id));
                }

                $filePath = Database::getInstance()->query("SELECT * FROM Files WHERE item = $id");
                foreach ($filePath->results() as $pathResult) {
                    $path = $pathResult->filename;

                    unlink($path);
                }

                $files = Database::getInstance()->delete('Files', array('item', '=', $id));
            }
            $items = Database::getInstance()->delete('Items', array('trader', '=', Session::get('username')));
            $trader = Database::getInstance()->delete('Trader', array('username', '=', Session::get('username')));
        }

        //Delete user and ends session
        $user = Database::getInstance()->delete('Users', array('username', '=', Session::get('username')));

        session_unset();
        session_destroy();

        Message::notice('index.php', array(
            'm' => 'Uw account is succesvol verwijderd'
        ));

    } // Logged out, delete account from database
    else {
        $email = escape($_POST['email']);
        $stmt = Database::getInstance()->query("SELECT * FROM Users WHERE email = '" . $email . "'");
        if ($onProduction) {
            //Send user the verification mail
            $username = escape($stmt->first()->username);
            $to = escape($stmt->first()->email);
            $subject = "EenmaalAndermaal Account Verwijderen";
            $message = '

        Beste ' . escape($username) . ',

        U heeft een verzoek gedaan om uw EenmaalAndermaal account te verwijderen.
        Klik op de onderstaande link om uw gegevens te verwijderen:
        https://iproject19.icasites.nl/removeaccount.php?rmid=' . Hash::make($email) . '&rmuid=' . $username . '
        Bent u dit niet neem dan contact op met beveiliging@eenmaalandermaal.nl
        ';

            mail($to, $subject, $message);
            Message::info("index.php", array(
                'm' => 'Een email is verstuurd, bekijk ook je spambox!'
            ));
        } else {
            //Immediately show verification link if not on production server
            $username = escape($stmt->first()->username);
            echo '<a href="removeaccount.php?rmid=' . Hash::make(escape($email)) . '&rmuid=' . $username . '">Klik Hier</a>';
        }
    }

}

//If the rmid is valid delete all user information and redirect to index.php
if (isset($_GET['rmid'])) {
    $stmt = Database::getInstance()->get('Users', array('username', '=', $_GET['rmuid']));

    if (Hash::verify($stmt->first()->email, $_GET['rmid'])) {

        //Check if user has profilepicture and if so remove it
        if (!empty($stmt->first()->profilepicture)) {
            unlink($stmt->first()->profilepicture);
        }

        //Delete user bids (if they exist)
        $yourBids = Database::getInstance()->query("SELECT * FROM Bids WHERE username = '" . $_GET['rmuid'] . "' ORDER BY date DESC");

        if ($yourBids->count() > 0) {
            $bidsDel = Database::getInstance()->delete('Bids', array('username', '=', $_GET['rmuid']));
        }

        // Delete user notifications
        $yourNoti = Database::getInstance()->query("SELECT * FROM Notifications WHERE username = '" . $_GET['rmuid'] . "'");

        if ($yourNoti->count() > 0) {
            $notiDelete = Database::getInstance()->delete('Notifications', array('username', '=', $_GET['rmuid']));
        }

        // if the user is a trader delete that trader & items, files, bids associated
        if ($stmt->first()->trader == true) {
            $itemsID = Database::getInstance()->query("SELECT id FROM Items WHERE trader = '" . $_GET['rmuid'] . "'", array());

            foreach ($itemsID->results() as $result) {
                $id = $result->id;

                $productBids = Database::getInstance()->delete('Bids', array('item', '=', $id));

                $yourFeedback = Database::getInstance()->query("SELECT * FROM Feedback WHERE item = $id");

                if ($yourFeedback->count() > 0) {
                    $feedbackDelete = Database::getInstance()->delete('Feedback', array('item', '=', $id));
                }

                $filePath = Database::getInstance()->query("SELECT * FROM Files WHERE item = $id");
                foreach ($filePath->results() as $pathResult) {
                    $path = $pathResult->filename;

                    unlink($path);
                }

                $files = Database::getInstance()->delete('Files', array('item', '=', $id));
            }
            $items = Database::getInstance()->delete('Items', array('trader', '=', $_GET['rmuid']));
            $trader = Database::getInstance()->delete('Trader', array('username', '=', $_GET['rmuid']));
        }


        $user = Database::getInstance()->delete('Users', array('username', '=', $_GET['rmuid']));

        Message::notice('index.php', array(
            'm' => 'Uw account is succesvol verwijderd'
        ));
    }

}