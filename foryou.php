<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
    include INCLUDES . 'head.inc.php';

    if(!Session::exists('username')){
        Redirect::to('index.php');
    }
?>

<main>
    <div class="ui container">
        <?php if ($user->first()->trader) { // if the user IS a trader
            include INCLUDES . 'fortrader.php';
         } else { // if the user is NOT a trader
            include INCLUDES . 'foruser.php';
        } ?>
    </div>
</main>

<?php include INCLUDES . 'footer.inc.php'; ?>
<?php include INCLUDES . 'foot.inc.php'; ?>