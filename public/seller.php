<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
include INCLUDES . 'head.inc.php';
include FUNCTIONS . 'login.func.php';
?>

<main>
    <div class="ui equal width stackable grid">
        <div class="column vertical-margin-24"></div>
        <div class="column vertical-margin-24">
            <form class="ui large form" action="" method="post">
                <h2>Verkoop gegevens</h2>
                <div class="field">
                    <label for="bank name">Bank naam</label>
                    <div class="ui selection dropdown">
                        <input type="hidden" name="gender">
                        <i class="dropdown icon"></i>
                        <div class="default text">Gender</div>
                        <div class="menu">
                            <div class="item" data-value="1">Male</div>
                            <div class="item" data-value="0">Female</div>
                        </div>
                    </div>
                </div>
                <div class="field">
                    <label for="email">Emailadres</label>
                    <div class="ui disabled input">
                        <input type="email" name="email" id="email" placeholder="<?= $user->first()->emailadres ?>">
                    </div>
                </div>
                <div class="field">
                    <label for="password">Wachtwoord</label>
                    <input type="password" name="password" id="password" placeholder="...">
                </div>
                <div class="field">
                    <label for="password_repeat">Wachtwoord herhalen</label>
                    <input type="password" name="password_repeat" id="password_repeat" placeholder="...">
                </div>
                <input class="ui button" type="submit" name="update-inloggegevens-submit" value="Inloggegevens aanpassen">
            </form>
        </div>
        <div class="column vertical-margin-24"></div>
    </div>
</main>

<?php include INCLUDES . 'footer.inc.php'; ?>
<?php include INCLUDES . 'foot.inc.php'; ?>
