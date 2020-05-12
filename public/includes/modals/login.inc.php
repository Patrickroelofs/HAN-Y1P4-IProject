<?php include FUNCTIONS . 'login.func.php' ?>

<div class="ui modal login-modal">
    <div class="ui placeholder segment">
        <div class="ui two column stackable center aligned grid">
            <div class="ui vertical divider mobile hidden">Of</div>

            <div class="middle aligned row">
                <div class="column">
                    <form class="ui large form" action="" method="post">
                        <h2 class="text-center">Login</h2>
                        <br>
                        <div class="field">
                            <label for="username">Gebruikersnaam</label>
                            <input type="text" name="username" id="username" placeholder="Username" required>
                        </div>
                        <div class="field">
                            <label for="password">Wachtwoord</label>
                            <input type="password" name="password" id="password" placeholder="Wachtwoord" required>
                        </div>
                        <input type="submit" name="login-submit" class="ui fluid large primary submit button"
                               value="login">
                        <div class="top-margin-12">
                            <a href="passwordChange.php">Wachtwoord vergeten?</a>
                        </div>
                    </form>
                </div>

                <div class="column">
                    <button class="large ui button" id="login-register-modal">Registreer account</button>
                </div>
            </div>
        </div>
    </div>
</div>