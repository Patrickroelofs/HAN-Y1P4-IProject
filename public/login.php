<?php
    require_once '../core/init.php';
    include 'includes/head.inc.php';
?>

<?php include 'includes/navigation.inc.php'; ?>

<main>
    <div class="ui container">
        <div class="ui two column centered grid">
            <div class="column">
                <div class="ui segment">
                    <form class="ui large form">
                        <div class="stacked segment">
                            <h2 class="text-center">Login</h2>
                            <div class="field">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" placeholder="Email" required>
                            </div>
                            <div class="field">
                                <label for="password">Wachtwoord</label>
                                <input type="password" name="password" id="password" placeholder="Wachtwoord" required>
                            </div>
                            <button class="ui fluid large primary submit button">Login</button>
                            <div class="vertical-margin-12">
                                <button class="ui fluid large primary submit button">Klik hier om te registreren</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'includes/footer.inc.php'; ?>
<?php include 'includes/foot.inc.php'; ?>
