<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
    include INCLUDES . 'head.inc.php';

    // If user is not logged in || User does not have a seller account
    if(!Session::exists('username') || $user->first()->trader == false){
        Redirect::to('index.php');
    }

    // If user account is not complete
    if($user->first()->complete == 0) {
        Message::warning('editprofile.php', array(
                'm' => 'Vul eerst alle gegevens in voordat je een advertentie plaatst!'
        ));
    }
?>
<main>
    <div class="ui container">
        <?php include FUNCTIONS . 'addAuction.func.php'; ?>
        <h2>Advertentie plaatsen</h2>

        <form action="" method="post" enctype="multipart/form-data" class="ui large form addAuction">
            <div class="field">
                <label for="titel">Titel *</label>
                <input class="input" type="text" name="titel" id="titel" placeholder="Titel voor uw advertentie">
            </div>

            <div class="three fields">
                <div class="field">
                    <label for="startprijs">Startprijs *</label>
                    <div class="ui labeled input">
                        <div class="ui label">€</div>
                        <input required type="number" min="0" name="startprijs" id="startprijs">
                    </div>
                </div>

                <div class="field">
                    <label for="looptijd">Looptijd *</label>
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

                <div class="field">
                    <label for="images">Afbeeldingen toevoegen (maximaal 4) *</label>
                    <input type="file" multiple name="images[]" id="images">
                </div>
            </div>


            <div class="field">
                <label for="beschrijving">Beschrijving *</label>
                <textarea required name="beschrijving" id="beschrijving"></textarea>
            </div>

            <div class="field">
                <label for="rubriek">Rubriek *</label>
                <div class="ui dropdown">
                    <input type="hidden" name="rubriek">
                    <span class="text">Klik hier om een rubriek te kiezen<i class="dropdown icon"></i></span>
                    <div class="menu">
                        <div class="ui icon search input">
                            <i class="search icon"></i>
                            <input type="text" placeholder="Zoeken in rubrieken...">
                        </div>
                        <div class="divider"></div>
                        <div class="scrolling menu">
                            <?php
                            $rubrieken = Database::getInstance()->query("SELECT * FROM Categories EXCEPT SELECT * FROM Categories WHERE id = -1");
                            foreach($rubrieken->results() as $result) {
                                ?>

                                <div class="item" data-value="<?= $result->id; ?>">
                                    <?= $result->name; ?>
                                </div>

                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="two fields">
                <div class="field">
                    <label for="betalingswijze">Betalingswijze *</label>
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

                <div class="field">
                    <label for="betalingsintructies">Betalingsinstructies</label>
                    <textarea name="betalingsintructies" id="betalingsintructies" rows="2"></textarea>
                </div>
            </div>

            <div class="two fields">
                <div class="field">
                    <label for="verzendkosten">Verzendkosten *</label>
                    <div class="ui labeled input">
                        <div class="ui label">€</div>
                        <input required type="number" min="0" name="verzendkosten" id="verzendkosten">
                    </div>
                </div>

                <div class="field">
                    <label for="verzendinstructies">Verzendinstructies</label>
                    <textarea name="verzendinstructies" id="verzendinstructies" rows="2"></textarea>
                </div>
            </div>

            <button name="auction-submit" id="auction-submit" class="ui primary button" type="submit">Advertentie plaatsen</button>
        </form>
    </div>
</main>

<?php include INCLUDES . 'footer.inc.php'; ?>
<?php include INCLUDES . 'foot.inc.php'; ?>