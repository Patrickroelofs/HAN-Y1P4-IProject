<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
    include INCLUDES . 'head.inc.php';

    $usrname = Session::get('username');

    // Get user products from database
    $userProducts = Database::getInstance()->query("SELECT TOP 5 * FROM Voorwerp WHERE verkoper = '$usrname'",array());
?>

<main>
    <div class="ui container">
        <!--Jouw lopende biedingen-->
        <h2>Jouw lopende biedingen</h2>
        <div class="ui stackable five column grid">
            <div class="five column row">
                <?php foreach ($userProducts->results() as $result) {
                    // Calculate time left in offer
                    $currentDate = new DateTime(date("Y-m-d"));
                    $endDate = new DateTime($result->looptijdeindedag);
                    $timeLeft = $currentDate->diff($endDate)->format("%d");
                    ?>
                    <div class="column">
                        <div class="ui fluid card">
                            <a class="image" href="product.php?p=<?= $result->voorwerpnummer; ?>">
                                <img src="http://iproject19.icasites.nl/pics/dt_1_<?= $result->thumbnail; ?>" alt="Foto van <?= $result->titel; ?>">
                            </a>
                            <div class="content">
                                <a class="header" href="product.php?p=<?= $result->voorwerpnummer; ?>"><?= $result->titel; ?></a>
                                <div class="description">Tijd tot verkoop: <?= $timeLeft ?></div>
                                <div class="description">Vanaf <span class="bold">€ <?= $result->startprijs ?></span></div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>

        <!--Aanbevolen rubrieken voor jou-->
        <h2>Aanbevolen rubrieken voor jou</h2>
        <div class="ui stackable four column grid">
            <div class="column">
                <div class="ui fluid card">
                    <a class="image" href="#">
                        <img src="https://place-hold.it/300x150" alt="rubriek-image">
                    </a>
                    <div class="content">
                        <a class="header" href="#">iPhones</a>
                    </div>
                </div>
            </div>
            <div class="column">
                <div class="ui fluid card">
                    <a class="image" href="#">
                        <img src="https://place-hold.it/300x150" alt="rubriek-image">
                    </a>
                    <div class="content">
                        <a class="header" href="#">Auto's</a>
                    </div>
                </div>
            </div>
            <div class="column">
                <div class="ui fluid card">
                    <a class="image" href="#">
                        <img src="https://place-hold.it/300x150" alt="rubriek-image">
                    </a>
                    <div class="content">
                        <a class="header" href="#">Laptops</a>
                    </div>
                </div>
            </div>
            <div class="column">
                <div class="ui fluid card">
                    <a class="image" href="#">
                        <img src="https://place-hold.it/300x150" alt="rubriek-image">
                    </a>
                    <div class="content">
                        <a class="header" href="#">Mondmaskers</a>
                    </div>
                </div>
            </div>
        </div>

        <!--Aanbevolen producten-->
        <h2>Aanbevolen producten</h2>
        <div class="ui stackable five column grid">
            <div class="five column row">
                <div class="column">
                    <div class="ui fluid card">
                        <a class="image" href="#">
                            <img src="https://place-hold.it/150x150" alt="product-image">
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
                            <img src="https://place-hold.it/150x150" alt="product-image">
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
                            <img src="https://place-hold.it/150x150" alt="product-image">
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
                            <img src="https://place-hold.it/150x150" alt="product-image">
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
                            <img src="https://place-hold.it/150x150" alt="product-image">
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

<?php include INCLUDES . 'footer.inc.php'; ?>
<?php include INCLUDES . 'foot.inc.php'; ?>