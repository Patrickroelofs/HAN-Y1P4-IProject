<div class="ui container">
    <div class="ui two column centered grid">
        <div class="ui segment">
            <form class="ui large form">
                <div class="stacked segment">
                    <h2 class="text-center">Registreren</h2>
                    <div class="ui two column centered grid">
                        <div class="two colomn centered row">
                            <div class="horizontal-margin-6">
                                <div class="field">
                                    <label for="username">Gebruikersnaam</label>
                                    <input type="text" name="username" id="username" placeholder="Gebruikersnaam..."
                                           required>
                                </div>
                            </div>
                            <div class="horizontal-margin-6">
                                <div class="field">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" placeholder="Email..." required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ui two column centered grid">
                        <div class="two colomn centered row">
                            <div class="horizontal-margin-6">
                                <div class="field">
                                    <label for="firstname">Voornaam</label>
                                    <input type="text" name="firstname" id="firstname" placeholder="Voornaam..."
                                           required>
                                </div>
                            </div>
                            <div class="horizontal-margin-6">
                                <div class="field">
                                    <label for="lastname">Achternaam</label>
                                    <input type="text" name="lastname" id="lastname" placeholder="Achternaam..."
                                           required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ui two column centered grid">
                        <div class="two colomn centered row">
                            <div class="horizontal-margin-6">
                                <div class="field">
                                    <label for="password">Wachtwoord</label>
                                    <input type="password" name="password" id="password" placeholder="Wachtwoord"
                                           required>
                                </div>
                            </div>
                            <div class="horizontal-margin-6">
                                <div class="field">
                                    <label for="repeat_password">Herhaal wachtwoord</label>
                                    <input type="password" name="repeat_password" id="repeat_password"
                                           placeholder="Wachtwoord" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ui two column centered grid">
                        <div class="two colomn centered row">
                            <div class="horizontal-margin-6">
                                <div class="field">
                                    <label for="adress">Adress</label>
                                    <input type="text" name="adress" id="adress" placeholder="Adress..." required>
                                </div>
                            </div>
                            <div class="horizontal-margin-6">
                                <div class="field">
                                    <label for="postalcode">Postcode</label>
                                    <input type="text" name="postalcode" id="postalcode" placeholder="Postcode..."
                                           required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ui two column centered grid">
                        <div class="two colomn centered row">
                            <div class="horizontal-margin-6">
                                <div class="field">
                                    <label for="place">Plaats</label>
                                    <input type="text" name="place" id="place" placeholder="Plaats..." required>
                                </div>
                            </div>
                            <div class="horizontal-margin-6">
                                <div class="field">
                                    <label for="country">Land</label>
                                    <input type="text" name="country" id="country" placeholder="Land..." required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ui two column centered grid ">
                        <div class="two colomn centered row">
                            <div class="horizontal-margin-6">
                                <div class="field">
                                    <label for="phone">Telefoon 1</label>
                                    <input type="text" name="phone" id="phone" placeholder="Telefoon 1..." required>
                                </div>
                            </div>
                            <div class="horizontal-margin-6">
                                <div class="field">
                                    <label for="phone_2">Telefoon 2</label>
                                    <input type="text" name="phone_2" id="phone_2" placeholder="Telefoon 2...">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="vertical-margin-12">
                        <div class="field">
                            <label for="birthdate">Geboorte datum</label>
                            <input type="text" name="birthdate" id="birthdate"
                                   placeholder="Geboorte datum (dd/mm/jjjj)..." required>
                        </div>
                    </div>
                    <div class="vertical-margin-12">
                        <div class="field">
                            <label for="secretQuestion">Geheime vraag</label>
                            <select class="ui dropdown">
                                <option value="">Geheime vraag</option>
                                <option value="1">Vraag 1</option>
                                <option value="0">Vraag 2</option>
                            </select>
                        </div>
                    </div>
                    <div class="vertical-margin-12">
                        <div class="field">
                            <label for="secretAnswer"></label>
                            <input type="text" name="secretAnswer" id="secretAnswer" placeholder="Antwoord..."
                                   required>
                        </div>
                    </div>
                    <button class="ui fluid large primary submit button">Registreer</button>
                </div>
            </form>
        </div>
    </div>
</div>
