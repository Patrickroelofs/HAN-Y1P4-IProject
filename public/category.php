<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
    include INCLUDES . 'head.inc.php';

    $selectedCategory = $_GET['cat'];

    if(!is_numeric($selectedCategory) || $selectedCategory < 0) {
        Redirect::to('index.php');
    }



?>

<main>
    <div class="ui container">
        <h2>
            <?php
                $category = Database::getInstance()->get('Rubriek', array('rubrieknummer', '=', $selectedCategory));
                echo $category->first()->rubrieknaam;
            ?>
        </h2>
        <div class="ui stackable two column grid">


            <div class="three wide column">
                <h3>Categorieën</h3>
                <?php
                    //Get all subcategories
                    $categories = Database::getInstance()->get('Rubriek', array('Rubriek', '=', $selectedCategory));
                    // Load all subcategories that this category has
                    if($categories->count() > 0) {
                ?>
                <div class="cat-list">
                    <?php

                    foreach($categories->results() as $subcategory) {
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