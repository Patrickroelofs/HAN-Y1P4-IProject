<?php
    require_once '../core/init.php';

    if(!Session::exists('username')){
        Redirect::to('../index.php');
    }

    include '../functions/profile.func.php';
    include 'includes/head.inc.php';
?>

    <main>
        <div class="ui container">
            <img class="ui small circular image" src="<?= $user->first()->profielfoto ?>">
            <h1>Hoi,
                <?php if(empty($user->first()->voornaam) || empty($user->first()->achternaam)) {
                    echo $user->first()->gebruikersnaam;
                } else {
                    echo $user->first()->voornaam . ' ' . $user->first()->achternaam;
                }
                ?>
            </h1>
            <p>Pas hier je gegevens aan, zo kunnen verkopers beter zien wie jij bent!</p>
            <div class="ui horizontal divider">
                Gegevens aanpassen
            </div>

            <div class="ui equal width grid">
                <div class="column vertical-margin-24">
                    <form class="ui large form" action="" method="post">
                        <h2>Inloggegevens</h2>
                        <div class="field">
                            <label for="username">Gebruikersnaam</label>
                            <div class="ui disabled input">
                                <input type="text" name="username" id="username" placeholder="<?= $user->first()->gebruikersnaam ?>">
                            </div>
                        </div>
                        <div class="field">
                            <label for="email">Emailadres</label>
                            <div class="ui disabled input">
                                <?php //TODO: Include actual emailadres in disabled field ?>
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

                <div class="column vertical-margin-24">
                    <form class="ui large form" action="" method="post" enctype="multipart/form-data">
                        <h2>Persoonsgegevens</h2>
                        <div class="field">
                            <label for="profilepicture">Profiel foto</label>
                            <input type="file" name="profilepicture" id="profilepicture">
                        </div>
                        <div class="field">
                            <label for="firstname">Voornaam</label>
                            <input type="text" name="firstname" id="firstname" placeholder="<?= $user->first()->voornaam ?>">
                        </div>
                        <div class="field">
                            <label for="lastname">Achternaam</label>
                            <input type="text" name="lastname" id="lastname" placeholder="<?= $user->first()->achternaam ?>">
                        </div>
                        <div class="field">
                            <label for="dob">Geboortedatum</label>
                            <div class="ui calendar" id="dob_calendar">
                                <div class="ui input left icon">
                                    <i class="calendar icon"></i>
                                    <input name="dob" type="text" placeholder="<?= $user->first()->geboortedag ?>">
                                </div>
                            </div>
                        </div>
                        <input class="ui button" type="submit" name="update-persoonsgegevens-submit" value="Persoonsgegevens aanpassen">
                    </form>
                </div>

                <div class="column vertical-margin-24">
                    <form class="ui large form" action="" method="post">
                        <h2>Locatiegegevens</h2>
                        <div class="field">
                            <label for="adresregel1">Adresregel 1</label>
                            <input type="text" name="adresregel1" id="adresregel1" placeholder="<?= $user->first()->adresregel1 ?>">
                        </div>
                        <div class="field">
                            <label for="adresregel2">Adresregel 2</label>
                            <input type="text" name="adresregel2" id="adresregel2" placeholder="<?= $user->first()->adresregel2 ?>">
                        </div>
                        <div class="field">
                            <label for="postcode">Postcode</label>
                            <input type="text" name="postcode" id="postcode" placeholder="<?= $user->first()->postcode ?>">
                        </div>
                        <div class="field">
                            <label for="plaatsnaam">Plaatsnaam</label>
                            <input type="text" name="plaatsnaam" id="plaatsnaam" placeholder="<?= $user->first()->plaatsnaam ?>">
                        </div>
                        <div class="field">
                            <label for="land">Land</label>
                            <input type="text" name="land" id="land" placeholder="<?= $user->first()->landnaam ?>">
                        </div>
                        <input class="ui button" type="submit" name="update-locatiegegevens-submit" value="Locatiegegevens aanpassen">
                    </form>
                </div>
            </div>
        </div>
    </main>

<?php include 'includes/footer.inc.php'; ?>
<?php include 'includes/foot.inc.php'; ?>