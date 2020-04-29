<?php
    require_once '../core/init.php';
    include 'includes/head.inc.php';
    include '../functions/profile.func.php';
?>

    <main>
        <div class="ui container">
            <h1>Hoi, <?php echo Session::get('username'); ?></h1>
            <p>Pas hier je gegevens aan, zo kunnen verkopers beter zien wie jij bent!</p>
            <div class="ui horizontal divider">
                Gegevens aanpassen
            </div>

            <form class="ui large form" action="" method="post">
                <div class="ui equal width grid">
                    <div class="column vertical-margin-24">
                        <h2>Inloggegevens</h2>
                        <div class="field">
                            <label for="username">Gebruikersnaam</label>
                            <input type="text" name="username" id="username" placeholder="...">
                        </div>
                        <div class="field">
                            <label for="email">Emailadres</label>
                            <input type="email" name="email" id="email" placeholder="...">
                        </div>
                        <div class="field">
                            <label for="password">Wachtwoord</label>
                            <input type="password" name="password" id="password" placeholder="...">
                        </div>
                        <div class="field">
                            <label for="password_repeat">Wachtwoord herhalen</label>
                            <input type="password" name="password_repeat" id="password_repeat" placeholder="...">
                        </div>
                    </div>

                    <div class="column vertical-margin-24">
                        <h2>Persoonsgegevens</h2>
                        <div class="field">
                            <label for="firstname">Voornaam</label>
                            <input type="text" name="firstname" id="firstname" placeholder="...">
                        </div>
                        <div class="field">
                            <label for="lastname">Achternaam</label>
                            <input type="text" name="lastname" id="lastname" placeholder="...">
                        </div>
                        <div class="field">
                            <label for="dob">Geboortedatum</label>
                            <div class="ui calendar" id="dob_calendar">
                                <div class="ui input left icon">
                                    <i class="calendar icon"></i>
                                    <input name="dob" type="text" placeholder="...">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="column vertical-margin-24">
                        <h2>Locatiegegevens</h2>
                        <div class="field">
                            <label for="adresregel1">Adresregel 1</label>
                            <input type="text" name="adresregel1" id="adresregel1" placeholder="...">
                        </div>
                        <div class="field">
                            <label for="adresregel2">Adresregel 2</label>
                            <input type="text" name="adresregel2" id="adresregel2" placeholder="...">
                        </div>
                        <div class="field">
                            <label for="postcode">Postcode</label>
                            <input type="text" name="postcode" id="postcode" placeholder="...">
                        </div>
                        <div class="field">
                            <label for="plaatsnaam">Plaatsnaam</label>
                            <input type="text" name="plaatsnaam" id="plaatsnaam" placeholder="...">
                        </div>
                        <div class="field">
                            <label for="land">Land</label>
                            <input type="text" name="land" id="land" placeholder="...">
                        </div>

                        <input class="ui button" type="submit" name="update-submit" value="Profiel aanpassen">
                    </div>
                </div>
            </form>
        </div>
    </main>

<?php include 'includes/footer.inc.php'; ?>
<?php include 'includes/foot.inc.php'; ?>