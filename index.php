<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
    include INCLUDES . 'head.inc.php';
?>

<main>
    <div class="ui container">
        <!-- featured content -->
        <h2>Uitgelicht</h2>
        <div class="ui stackable two column grid highlightedcategories">
            <div class="column">
                <div class="ui fluid card">
                    <a class="image" href="category.php?cat=11116">
                        <img src="upload/highlightedCategories/MuntenEnBankbiljetten.png" alt="categorie munten en bankbiljetten">
                    </a>
                </div>
            </div>
            <div class="column">
                <div class="ui fluid card">
                    <a class="image" href="category.php?cat=888">
                        <img src="upload/highlightedCategories/Sport.png" alt="categorie sport">
                    </a>
                </div>
            </div>
        </div>
        <div class="ui stackable four column grid highlightedcategories">
            <div class="column">
                <div class="ui fluid card">
                    <a class="image" href="category.php?cat=9800">
                        <img src="upload/highlightedCategories/Auto.png" alt="categorie auto">
                    </a>
                </div>
            </div>
            <div class="column">
                <div class="ui fluid card">
                    <a class="image" href="category.php?cat=281">
                        <img src="upload/highlightedCategories/SieradenHorloge.png" alt="categorie sieraden">
                    </a>
                </div>
            </div>
            <div class="column">
                <div class="ui fluid card">
                    <a class="image" href="category.php?cat=11233">
                        <img src="upload/highlightedCategories/Muziek.png" alt="categorie muziek">
                    </a>
                </div>
            </div>
            <div class="column">
                <div class="ui fluid card">
                    <a class="image" href="category.php?cat=11232">
                        <img src="upload/highlightedCategories/FilmDVD.png" alt="categorie film en dvd">
                    </a>
                </div>
            </div>
        </div>

        <!-- Product showcase -->
        <h2>Producten</h2>
        <!-- Includes the functions random products to pick -->
        <div class="ui stackable five column grid">
            <?php
            $randomProducts = Database::getInstance()->query("SELECT TOP 10 * FROM Items WHERE NOT hidden = 'true' AND NOT closed = 'true' ORDER BY NEWID()");

            if ($randomProducts->count() < 1) {
                // no data passed by get
                echo "<p>Geen resultaten</p>";
            }

            foreach($randomProducts->results() as $result) { ?>
                <div class="column">
                    <div class="ui fluid card productcards">
                        <a class="image" href="product.php?p=<?= $result->id; ?>">
                            <img src="<?= ROOT . $result->thumbnail; ?>" alt="Foto van <?= escape($result->title); ?>">
                        </a>
                        <div class="content">
                            <a class="header" href="product.php?p=<?= $result->id; ?>"><?= escape($result->title); ?></a>
                            <div class="description"><?= escape(Modifiers::textlength($result->description, 100)); ?>...</div>
                            <div class="description bold">€<?= escape($result->price); ?></div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</main>

<?php include INCLUDES . 'footer.inc.php'; ?>
<?php include INCLUDES . 'foot.inc.php'; ?>