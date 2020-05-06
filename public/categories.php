<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
    include INCLUDES . 'head.inc.php';
?>

<main>
    <div class="ui container">
        <h2>Alle Categorieën</h2>

        <div class="ui stackable four column grid categories-list">
            <?php
            $categories = Database::getInstance()->query("SELECT * FROM Rubriek WHERE rubriek = -1", array());
            foreach($categories->results() as $category) {
              ?>
                <div class="column">
                    <?php
                  echo "<a href='category.php?cat=$category->rubrieknummer'>" . $category->rubrieknaam . '</a>';

                  $subcategories = Database::getInstance()->query("SELECT * FROM Rubriek WHERE rubriek = $category->rubrieknummer", array());
                  foreach($subcategories->results() as $subcategory) {
                      echo "<a href='category.php?cat=$subcategory->rubrieknummer'>" . $subcategory->rubrieknaam . '</a>';
                  }
                  ?>
                </div>
            <?php } ?>
        </div>
    </div>
</main>

<?php include INCLUDES . 'footer.inc.php'; ?>
<?php include INCLUDES . 'foot.inc.php'; ?>