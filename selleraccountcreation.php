<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
include INCLUDES . 'head.inc.php';
include FUNCTIONS . 'selleraccountcreation.func.php';
?>

<main>
    <div class="ui equal width stackable grid">
        <div class="column vertical-margin-24"></div>
        <div class="column vertical-margin-24">
            <form class="ui large form" action="" method="post">
                <h2>Verkoop gegevens</h2>
                <div class="field">
                    <label for="bank">Bank naam</label>
                    <div class="ui selection dropdown">
                        <input type="hidden" name="bank" id="bank">
                        <i class="dropdown icon"></i>
                        <div class="default text">Bank</div>
                        <div class="menu">
                            <div class="item" data-value="ING">ING</div>
                            <div class="item" data-value="KNAB">KNAB</div>
                            <div class="item" data-value="Rabobank">Rabobank</div>
                        </div>
                    </div>
                </div>
                <div class="field">
                    <label for="bank number">Bankrekening nummer</label>
                    <input type="text" name="bankNummer" id="bankNummer" placeholder="Vul uw banknummer in">
                </div>
                <div class="field">
                    <label for="controleOptie">Controle optie</label>
                    <div class="ui selection dropdown">
                        <input type="hidden" name="controleOptie" id="controleOptie">
                        <i class="dropdown icon"></i>
                        <div class="default text">Controle optie</div>
                        <div class="menu">
                            <div class="item" data-value="Creditcard">Creditcard</div>
                            <div class="item" data-value="Post">Post</div>
                        </div>
                    </div>
                </div>
                <div class="field">
                    <label for="credit card">Creditcard / postnummer</label>
                    <input type="text" name="creditcard" id="creditcard" placeholder="Vul uw creditcard / post nummer in">
                </div>
                <input class="ui button" type="submit" name="updateBankgegevens" value="Update bankgegevens">
            </form>
        </div>
        <div class="column vertical-margin-24"></div>
    </div>
</main>

<?php include INCLUDES . 'footer.inc.php'; ?>
<?php include INCLUDES . 'foot.inc.php'; ?>
