<?php
require_once $_SERVER['DOCUMENT_ROOT'] . 'core/init.php';
include INCLUDES . 'head.inc.php';
include FUNCTIONS . 'searchEmail.func.php';

?>

<form method="post" action="">
    <input type="email" placeholder="" name="email" id="email" required>
    <input type="submit" name="versturen" id="versturen" value="Versturen">
</form>

<?php include INCLUDES . 'footer.inc.php'; ?>
<?php include INCLUDES . 'foot.inc.php'; ?>
