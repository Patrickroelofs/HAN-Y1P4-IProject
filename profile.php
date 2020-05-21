<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';

include FUNCTIONS . 'profile.func.php';
include INCLUDES . 'head.inc.php';

// Count the amount of users registered
$amountOfUsers = Database::getInstance()->prepare("SELECT count(*) FROM Users");
$amountOfUsers->execute();
$amount = $amountOfUsers->fetch(PDO::FETCH_COLUMN);

//These statements have been seperated because they error on production server
// If $_GET user is not a numeric character
if(!is_numeric($_GET['user'])) {
    Redirect::to('index.php');

// If $_GET user is empty
} else if(empty($_GET['user'])) {
    Redirect::to('index.php');

// If $_GET user is not a numeric character or is < then 0
} else if ($_GET['user'] > $amount || $_GET['user'] < 0) {
    Redirect::to('index.php');
}


//Get data from this user
$thisUser = Database::getInstance()->query("SELECT * FROM Users WHERE id = '". escape($_GET['user']) ."'");

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
        <br><br><br>

        <div>
            <h2>Deze gebruikers producten</h2>
            <div class="ui stackable five column grid">
                <?php
                $products = Database::getInstance()->query("SELECT * FROM Items WHERE trader = '". $thisUser->first()->username ."'");

                if ($products->count() < 1) {
                    // no data passed by get
                    echo "<p>Geen resultaten</p>";
                }

                foreach($products->results() as $result) {
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
                                <div class="description bold">€<?= escape($result->price); ?></div>
                            </div>
                        </div>
                    </div>
                <?php }
                } ?>
            </div>
        </div>
    </div>
</main>

<?php include INCLUDES . 'footer.inc.php'; ?>
<?php include INCLUDES . 'foot.inc.php'; ?>
