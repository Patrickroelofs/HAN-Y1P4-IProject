<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
include INCLUDES . 'head.inc.php';
?>

<main>
    <div class="ui container">
        <h2>Zoekresultaten</h2>
        <?php include FUNCTIONS . 'search.func.php' ?>

        <div class="thirteen wide column">
            <div class="ui stackable five column grid">
                <?php
                    if ($stmt->count() < 1) {
                        // no data passed by get
                        echo "<p>Geen resultaten</p>";
                    }
                ?>
                <?php foreach($stmt->results() as $result) {
                    if($result->hidden == false && $result->closed == false || Admin::isLoggedIn()) { ?>
                <div class="column">
                    <div class="ui fluid card productcards <?php if($result->hidden) { echo 'itemhidden'; } ?>">
                        <a class="image" href="<?php echo 'product.php?p=' . $result->id ?>">
                            <img src="<?= ROOT .  escape($result->thumbnail); ?>" alt="Foto van <?= escape($result->title); ?>">
                        </a>
                        <div class="content">
                            <a class="header" href="<?php echo 'product.php?p=' . escape($result->id) ?>"><?php echo escape($result->title); ?></a>
                            <div class="description"><?php echo escape(Modifiers::textlength($result->description, 100)); ?></div>
                            <em data-countdown="<?= $result->durationenddate ?> <?= $result->durationendtime ?>"></em>
                            <div class="description bold">€<?php echo escape($result->price); ?></div>
                        </div>
                    </div>
                </div>
                <?php }
                } ?>
            </div>
        </div>
        <br>
        <form class="ui large form text-center" action="" method="post">
            <?php if(isset($_GET['offset'])) {
                if($_GET['offset'] > 0) {
                    ?>
                    <button type="submit" class="ui left labeled icon button primary" name="submit-search-down">
                        <i class="left arrow icon"></i>
                        Vorige pagina
                    </button>
                    <?php
                }
            }

            if($countSearch->count() >= $offset && $countSearch->count() - $offset >= 20) {
                ?>
                <button type="submit" class="ui right labeled icon button primary" name="submit-search-up">
                    <i class="right arrow icon"></i>
                    Volgende pagina
                </button>
                <?php
            }
            ?>
        </form>
    </div>
</main>

<?php include INCLUDES . 'footer.inc.php'; ?>
<?php include INCLUDES . 'foot.inc.php'; ?>
