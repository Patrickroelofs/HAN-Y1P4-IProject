<?php
    require_once '../core/init.php';
    include 'includes/head.inc.php';
?>

<main>
    <!-- Buttons, map -->
    <div class="ui container">
        <h2>Dichtbij</h2>
        <div class="ui grid">
            <div class="four wide column">
                <form id="search" method="get" action="">
                    <div class="ui search fluid">
                        <div class="ui icon input">
                            <input class="prompt" type="text" placeholder="Zoek hier..." name="query">
                            <i class="search icon"></i>
                        </div>

                        <div class="results">
                            <!-- Search results -->
                        </div>
                    </div>
                </form>
            </div>
            <div class="four wide column">
                <div class="field">
                    <select class="ui dropdown">
                        <option value="">Catogorieën</option>
                        <option value="1">Catogorie 1</option>
                        <option value="0">Catogorie 2</option>
                    </select>
                </div>
            </div>
            <div class="two wide column">
                <form id="search" method="get" action="">
                    <div class="ui search fluid">
                        <input class="prompt" type="text" placeholder="Postcode..." name="query">
                    </div>
            </div>
            </form>
        </div>
        <div class="column">
            <img src="https://place-hold.it/1100x300">
        </div>


        <!-- Product row -->
        <h2>Producten dichtbij</h2>
        <div class="ui stackable five column grid">
            <div class="five column row">
                <div class="column">
                    <div class="ui fluid card">
                        <a class="image" href="#">
                            <img src="https://place-hold.it/150x150">
                        </a>
                        <div class="content">
                            <a class="header" href="#">Product</a>
                            <div class="description">€52,00</div>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="ui fluid card">
                        <a class="image" href="#">
                            <img src="https://place-hold.it/150x150">
                        </a>
                        <div class="content">
                            <a class="header" href="#">Product</a>
                            <div class="description">€52,00</div>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="ui fluid card">
                        <a class="image" href="#">
                            <img src="https://place-hold.it/150x150">
                        </a>
                        <div class="content">
                            <a class="header" href="#">Product</a>
                            <div class="description">€52,00</div>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="ui fluid card">
                        <a class="image" href="#">
                            <img src="https://place-hold.it/150x150">
                        </a>
                        <div class="content">
                            <a class="header" href="#">Product</a>
                            <div class="description">€52,00</div>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="ui fluid card">
                        <a class="image" href="#">
                            <img src="https://place-hold.it/150x150">
                        </a>
                        <div class="content">
                            <a class="header" href="#">Product</a>
                            <div class="description">€52,00</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'includes/footer.inc.php'; ?>
<?php include 'includes/foot.inc.php'; ?>