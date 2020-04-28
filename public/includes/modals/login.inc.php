<?php include '../functions/login.func.php' ?>

<div class="ui modal login-modal">
    <div class="ui placeholder segment">
        <div class="ui two column stackable center aligned grid">
            <div class="ui vertical divider">Of</div>

            <div class="middle aligned row">
                <div class="">
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
                        <input type="submit" name="login-submit" class="ui fluid large primary submit button" value="login">
                    </form>
                </div>
                <div class="column">

                </div>
            </div>
        </div>
    </div>
</div>