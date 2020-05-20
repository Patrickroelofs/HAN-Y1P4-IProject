<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
include INCLUDES . 'head.inc.php';
?>

<main>
    <div class="ui container">
        <h2>Zoekresultaten</h2>
        <?php include FUNCTIONS . 'searchResults.func.php' ?>

        <div class="thirteen wide column">
            <div class="ui stackable five column grid">
                <?php foreach($stmt->results() as $result) { ?>
                <div class="column">
                    <div class="ui fluid card">
                        <a class="image" href="<?php echo 'product.php?p=' . $result->id ?>">
                            <img src="<?= ROOT .  escape($result->thumbnail); ?>" alt="Foto van <?= escape($result->title); ?>">
                        </a>
                        <div class="content">
                            <a class="header" href="<?php echo 'product.php?p=' . escape($result->id) ?>"><?php echo escape($result->title); ?></a>
                            <div class="description"><?php echo escape(Modifiers::textlength($result->description, 100)); ?></div>
                            <div class="description bold">€<?php echo escape($result->price); ?></div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>

    </div>
</main>

<?php include INCLUDES . 'footer.inc.php'; ?>
<?php include INCLUDES . 'foot.inc.php'; ?>
