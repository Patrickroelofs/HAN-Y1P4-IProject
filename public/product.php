<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
    include INCLUDES . 'head.inc.php';
    include FUNCTIONS . 'makeOffer.func.php'
?>

<main>
    <div class="ui container">

        <h2>Product</h2>
        <div class="vertical-margin-12">
            <div class="ui label">
                <i>Lorem Ipsum</i>
            </div>
            <div class="ui label">
                <i>Lorem Ipsum</i>
            </div>
            <div class="ui label">
                <i>Lorem Ipsum</i>
            </div>
        </div>

        <div class="ui grid" >
            <div class="eight wide column">
                <img src="https://place-hold.it/400x400">
            </div>
            <div class="eight wide column">
                <div class="ui segment">
                    <h2>Beschrijving</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi dignissimos eligendi quo.</p>

                    <div class="ui input labeled input">
                        <button type="submit" id="makeOffer" class="ui primary labeled icon button">
                            <i class="gavel icon"></i>
                            Bieden
                        </button>
                        <?php include 'includes/modals/makeOffer.inc.php' ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="ui segment">
            <h2>Meer zoals</h2>
            <div class="ui grid">
                <div class="two wide column">
                    <img src="https://place-hold.it/90x90">
                </div>
                <div class="two wide column">
                    <img src="https://place-hold.it/90x90">
                </div>
                <div class="two wide column">
                    <img src="https://place-hold.it/90x90">
                </div>
                <div class="two wide column">
                    <img src="https://place-hold.it/90x90">
                </div>
                <div class="two wide column">
                    <img src="https://place-hold.it/90x90">
                </div>
                <div class="two wide column">
                    <img src="https://place-hold.it/90x90">
                </div>
                <div class="two wide column">
                    <img src="https://place-hold.it/90x90">
                </div>
                <div class="two wide column">
                    <img src="https://place-hold.it/90x90">
                </div>
            </div>
        </div>

    </div>
</main>

<?php include INCLUDES . 'footer.inc.php'; ?>
<?php include INCLUDES . 'foot.inc.php'; ?>