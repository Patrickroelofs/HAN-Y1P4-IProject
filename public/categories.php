<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
    include INCLUDES . 'head.inc.php';
?>

<main>
    <div class="ui container">
        <div class="ui container center aligned">
            <div class="ui three column grid centered stackable">
                <div class="column">
                    <div class="ui category search">
                        <div class="ui icon input fluid">
                            <input class="prompt" type="text" placeholder="Categorie zoeken...">
                            <i class="search icon"></i>
                        </div>
                        <div class="results"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="ui stackable four column grid">
            <?php
                $categories = Database::getInstance()->query("SELECT * FROM Rubriek WHERE rubriek = -1", array());
                foreach($categories->results() as $category) {
            ?>
            <div class="column">
                <?php
                    echo "<a href='category.php?cat=$category->rubrieknummer'>" . $category->rubrieknummer . ' ' . $category->rubrieknaam . '</a><br>';

                    $subcategories = Database::getInstance()->query("SELECT * FROM Rubriek WHERE rubriek = $category->rubrieknummer", array());
                    foreach($subcategories->results() as $subcategory) {
                        echo "<a href='category.php?cat=$subcategory->rubrieknummer'>" . $subcategory->rubrieknummer . ' ' . $subcategory->rubrieknaam . '</a><br>';
                    }
                ?>
            </div>
            <?php } ?>
        </div>
    </div>
</main>

<?php include INCLUDES . 'footer.inc.php'; ?>
<?php include INCLUDES . 'foot.inc.php'; ?>