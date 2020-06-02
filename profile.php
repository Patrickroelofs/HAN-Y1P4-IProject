<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';

include FUNCTIONS . 'profile.func.php';
include INCLUDES . 'head.inc.php';

// These statements have been seperated because they error on production server
$userID = escape($_GET['user']);

if(!is_numeric($userID)) {
    Message::error('index.php', array(
        'm' => 'Gebruiker bestaat niet'
    ));

// If $_GET user is empty
} else if(empty($userID)) {
    Message::error('index.php', array(
        'm' => 'Gebruiker bestaat niet'
    ));

}


//Get data from this user
$thisUser = Database::getInstance()->query("SELECT * FROM Users WHERE id = '". $userID ."'");

// Check if user is banned
if ($thisUser->first()->banned == true && Admin::isLoggedIn() == false) {
    Message::error('index.php', array(
        'm' => 'Account geblokkeerd door admin'
    ));
}

if ($thisUser->count() < 1) {
    Message::error('index.php', array(
        'm' => 'Gebruiker bestaat niet'
    ));
}

$data = '';
$data .= '?user='.$userID;

if(isset($_GET['itemOffset'])) {
    if(!empty($_GET['itemOffset'])) {
        $itemOffset = $_GET['itemOffset'];
    } else {
        $itemOffset = 0;
    }
} else {
    $itemOffset = 0;
}

if(isset($_GET['bidsOffset'])) {
    if(!empty($_GET['bidsOffset'])) {
        $bidsOffset = $_GET['bidsOffset'];
    } else {
        $bidsOffset = 0;
    }
} else {
    $bidsOffset = 0;
}

if(isset($_GET['reviewsOffset'])) {
    if(!empty($_GET['reviewsOffset'])) {
        $reviewsOffset = $_GET['reviewsOffset'];
    } else {
        $reviewsOffset = 0;
    }
} else {
    $reviewsOffset = 0;
}


if(isset($_POST['submit-offset-items-up'])) {
    $data .= '&itemOffset=' . $itemOffset += 10;
    $data .= '&bidsOffset=' . $bidsOffset;
    $data .= '&reviewsOffset=' . $reviewsOffset;

    Redirect::to('profile.php' . $data);

} else if (isset($_POST['submit-offset-items-down'])) {
    $data .= '&itemOffset=' . $itemOffset -= 10;
    $data .= '&bidsOffset=' . $bidsOffset;
    $data .= '&reviewsOffset=' . $reviewsOffset;

    Redirect::to('profile.php' . $data);

} else if (isset($_POST['submit-offset-bids-up'])) {
    $data .= '&itemOffset=' . $itemOffset;
    $data .= '&bidsOffset=' . $bidsOffset += 5;
    $data .= '&reviewsOffset=' . $reviewsOffset;

    Redirect::to('profile.php' . $data);

} else if (isset($_POST['submit-offset-bids-down'])) {
    $data .= '&itemOffset=' . $itemOffset;
    $data .= '&bidsOffset=' . $bidsOffset -= 5;
    $data .= '&reviewsOffset=' . $reviewsOffset;

    Redirect::to('profile.php' . $data);

} else if (isset($_POST['submit-offset-review-up'])) {
    $data .= '&itemOffset=' . $itemOffset;
    $data .= '&bidsOffset=' . $bidsOffset;
    $data .= '&reviewsOffset=' . $reviewsOffset += 5;

    Redirect::to('profile.php' . $data);

} else if (isset($_POST['submit-offset-review-down'])) {
    $data .= '&itemOffset=' . $itemOffset;
    $data .= '&bidsOffset=' . $bidsOffset;
    $data .= '&reviewsOffset=' . $reviewsOffset -= 5;

    Redirect::to('profile.php' . $data);
}

if(isset($_GET['itemOffset']) && isset($_GET['bidsOffset']) && isset($_GET['reviewsOffset'])) {
    $getAllItems    = Database::getInstance()->query("SELECT hidden, id, title, description, price, thumbnail FROM Items WHERE trader = '". $thisUser->first()->username ."' ORDER BY title OFFSET $itemOffset ROWS FETCH NEXT 10 ROWS ONLY", array());
    $getAllBids     = Database::getInstance()->query("SELECT item, amount FROM Bids WHERE username = '". $thisUser->first()->username ."' ORDER BY date, time DESC OFFSET $bidsOffset ROWS FETCH NEXT 5 ROWS ONLY", array());
    $getAllReviews  = Database::getInstance()->query("SELECT review, comment, date, time FROM Feedback WHERE username = '". $thisUser->first()->username ."' ORDER BY date,time DESC OFFSET $reviewsOffset ROWS FETCH NEXT 5 ROWS ONLY", array());

    $countItems     = Database::getInstance()->query("SELECT id FROM Items WHERE trader = '". $thisUser->first()->username ."'");
    $countBids      = Database::getInstance()->query("SELECT item FROM Bids WHERE username = '". $thisUser->first()->username ."'");
    $countFeedback  = Database::getInstance()->query("SELECT item FROM Feedback WHERE username = '" . $thisUser->first()->username . "'");

} else {
    $getAllItems    = Database::getInstance()->query("SELECT hidden, id, title, description, price, thumbnail FROM Items WHERE trader = '". $thisUser->first()->username ."' ORDER BY title OFFSET 0 ROWS FETCH NEXT 10 ROWS ONLY", array());
    $getAllBids     = Database::getInstance()->query("SELECT item, amount FROM Bids WHERE username = '". $thisUser->first()->username ."' ORDER BY date, time DESC OFFSET 0 ROWS FETCH NEXT 5 ROWS ONLY", array());
    $getAllReviews  = Database::getInstance()->query("SELECT review, comment, date, time FROM Feedback WHERE username = '". $thisUser->first()->username ."' ORDER BY date,time DESC OFFSET 0 ROWS FETCH NEXT 5 ROWS ONLY", array());

    $countItems     = Database::getInstance()->query("SELECT id FROM Items WHERE trader = '". $thisUser->first()->username ."'");
    $countBids      = Database::getInstance()->query("SELECT item FROM Bids WHERE username = '". $thisUser->first()->username ."'");
    $countFeedback  = Database::getInstance()->query("SELECT item FROM Feedback WHERE username = '" . $thisUser->first()->username . "'");

}

include FUNCTIONS . 'admin.func.php';
?>

<main>
    <div class="ui container">
        <div class="ui stackable two column grid">
            <div class="column">

                <img class="ui small circular image profilepicture" src="<?php
                if(empty($thisUser->first()->profilepicture)) {
                    echo ROOT . 'upload/profilepictures/default.jpg';
                } else {
                    echo escape($thisUser->first()->profilepicture);
                }
                ?>">
                <h1>
                    <?php if(empty($thisUser->first()->firstname) || empty($thisUser->first()->lastname)) {
                        echo escape($thisUser->first()->username);
                    } else {
                        echo escape($thisUser->first()->firstname) . ' ' . escape($thisUser->first()->lastname);
                    }
                    ?>
                </h1>

            </div>

            <?php
            // admin cant ban himself
            if($_GET['user'] != Admin::adminID()) {
                //if an admin is logged in
                if(Admin::isLoggedIn()) {
                    //if this banned user is false display banuser otherwise unbanuser.
                    if($thisUser->first()->banned == false) {
                        ?>
                        <div class="column">
                            <form class="ui form vertical-margin-12" action="" method="post">
                                <input type="submit" name="banuser" id="banuser" class="negative ui button" value="Blokkeer gebruiker">
                            </form>
                        </div>
                    <?php } else { ?>

                        <div class="column">
                            <form class="ui form vertical-margin-12" action="" method="post">
                                <input type="submit" name="unbanuser" id="unbanuser" class="positive ui button" value="Deblokkeer gebruiker">
                            </form>
                        </div>
                        <?php
                    }
                }
            }
            ?>
        </div>

        <div class="profileDivider">
            <h2>Recente advertenties van deze gebruiker</h2>
            <br>
            <div class="ui stackable five column grid">
                <?php

                if ($getAllItems->count() <= 0) {
                    // no data passed by get
                    echo "<p>Geen producten gevonden...</p>";
                }

                foreach($getAllItems->results() as $result) {
                    if(!$result->hidden || Admin::isLoggedIn()) {
                        ?>
                        <div class="column">
                            <div class="ui fluid card productcards <?php if($result->hidden) { echo 'itemhidden'; } ?>">
                                <a class="image" href="product.php?p=<?= $result->id; ?>">
                                    <img src="<?= ROOT . $result->thumbnail; ?>" alt="Foto van <?= escape($result->title); ?>">
                                </a>
                                <div class="content">
                                    <a class="header" href="product.php?p=<?= $result->id; ?>"><?= escape($result->title); ?></a>
                                    <div class="description"><?= escape(Modifiers::textlength($result->description, 100)); ?>...</div>
                                    <em data-countdown="<?= $result->durationenddate ?> <?= $result->durationendtime ?>"></em>
                                    <div class="description bold">€<?= escape($result->price); ?></div>
                                </div>
                            </div>
                        </div>
                    <?php }
                } ?>
            </div>
            <br>
            <form class="ui large form" action="" method="post">
                <?php if(isset($_GET['itemOffset'])) {
                    if($_GET['itemOffset'] > 0) {
                        ?>
                        <button type="submit" class="ui left labeled icon button primary" name="submit-offset-items-down">
                            <i class="left arrow icon"></i>
                            Vorige pagina
                        </button>
                        <?php
                    }
                }

                if($countItems->count() >= $itemOffset && $countItems->count() - $itemOffset >= 10) {
                    ?>
                    <button type="submit" class="ui right labeled icon button primary" name="submit-offset-items-up">
                        <i class="right arrow icon"></i>
                        Volgende pagina
                    </button>
                    <?php
                }
                ?>
            </form>
        </div>


        <br><br>
        <div class="profileDivider">
            <h2>Recente biedingen van deze gebruiker</h2>
            <div>
                <ul class="bidlist">
                    <?php
                    foreach($getAllBids->results() as $bid) {
                            ?>
                            <li>
                            <span>
                                <a href="product.php?p=<?= $bid->item; ?>">
                                    <?php $item = Database::getInstance()->query("SELECT title FROM Items where id = '". $bid->item ."'");
                                    echo substr($item->first()->title, 0, 25);
                                    ?>
                                </a>
                            </span>

                                <span>€ <?= $bid->amount; ?></span></li>
                            <?php
                        }

                    if($getAllBids->count() <= 0) {
                        echo 'Geen biedingen gevonden...';
                    }
                    ?>
                </ul>
                <form class="ui large form" action="" method="post">
                    <?php if(isset($_GET['bidsOffset'])) {
                        if($_GET['bidsOffset'] > 0) {
                            ?>
                            <button type="submit" class="ui left labeled icon button primary" name="submit-offset-bids-down">
                                <i class="left arrow icon"></i>
                                Vorige pagina
                            </button>
                        <?php
                        }
                    }

                    if($countBids->count() >= $bidsOffset && $countBids->count() - $bidsOffset >= 5) {
                        ?>
                        <button type="submit" class="ui right labeled icon button primary" name="submit-offset-bids-up">
                            <i class="right arrow icon"></i>
                            Volgende pagina
                        </button>
                        <?php
                    }
                    ?>
                </form>
            </div>
        </div>
        <br><br>
        <div class="profileDivider">
            <h2>Recente feedback op deze gebruiker</h2>

            <?php
            $allPositive= Database::getInstance()->query("SELECT review FROM Feedback WHERE username = '". $thisUser->first()->username . "' AND review = 'positief'");
            $allMeh= Database::getInstance()->query("SELECT review FROM Feedback WHERE username = '". $thisUser->first()->username . "' AND review = 'neutraal'");
            $allNegative=  Database::getInstance()->query("SELECT review FROM Feedback WHERE username = '". $thisUser->first()->username . "' AND review = 'negatief'");
            ?>

            <div>
                <span style="font-size: 1.17em"><?php echo $allPositive->count() ?></span>
                <i class="large green smile outline icon"></i>

                <span style="font-size: 1.17em"><?php echo $allMeh->count() ?></span>
                <i class="large orange meh outline icon"></i>

                <span style="font-size: 1.17em"><?php echo $allNegative->count() ?></span>
                <i class="large red frown outline icon"></i>
            </div>

            <?php foreach ($getAllReviews->results() as $result) {

                ?>

                <div class="ui segment">
                    <h3><?= $result->review ?></h3>
                    <p>
                        <?php if (empty($result->comment)) {
                            echo '<em>Geen bericht achtergelaten.</em>';
                        } else {
                            echo $result->comment;
                        }
                        ?>
                    </p>
                    <p>
                        <?= $result->date; ?>
                        <?= substr($result->time, 0, 5); ?>
                    </p>
                </div>

                <?php
            }

            if($getAllReviews->count() <= 0) {
                echo 'Geen feedback gevonden...';
            }
            ?>


            <form class="ui large form" action="" method="post">
                <?php if(isset($_GET['reviewsOffset'])) {
                    if($_GET['reviewsOffset'] > 0) {
                        ?>
                        <button type="submit" class="ui left labeled icon button primary" name="submit-offset-review-down">
                            <i class="left arrow icon"></i>
                            Vorige pagina
                        </button>
                        <?php
                    }
                }

                if($countFeedback->count() >= $reviewsOffset && $countFeedback->count() - $reviewsOffset >= 5) {
                    ?>
                    <button type="submit" class="ui right labeled icon button primary" name="submit-offset-review-up">
                        <i class="right arrow icon"></i>
                        Volgende pagina
                    </button>
                    <?php
                }
                ?>
            </form>
        </div>
    </div>
</main>

<?php include INCLUDES . 'footer.inc.php'; ?>
<?php include INCLUDES . 'foot.inc.php'; ?>
