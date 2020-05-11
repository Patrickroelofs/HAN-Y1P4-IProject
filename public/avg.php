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

                            <!-- Ingelogd -->
                            <?php if (Session::exists('username')) { ?>
                                <input class="ui button" type="submit" name="delete-account-submit" value="Verwijder je Account">
                            <?php } else { ?>

                                <!-- Niet Ingelogd -->
                                <p class="text-center">Vul hier uw email in als u zeker bent van het verwijderen</p>
                                <div class="field">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" placeholder="Email" required>
                                </div>
                                <input class="ui button" type="submit" name="delete-account-submit" value="Verwijder je Account">

                            <?php } ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

<?php include INCLUDES . 'footer.inc.php'; ?>
<?php include INCLUDES . 'foot.inc.php'; ?>