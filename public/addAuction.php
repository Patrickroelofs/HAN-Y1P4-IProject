<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
    include INCLUDES . 'head.inc.php';

    // If user is not logged in || User does not have a seller account
    if(!Session::exists('username') || $user->first()->verkoper == false){
        Redirect::to('index.php');
    }

    // If user account is not complete
    if($user->first()->compleet == 0) {
        Redirect::to('profile.php?err=notComplete');
    }
?>

    <main>
        <div class="ui container">
            <?php include FUNCTIONS . 'addAuction.func.php'; ?>
            <h2>Advertentie plaatsen</h2>

            <form action="" method="post" class="addAuction">


                <div class="ui two column stackable grid">
                    <div class="column">
                        <h3>Foto's</h3>
                    </div>
                    <div class="column">
                        <h3>Beschrijving</h3>
                        <label for="titel">Titel</label>
                        <div class="ui input fluid">
                            <input type="text" name="titel" id="titel">
                        </div>

                        <label for="beschrijving">Beschrijving</label>
                        <div class="ui input fluid">
                            <textarea class="full-width" name="beschrijving" id="beschrijving"></textarea>
                        </div>
                    </div>

                    <div class="column">
                        <h3>Betaling</h3>
                        <label for="startprijs">Startprijs</label>
                        <div class="ui input fluid">
                            <input type="number" name="startprijs" id="startprijs">
                        </div>

                        <label for="betalingswijze">Betalingswijze</label>
                        <div class="ui input fluid">
                            <div class="ui selection dropdown fluid">
                                <input type="hidden" name="betalingswijze">
                                <i class="dropdown icon"></i>
                                <div class="default text">Betalingswijze</div>
                                <div class="menu">
                                    <div class="item" data-value="1">Bank/giro</div>
                                    <div class="item" data-value="0">Paypal</div>
                                </div>
                            </div>
                        </div>

                        <label for="betalingsintructies">Betalingsinstructies</label>
                        <div class="ui input fluid">
                            <textarea class="full-width" name="betalingsintructies" id="betalingsintructies"></textarea>
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
                    </div>
                    <div class="column">
                        <h3>Verzenden</h3>
                        <label for="verzendkosten">Verzendkosten</label>
                        <div class="ui input field fluid">
                            <input type="number" name="verzendkosten" id="verzendkosten">
                        </div>

                        <label for="verzendinstructies">Verzendinstructies</label>
                        <div class="ui input field fluid">
                            <textarea class="full-width" name="verzendinstructies" id="verzendinstructies"></textarea>
                        </div>
                    </div>
                </div>

                <div class="ui input vertical-margin-12">
                    <input type="submit" name="auction-submit" id="auction-submit" value="Advertentie plaatsen">
                </div>
            </form>
        </div>
    </main>

<?php include INCLUDES . 'footer.inc.php'; ?>
<?php include INCLUDES . 'foot.inc.php'; ?>