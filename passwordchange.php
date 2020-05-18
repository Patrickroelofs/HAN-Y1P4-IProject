<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
if (Session::exists('username')) {
    Redirect::to('index.php');
}
include INCLUDES . 'head.inc.php';
include FUNCTIONS . 'resetPassword.func.php';

?>

<?php if (isset($_GET['id'])) { ?>
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
<?php } else { ?>
    <main>
        <div class="ui container">
            <h2>Wachtwoord vergeten</h2>
            <p>Weet je het wachtwoord niet meer? Vul hieronder je e-mailadres in. We sturen dan binnen enkele minuten
                een
                e-mail
                waarmee een nieuw wachtwoord kan worden aangemaakt.</p>
            <form method="post" action="" class="ui form">
                <div class="field">
                    <label>Vul hier uw e-mail in</label>
                    <input type="email" name="email" id="email" placeholder="" required>
                </div>
                <button class="ui button" type="submit" name="versturen" id="versturen">Versturen</button>
            </form>
        </div>
    </main>
<?php } ?>

<?php include INCLUDES . 'footer.inc.php'; ?>
<?php include INCLUDES . 'foot.inc.php'; ?>
