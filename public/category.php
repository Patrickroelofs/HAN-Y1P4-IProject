<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
    include INCLUDES . 'head.inc.php';

    $category = $_GET['cat'];

    if(!is_numeric($category)) {
        Redirect::to('index.php');
    }
    $subcategories = Database::getInstance()->query("SELECT * FROM Rubriek WHERE rubriek = $category", array());
?>

<main>
    <div class="ui container">
        <div class="ui stackable two column grid">

            <div class="three wide column">
                <h3>Categorieën</h3>
                <?php
                    if($subcategories->count() > 0) {
                ?>
                <div class="cat-list">
                    <?php

                    foreach($subcategories->results() as $subcategory) {
                        echo "<a href='category.php?cat=$subcategory->rubrieknummer'>" . $subcategory->rubrieknaam . '</a>';
                    }

                    ?>
                </div>
                <input type="checkbox" name="toggle" id="cat-toggle" class="category-toggle">
                <label for="cat-toggle"></label>
                <?php } ?>
            </div>

            <div class="thirteen wide column">
                <div class="ui stackable five column grid">
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
    </div>
</main>

<?php include INCLUDES . 'footer.inc.php'; ?>
<?php include INCLUDES . 'foot.inc.php'; ?>