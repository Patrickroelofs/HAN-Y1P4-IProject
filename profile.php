<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';

    if(!Session::exists('username')){
        Redirect::to('index.php');
    }

    include FUNCTIONS . 'profile.func.php';
    include INCLUDES . 'head.inc.php';
?>

    <main>
        <div class="ui container">
            <img class="ui small circular image profilepicture" src="<?php
            if(empty($user->first()->profilepicture)) {
                echo ROOT . 'upload/profilepictures/default.jpg';
            } else {
                echo escape($user->first()->profilepicture);
            }
            ?>">
            <h1>Hoi,
                <?php if(empty($user->first()->firstname) || empty($user->first()->lastname)) {
                    echo escape($user->first()->username);
                } else {
                    echo escape($user->first()->firstname) . ' ' . escape($user->first()->lastname);
                }
                ?>
            </h1>
            <p>Pas hier je gegevens aan, zo kunnen verkopers beter zien wie jij bent!</p>
            <div class="ui horizontal divider">
                Gegevens aanpassen
            </div>

            <div class="ui equal width stackable grid">
                <div class="column vertical-margin-24">
                    <form class="ui large form" action="" method="post">
                        <h2>Inloggegevens</h2>
                        <div class="field">
                            <label for="username">Gebruikersnaam</label>
                            <div class="ui disabled input">
                                <input type="text" name="username" id="username" placeholder="<?= escape($user->first()->username) ?>">
                            </div>
                        </div>
                        <div class="field">
                            <label for="email">Emailadres</label>
                            <div class="ui disabled input">
                                <input type="email" name="email" id="email" placeholder="<?= escape($user->first()->email) ?>">
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
                            <label for="firstname">Voornaam *</label>
                            <input required type="text" name="firstname" id="firstname" placeholder="<?= escape($user->first()->firstname) ?>" value="<?= escape($user->first()->firstname) ?>">
                        </div>
                        <div class="field">
                            <label for="lastname">Achternaam *</label>
                            <input required type="text" name="lastname" id="lastname" placeholder="<?= escape($user->first()->lastname) ?>" value="<?= escape($user->first()->lastname) ?>">
                        </div>
                        <div class="field">
                            <label for="lastname">Telefoonnummer</label>
                            <input required type="number" name="phone" id="phone" placeholder="<?= escape($user->first()->phone) ?>" value="<?= escape($user->first()->phone) ?>">
                        </div>
                        <div class="field">
                            <label for="dob">Geboortedatum  *</label>
                            <div class="ui calendar" id="dob_calendar">
                                <div class="ui input left icon">
                                    <i class="calendar icon"></i>
                                    <input required name="dob" type="text" autocomplete="off" placeholder="<?= escape($user->first()->birthdate) ?>" value="<?= escape($user->first()->birthdate) ?>">
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
                            <label for="adresregel1">Adresregel 1 *</label>
                            <input required type="text" name="adresregel1" id="adresregel1" placeholder="<?= escape($user->first()->address1) ?>" value="<?= escape($user->first()->address1) ?>">
                        </div>
                        <div class="field">
                            <label for="adresregel2">Adresregel 2</label>
                            <input type="text" name="adresregel2" id="adresregel2" placeholder="<?= escape($user->first()->address2) ?>" value="<?= escape($user->first()->address2) ?>">
                        </div>
                        <div class="field">
                            <label for="postcode">Postcode *</label>
                            <input required type="text" name="postcode" id="postcode" placeholder="<?= escape($user->first()->postalcode) ?>" value="<?= escape($user->first()->postalcode) ?>">
                        </div>
                        <div class="field">
                            <label for="plaatsnaam">Plaatsnaam *</label>
                            <input required type="text" name="plaatsnaam" id="plaatsnaam" placeholder="<?= escape($user->first()->city) ?>" value="<?= escape($user->first()->city) ?>">
                        </div>
                        <div class="field">

                            <label for="land">Land *</label>
                            <div class="ui fluid search selection dropdown">
                                <input type="hidden" name="land">
                                <i class="dropdown icon"></i>
                                <div class="default text">
                                    <?php if ($user->first()->complete == true) {
                                        $countryCode = $user->first()->country;
                                        $countryName = Database::getInstance()->query("SELECT * FROM Country WHERE code = $countryCode",array());
                                        echo $countryName->first()->name;
                                    } else {
                                        echo "Land kiezen";
                                    } ?>

                                </div>
                                <div class="menu">
                                    <?php
                                    $countries = Database::getInstance()->query("SELECT * FROM Country");

                                    foreach($countries->results() as $country) {
                                            ?>
                                            <div class="item" data-value="<?= $country->code ?>"><?= escape($country->name) ?></div>
                                            <?php
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>

                        <input class="ui button" type="submit" name="update-locatiegegevens-submit" value="Locatiegegevens aanpassen">
                    </form>
                </div>
            </div>
        </div>
    </main>

<?php include INCLUDES . 'footer.inc.php'; ?>
<?php include INCLUDES . 'foot.inc.php'; ?>
