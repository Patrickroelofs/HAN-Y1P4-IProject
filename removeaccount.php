<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';

include INCLUDES . 'head.inc.php';
include FUNCTIONS . 'profile.func.php';
?>

    <main>
        <div class="ui container">
            <div class="ui centered grid">
                <div class="ui segment">
                    <form class="ui large form" action="" method="post">
                        <div class="stacked segment">
                            <h2 class="text-center">Weet u het zeker?</h2>
                            <p>Als u uw account verwijderd verliest u al uw huidige biedingen.</p>

                            <!-- Ingelogd -->
                            <?php if (Session::exists('username')) { ?>
                                <input class="ui negative button" type="submit" name="delete-account-submit"
                                       value="Verwijder je Account">
                            <?php }
                            //Uitgelogd
                            else {
                                ?>
                                <form method="post">
                                    <div clas="ui input">
                                        <input type="email" name="email" id="email" placeholder="Voer uw email in">
                                        <input class="ui negative button" type="submit" name="delete-account-submit"
                                               value="Verwijder je Account">
                                    </div>
                                </form>
                                <?php
                            } ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

<?php include INCLUDES . 'footer.inc.php'; ?>
<?php include INCLUDES . 'foot.inc.php'; ?>