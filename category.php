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
                $category = Database::getInstance()->get('Categories', array('id', '=', $selectedCategory));
                echo $category->first()->name;
            ?>
        </h2>
        <div class="ui stackable two column grid">


            <div class="three wide column">
                <h3>Categorieën</h3>
                <?php
                    //Get all subcategories
                    $categories = Database::getInstance()->get('Categories', array('within', '=', $selectedCategory));
                    // Load all subcategories that this category has
                    if($categories->count() > 0) {
                ?>
                <div class="cat-list">
                    <?php

                    foreach($categories->results() as $subcategory) {
                        echo "<a href='category.php?cat=$subcategory->id'>" . $subcategory->name . '</a>';
                    }

                    ?>
                </div>
                <input type="checkbox" name="toggle" id="cat-toggle" class="category-toggle">
                <label for="cat-toggle"></label>
                <?php } ?>

                <h3>Adjust your price range:</h3>

                <div class="ui labeled ticked range slider" id="slider-range"></div>
                <div class="ui input">
                    <input type="text" id="range-slider-input-1" disabled="">
                    <label for="range-slider-input-1"></label>
                </div>
            </div>



            <div class="thirteen wide column">
                <div class="ui stackable five column grid">
                    <?php
                    $cat = $_GET['cat'];
                    $product = Database::getInstance()->query("SELECT * FROM Items where category='$cat'");

                    foreach($product->results() as $result) { ?>
                    <div class="column">
                        <div class="ui fluid card">
                            <a class="image" href="product.php?p=<?= $result->id; ?>">
                                <img src="<?= ROOT . $result->thumbnail; ?>" alt="Foto van <?= $result->title; ?>">
                            </a>
                            <div class="content">
                                <a class="header" href="product.php?p=<?= $result->id; ?>"><?= $result->title; ?></a>
                                <div class="description"><?= "€".$result->price; ?></div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include INCLUDES . 'footer.inc.php'; ?>
    <script type="javascript">
        $('.ui.slider')
            .slider({
                min: 0,
                max: 100,
                start: 0,
                step: 50
            })
        ;
    </script>
<?php include INCLUDES . 'foot.inc.php'; ?>