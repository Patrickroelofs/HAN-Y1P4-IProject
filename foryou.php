<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
    include INCLUDES . 'head.inc.php';

    if(!Session::exists('username')){
        Redirect::to('index.php');
    }

    // Get user products from database
    $userProducts = Database::getInstance()->query("SELECT TOP 5 * FROM Items WHERE trader = '". Session::get('username') . "'", array());
?>

<main>
    <div class="ui container">
        <h2 id="yourSoldAuctions">Gesloten advertenties</h2>
        <?php if($user->first()->trader) { ?>
        <div class="ui stackable five column grid">
            <?php foreach($userProducts->results() as $result) {
                if($result->closed) {
                    ?>

                    <div class="column">
                        <div class="ui fluid card">
                            <a class="image" href="product.php?p=<?= $result->id; ?>">
                                <img src="<?= ROOT . $result->thumbnail; ?>" alt="Foto van <?= $result->title; ?>">
                            </a>
                            <div class="content">
                                <a class="header" href="product.php?p=<?= $result->id; ?>"><?= $result->title; ?></a>
                                <div class="description">Verkocht voor <span class="bold">€ <?= $result->saleprice ?></span></div>
                            </div>
                        </div>
                    </div>

                    <?php
                } else { echo '<p>Geen gesloten advertenties...</p><br><br><br>'; }
            }
            ?>
        </div>
        <?php } ?>

        <?php if($user->first()->trader && !$userProducts->count() <= 0) { ?>
        <h2 id="yourAuctions">Lopende advertenties</h2>
        <div class="ui stackable five column grid">
            <div class="five column row">
                <?php foreach ($userProducts->results() as $result) {
                    // Calculate time left in offer
                    $currentDate = new DateTime(date("Y-m-d"));
                    $endDate = new DateTime($result->durationenddate);
                    if ($endDate > $currentDate) {
                        $timeLeft = $currentDate->diff($endDate)->format("%d");
                    } else {
                        $timeLeft = 0;
                    }

                    if(!$result->closed) {
                    ?>
                    <div class="column">
                        <div class="ui fluid card">
                            <a class="image" href="product.php?p=<?= $result->id; ?>">
                                <img src="<?= ROOT . $result->thumbnail; ?>" alt="Foto van <?= $result->title; ?>">
                            </a>
                            <div class="content">
                                <a class="header" href="product.php?p=<?= $result->id; ?>"><?= $result->title; ?></a>
                                <div class="description">Tijd tot verkoop: <?= $timeLeft ?> dagen</div>
                                <div class="description">Vanaf <span class="bold">€ <?= $result->price ?></span></div>
                            </div>
                        </div>
                    </div>
                <?php } else { echo '<div class="column"><p>Geen lopende advertenties...</p></div>'; }
                } ?>
            </div>
        </div>
    <?php } ?>

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