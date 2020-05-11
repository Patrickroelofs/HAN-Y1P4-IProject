<?php
require_once $_SERVER['DOCUMENT_ROOT'] . 'core/init.php';
if(Session::exists('username')){
    Redirect::to('index.php');
}
include INCLUDES . 'head.inc.php';
include FUNCTIONS . 'resetPassword.func.php';
?>

<form method="post" action="">
    <input type="password" name="password" id="password" placeholder="Wachtwoord" required>
    <input type="password" name="password_repeat" id="password_repeat" placeholder="Wachtwoord herhalen" required>
    <input type="submit" name="veranderen" id="veranderen" value="Versturen">
</form>

<?php include INCLUDES . 'footer.inc.php'; ?>
<?php include INCLUDES . 'foot.inc.php'; ?>
