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
        <h2>Wachtwoord vergeten</h2>
        <p>Weet je het wachtwoord niet meer? Vul hieronder je e-mailadres in. We sturen dan binnen enkele minuten een
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

<?php include INCLUDES . 'footer.inc.php'; ?>
<?php include INCLUDES . 'foot.inc.php'; ?>
