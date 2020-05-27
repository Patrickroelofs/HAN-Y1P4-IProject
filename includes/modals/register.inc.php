<?php include FUNCTIONS . 'register.func.php' ?>

<div class="ui modal small register-modal">
    <div class="ui placeholder segment">
        <form class="ui large form vertical-margin-12" action="" method="post">
            <h2 class="text-center">Registreren</h2>
            <br>
            <div class="field">
                <label for="username">Gebruikersnaam</label>
                <input type="text" value="<?php if(isset($_GET['username'])) { echo Message::get('username'); } ?>" name="username" id="username" placeholder="Username" required>
            </div>
            <div class="field">
                <label for="username">Email</label>
                <input type="email" value="<?php if(isset($_GET['email'])) { echo Message::get('email'); } ?>" name="email" id="email" placeholder="Email" required>
            </div>
            <div class="field">
                <label for="password">Wachtwoord</label>
                <input type="password" name="password" id="password" placeholder="Wachtwoord" required>
            </div>
            <div class="field">
                <label for="password">Wachtwoord</label>
                <input type="password" name="password_repeat" id="password_repeat" placeholder="Wachtwoord herhalen"
                       required>
            </div>
            <input type="submit" name="register-submit" class="ui fluid large primary submit button"
                   value="Account aanmaken">
        </form>
        <section>
            <div class="ui container selling-point">
                <div class="centered aligned ui five column grid">
                    <div class="row">
                        <div class="centered aligned column sixteen wide mobile tablet four wide computer">
                            <div class="vertical-margin-12">
                                <i class="ui big registered icon"></i>
                                <p class="bold">Registeer</p>
                                <p class="left aligned">Vul alle benodigde informatie in zodat u zich kan registeren.</p>
                            </div>
                        </div>
                        <div class="centered aligned column sixteen wide mobile tablet four wide computer">
                            <div class="vertical-margin-12">
                                <i class="ui big address book icon"></i>
                                <p class="bold">Account volledig maken</p>
                                <div class="left floating"><p>Vul verdere benodigde informatie zodat uw account volledig is.</p></div>
                            </div>
                        </div>
                        <div class="centered aligned column sixteen wide mobile tablet four wide computer">
                            <div class="vertical-margin-12">
                                <i class="ui big gavel icon"></i>
                                <p class="bold">Bieden op producten</p>
                                <p>Bied op producten om zo veilingen te winnen.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>