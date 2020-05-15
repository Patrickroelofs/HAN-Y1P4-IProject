<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
    include INCLUDES . 'head.inc.php';

    // If user is not logged in || User does not have a seller account
    if(!Session::exists('username') || $user->first()->verkoper == false){
        Redirect::to('index.php');
    }

    // If user account is not complete
    if($user->first()->compleet == 0) {
        Message::warning('profile.php', array(
                'm' => 'Vul eerst alle gegevens in voordat je een advertentie plaatst!'
        ));
    }
?>

    <main>
        <div class="ui container">
            <?php include FUNCTIONS . 'addAuction.func.php'; ?>
            <h2>Advertentie plaatsen</h2>

            <form action="" method="post" enctype="multipart/form-data" class="ui large form addAuction">
                <label for="images">Afbeeldingen toevoegen (maximaal 4)</label>
                <div class="field">
                    <input type="file" multiple name="images[]" id="images">
                </div>

                <label for="titel">Titel</label>
                <div class="fields">
                    <input class="input" type="text" name="titel" id="titel" placeholder="...">
                </div>

                <label for="beschrijving">Beschrijving</label>
                <div class="field">
                    <textarea name="beschrijving" id="beschrijving"></textarea>
                </div>

                <label for="rubriek">Rubriek</label>
                <div class="field">
                    <div class="ui dropdown">
                        <input type="hidden" name="rubriek">
                        <span class="text">Klik hier om een rubriek te kiezen</span>
                        <div class="menu">
                            <div class="ui icon search input">
                                <i class="search icon"></i>
                                <input type="text" placeholder="Zoeken in rubrieken...">
                            </div>
                            <div class="divider"></div>
                            <div class="scrolling menu">
                                <?php
                                $rubrieken = Database::getInstance()->query("SELECT * FROM Rubriek EXCEPT SELECT * FROM Rubriek WHERE rubrieknummer = -1");
                                foreach($rubrieken->results() as $result) {
                                    ?>

                                    <div class="item" data-value="<?= $result->rubrieknummer; ?>">
                                        <?= $result->rubrieknaam; ?>
                                    </div>

                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <label for="startprijs">Startprijs</label>
                <div class="field">
                    <input type="number" name="startprijs" id="startprijs">
                </div>

                <label for="betalingswijze">Betalingswijze</label>
                <div class="ui input fluid">
                    <div class="ui selection dropdown fluid">
                        <input type="hidden" name="betalingswijze">
                        <i class="dropdown icon"></i>
                        <div class="default text">Betalingswijze</div>
                        <div class="menu">
                            <div class="item" data-value="Bank/giro">Bank/giro</div>
                            <div class="item" data-value="Paypal">Paypal</div>
                        </div>
                    </div>
                </div>

                <label for="betalingsintructies">Betalingsinstructies</label>
                <div class="ui input fluid">
                    <textarea name="betalingsintructies" id="betalingsintructies"></textarea>
                </div>

                <label for="looptijd" class="top-margin-12">Looptijd</label>
                <div class="ui input fluid">
                    <div class="ui selection dropdown fluid">
                        <input type="hidden" name="looptijd">
                        <i class="dropdown icon"></i>
                        <div class="default text">Looptijd</div>
                        <div class="menu">
                            <div class="item" data-value="1">1 dag</div>
                            <div class="item" data-value="3">3 dagen</div>
                            <div class="item" data-value="5">5 dagen</div>
                            <div class="item" data-value="7">7 dagen</div>
                            <div class="item" data-value="10">10 dagen</div>
                        </div>
                    </div>
                </div>

                <label for="verzendkosten">Verzendkosten</label>
                <div class="ui input field fluid">
                    <input type="number" name="verzendkosten" id="verzendkosten">
                </div>

                <label for="verzendinstructies">Verzendinstructies</label>
                <div class="ui input field fluid">
                    <textarea class="full-width" name="verzendinstructies" id="verzendinstructies"></textarea>
                </div>



                    <div class="ui input vertical-margin-12">
                    <input type="submit" name="auction-submit" id="auction-submit" value="Advertentie plaatsen">
                </div>
            </form>
        </div>
    </main>

<?php include INCLUDES . 'footer.inc.php'; ?>
<?php include INCLUDES . 'foot.inc.php'; ?>