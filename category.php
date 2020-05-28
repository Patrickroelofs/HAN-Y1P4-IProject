<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
    include INCLUDES . 'head.inc.php';

    $selectedCategory = $_GET['cat'];

    if(empty($_GET['cat'])) {
        Redirect::to("index.php");
    }
?>

<main>
    <div class="ui container">
        <h2>
            <?php
                $category = Database::getInstance()->get('Categories', array('id', '=', $selectedCategory));
                echo escape($category->first()->name);
            ?>
        </h2>
        <div class="ui stackable two column grid">


            <div class="three wide column">
                <?php
                    //Get all subcategories
                    $categories = Database::getInstance()->get('Categories', array('within', '=', $selectedCategory));
                    // Load all subcategories that this category has
                    if($categories->count() > 0) {
                ?>
                <h3>Categorieën</h3>
                <div class="cat-list">
                    <?php

                    foreach($categories->results() as $subcategory) {
                        echo "<a href='category.php?cat=$subcategory->id'>" . escape($subcategory->name) . '</a>';
                    }

                    ?>
                </div>
                <input type="checkbox" name="toggle" id="cat-toggle" class="category-toggle">
                <label for="cat-toggle"></label>
                <?php } ?>

                <form class="ui form changeprice" method="post">
                    <h3>Prijs aanpassen:</h3>
                    <div class="field">
                        <label for="min-price">Minimum</label>
                        <input type="number" step="0.1" name="min-price" placeholder="Minimum" required>
                    </div>
                    <div class="field">
                        <label for="max-price">Maximum</label>
                        <input type="number" step="0.1" name="max-price" placeholder="Maximum" required>
                    </div>
                    <button class="ui button" type="submit" name="submit-price">Pas aan</button>
                </form>
            </div>




            <div class="thirteen wide column">
                <div class="ui stackable four column grid">
                    <?php
                    // Post to get the min and max price submitted
                    // Check if a min and max price is submitted
                    if (isset($_POST['submit-price'])) {
                        $min = escape($_POST['min-price']);
                        $max = escape($_POST['max-price']);
                        Redirect::to('category.php?cat='.$selectedCategory.'&min-price='.$min.'&max-price='.$max);
                    }

                    // Check if there is a category. If that is the case get all products from that category out of the database
                    if (isset($_GET['cat']) && !isset($_GET['min-price']) && !isset($_GET['max-price'])) {
                        if(isset($_GET['amount'])) {
                            $ammountOfProductsShown = escape($_GET['amount']);
                        } else {
                            $ammountOfProductsShown = 16;
                        }
                        $allProducts = Database::getInstance()->query("SELECT * FROM Items WHERE category='" . escape($selectedCategory) . "' AND NOT hidden = 'true' AND NOT closed = 'true'");
                        $product = Database::getInstance()->query("SELECT TOP $ammountOfProductsShown * FROM Items where category='". escape($selectedCategory) ."' AND NOT hidden = 'true' AND NOT closed = 'true'");
                        // If there are no products let the user know that there are no results found
                        if($product->count() <= 0) {
                            echo "Geen resultaten";
                        }
                    }
                    // Check if there is a category, minimum price and maximum price. If so get all products from that category within that price range out of the database
                    elseif (isset($_GET['cat']) && isset($_GET['min-price']) && isset($_GET['max-price'])) {
                        $product = Database::getInstance()->query("SELECT * FROM Items where category='". escape($selectedCategory) ."' AND price BETWEEN '". escape($_GET['min-price']) ."' AND '". escape($_GET['max-price']) ."' AND NOT hidden = 'true' AND NOT closed = 'true'");
                        // If there are no products let the user know that there are no results found
                        if($product->count() <= 0) {
                            echo "Geen resultaten";
                        }
                    }
                    // If there isn't a category entered the user will get redirected to index.php
                    else {
                        Message::error('index.php', array(
                                'm' => 'Categorie bestaat niet'
                        ));
                    }

                    foreach($product->results() as $result) { ?>
                        <div class="column">
                            <div class="ui fluid card">
                                <a class="image" href="product.php?p=<?= $result->id; ?>">
                                    <img src="<?= ROOT . $result->thumbnail; ?>" alt="Foto van <?= escape($result->title); ?>">
                                </a>
                                <div class="content">
                                    <a class="header" href="product.php?p=<?= $result->id; ?>"><?= escape($result->title); ?></a>
                                    <div class="description"><?= escape(Modifiers::textlength($result->description, 100)); ?>...</div>
                                    <div class="description bold"><?= "€".escape($result->price); ?></div>
                                </div>
                            </div>
                        </div>
                    <?php }

                    // load products form subcategories
                    foreach($categories->results() as $subcategory) {
                        $getsubItem = Database::getInstance()->query("SELECT * FROM Items WHERE category = $subcategory->id");

                        if ($getsubItem->count() > 0) { ?>
                            <div class="column">
                            <div class="ui fluid card">
                                <a class="image" href="product.php?p=<?= $result->id; ?>">
                                    <img src="<?= ROOT . $getsubItem->first()->thumbnail; ?>" alt="Foto van <?= escape($getsubItem->first()->title); ?>">
                                </a>
                                <div class="content">
                                    <a class="header" href="product.php?p=<?= $getsubItem->first()->id; ?>"><?= escape($getsubItem->first()->title); ?></a>
                                    <div class="description"><?= escape(Modifiers::textlength($getsubItem->first()->description, 100)); ?>...</div>
                                    <div class="description bold"><?= "€".escape($getsubItem->first()->price); ?></div>
                                </div>
                            </div>
                            </div>
                        <?php }
                    }

                    $steps = 16;
                    if($allProducts->count() >= $ammountOfProductsShown) { ?>
                        <div>
                            <a href="category.php?cat= <?=$selectedCategory?> &amount= <?=$ammountOfProductsShown + $steps?> ">Laad meer</a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include INCLUDES . 'footer.inc.php'; ?>
<?php include INCLUDES . 'foot.inc.php'; ?>