<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
    include INCLUDES . 'head.inc.php';
    include FUNCTIONS . 'login.func.php';
?>

<main>
    <div class="ui container">
        <div class="ui two column centered grid">
            <div class="column">
                <div class="ui segment">
                    <form class="ui large form" action="" method="post">
                        <div class="stacked segment">
                            <h2 class="text-center">Login</h2>
                            <div class="field">
                                <label for="username">Gebruikersnaam</label>
                                <input type="text" name="username" id="username" placeholder="Username" required>
                            </div>
                            <div class="field">
                                <label for="password">Wachtwoord</label>
                                <input type="password" name="password" id="password" placeholder="Wachtwoord" required>
                            </div>
                            <input type="submit" name="login-submit" class="ui fluid large primary submit button" value="login">
                            <div class="vertical-margin-12">
                                <a href="register.php" class="ui fluid large primary submit button">Klik hier om te registreren</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include INCLUDES . 'footer.inc.php'; ?>
<?php include INCLUDES . 'foot.inc.php'; ?>