<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
    include INCLUDES . 'head.inc.php';
?>

<main>
    <div class="ui container">
        <!-- featured content -->
        <h2>Uitgelicht</h2>
        <div class="ui stackable two column grid">
            <div class="column">
                <div class="ui fluid card">
                    <a class="image" href="category.php?cat=160">
                        <img src="images/highlightedCategories/Computers.png" alt="categorie computers">
                    </a>
                </div>
            </div>
            <div class="column">
                <div class="ui fluid card">
                    <a class="image" href="category.php?cat=9800">
                        <img src="images/highlightedCategories/Autos.png" alt="categorie autos">
                    </a>
                </div>
            </div>
        </div>
        <div class="ui stackable four column grid">
            <div class="column">
                <div class="ui fluid card">
                    <a class="image" href="category.php?cat=12081">
                        <img src="images/highlightedCategories/Baby.png">
                    </a>
                </div>
            </div>
            <div class="column">
                <div class="ui fluid card">
                    <a class="image" href="category.php?cat=281">
                        <img src="images/highlightedCategories/SieradenHorloge.png">
                    </a>
                </div>
            </div>
            <div class="column">
                <div class="ui fluid card">
                    <a class="image" href="category.php?cat=11233">
                        <img src="images/highlightedCategories/Muziek.png">
                    </a>
                </div>
            </div>
            <div class="column">
                <div class="ui fluid card">
                    <a class="image" href="category.php?cat=11232">
                        <img src="images/highlightedCategories/FilmDVD.png">
                    </a>
                </div>
            </div>
        </div>


        <?php if(Session::exists('username')) { ?>
        <!-- nearby -->
        <h2>In de buurt</h2>
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
        <?php } ?>

        <!-- Product showcase -->
        <h2>Producten</h2>
        <?php include FUNCTIONS . 'diverseProducts.func.php' ?>
        <div class="ui stackable five column grid">
            <?php foreach($stmt->results() as $result) { ?>

                <div class="column">
                    <div class="ui fluid card">
                        <a class="image" href=<?php echo 'product.php?p=' . $result->voorwerpnummer ?> >
                            <img src="https://place-hold.it/150x150">
                        </a>
                        <div class="content">
                            <a class="header" href="#"><?php echo $result->titel; ?></a>
                            <div class="description"><?php echo $result->beschrijving; ?></div>
                            <div class="description bold">€<?php echo $result->startprijs; ?></div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
    </div>
</main>

<?php include INCLUDES . 'footer.inc.php'; ?>
<?php include INCLUDES . 'foot.inc.php'; ?>