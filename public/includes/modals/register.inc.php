<?php include '../functions/register.func.php' ?>

<div class="ui modal small register-modal">
    <div class="ui placeholder segment">
        <form class="ui large form vertical-margin-12" action="" method="post">
            <h2 class="text-center">Registreren</h2>
            <br>
            <div class="field">
                <label for="username">Gebruikersnaam</label>
                <input type="text" name="username" id="username" placeholder="Username" required>
            </div>
            <div class="field">
                <label for="username">Email</label>
                <input type="email" name="email" id="email" placeholder="Email" required>
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
    </div>
</div>