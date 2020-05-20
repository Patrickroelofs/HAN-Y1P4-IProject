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
?>

<main>
    <div class="ui container">
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
</main>

<?php include INCLUDES . 'footer.inc.php'; ?>
<?php include INCLUDES . 'foot.inc.php'; ?>
