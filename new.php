<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
include INCLUDES . 'head.inc.php';
?>

    <main>
        <div class="ui container">
            <h1>Nieuwe producten op de site</h1>
            <div class="ui stackable five column grid">
                <?php
                $newItems = Database::getInstance()->query("SELECT TOP 20 * FROM Items ORDER BY id DESC");

                if ($newItems->count() < 1) {
                    // no data passed by get
                    echo "<p>Geen resultaten</p>";
                }

                foreach($newItems->results() as $result) { ?>
                    <div class="column">
                        <div class="ui fluid card productcards">
                            <a class="image" href="product.php?p=<?= $result->id; ?>">
                                <img src="<?= ROOT . $result->thumbnail; ?>" alt="Foto van <?= $result->title; ?>">
                            </a>
                            <div class="content">
                                <a class="header" href="product.php?p=<?= $result->id; ?>"><?= $result->title; ?></a>
                                <div class="description"><?= Modifiers::textlength($result->description, 100); ?>...</div>
                                <div class="description bold">€<?= $result->price; ?></div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </main>

<?php include INCLUDES . 'footer.inc.php'; ?>
<?php include INCLUDES . 'foot.inc.php'; ?>