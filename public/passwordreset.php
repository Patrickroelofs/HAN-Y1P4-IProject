<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
if (Session::exists('username')) {
    Redirect::to('index.php');
}
include INCLUDES . 'head.inc.php';
include FUNCTIONS . 'resetPassword.func.php';
?>

<main>
    <div class="ui container">
        <form class="ui form" method="post" action="">
            <div class="field">
                <label>Wachtwoord</label>
                <input type="password" name="password" id="password" placeholder="" required>
            </div>
            <div class="field">
                <label>Wachtwoord herhalen</label>
                <input type="password" name="password_repeat" id="password_repeat" placeholder="" required>
            </div>
            <button class="ui button" type="submit" name="veranderen" id="veranderen">Veranderen</button>
        </form>
    </div>
</main>

<?php include INCLUDES . 'footer.inc.php'; ?>
<?php include INCLUDES . 'foot.inc.php'; ?>
