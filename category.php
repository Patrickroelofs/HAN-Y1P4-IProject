<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
    include INCLUDES . 'head.inc.php';

    $selectedCategory = $_GET['cat'];

    if(empty($_GET['cat'])) {
        Redirect::to("index.php");
    }

    $data = '';
    $data .= '?cat=' . $selectedCategory;
    $offset = 0;

    // if there is an offset set set it, otherwise its 0
    if(isset($_GET['offset'])) {
        if(!empty($_GET['offset'])) {
            $offset = $_GET['offset'];
        } else {
            $offset = 0;
        }
    } else {
        $offset = 0;
    }

    //if the offset is pressed as UP add 20
    if(isset($_POST['submit-offset-up'])) {
        $data .= '&offset=' . $offset += 20;
        $data .= '&min=' . escape($_GET['min']);
        $data .= '&max=' . escape($_GET['max']);

        Redirect::to('category.php' . $data);

        //if the offset is pressed as DOWN remove 20
    } else if (isset($_POST['submit-offset-down'])) {
        $data .= '&offset=' . $offset -= 20;
        $data .= '&min=' . escape($_GET['min']);
        $data .= '&max=' . escape($_GET['max']);

        Redirect::to('category.php' . $data);
    }

    //if the price changer is set
    if(isset($_POST['submit-price'])) {
        $data .= '&min=' . escape($_POST['min-price']);
        $data .= '&max=' . escape($_POST['max-price']);
        $data .= '&offset=' . 0;

        Redirect::to('category.php' . $data);
    }



    //get all products based on above requirements
    if(isset($_GET['min']) && isset($_GET['max'])) {
        if(empty($_GET['min']) && empty($_GET['max'])) {
            $allProducts = Database::getInstance()->query("SELECT * FROM Items WHERE category='" . escape($selectedCategory) . "' AND NOT hidden = 'true' AND NOT closed = 'true' ORDER BY title OFFSET $offset ROWS FETCH NEXT 20 ROWS ONLY");
            $countProducts = Database::getInstance()->query("SELECT id FROM Items WHERE category='" . escape($selectedCategory) . "' AND NOT hidden = 'true' AND NOT closed = 'true'");
        } else {
            $allProducts = Database::getInstance()->query("SELECT * FROM Items WHERE category='" . escape($selectedCategory) . "' AND price BETWEEN '". escape($_GET['min']) ."' AND '". escape($_GET['max']) ."' AND NOT hidden = 'true' AND NOT closed = 'true' ORDER BY title OFFSET $offset ROWS FETCH NEXT 20 ROWS ONLY");
            $countProducts = Database::getInstance()->query("SELECT id FROM Items WHERE category='" . escape($selectedCategory) . "' AND price BETWEEN '". escape($_GET['min']) ."' AND '". escape($_GET['max']) ."' AND NOT hidden = 'true' AND NOT closed = 'true' ");
        }
    } else {
        $allProducts = Database::getInstance()->query("SELECT * FROM Items WHERE category='" . escape($selectedCategory) . "' AND NOT hidden = 'true' AND NOT closed = 'true' ORDER BY title OFFSET $offset ROWS FETCH NEXT 20 ROWS ONLY");
        $countProducts = Database::getInstance()->query("SELECT id FROM Items WHERE category='" . escape($selectedCategory) . "' AND NOT hidden = 'true' AND NOT closed = 'true'");
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

                    <?php if ($allProducts->count() <= 0) {
                        echo 'Geen resultaten gevonden...';
                    }
                    ?>

                    <?php
                        foreach ($allProducts->results() as $product) {
                            ?>

                            <div class="column">
                                <div class="ui fluid card">
                                    <a class="image" href="product.php?p=<?= $product->id; ?>">
                                        <img src="<?= ROOT . $product->thumbnail; ?>" alt="Foto van <?= escape($product->title); ?>">
                                    </a>
                                    <div class="content">
                                        <a class="header" href="product.php?p=<?= $product->id; ?>"><?= escape($product->title); ?></a>
                                        <div class="description"><?= escape(Modifiers::textlength($product->description, 100)); ?>...</div>
                                        <div class="description bold"><?= "€".escape($product->price); ?></div>
                                    </div>
                                </div>
                            </div>

                            <?php
                        }
                    ?>

                </div>
            </div>
            <div class="paginator">
                <form class="ui large form" action="" method="post">
                    <?php

                    if(isset($_GET['offset'])) {
                        if($_GET['offset'] > 0) {
                            ?>
                            <button type="submit" class="ui left labeled icon button primary" name="submit-offset-down">
                                <i class="left arrow icon"></i>
                                Vorige pagina
                            </button>
                            <?php
                        }
                    }
                    ?>

                    <?php

                    if($countProducts->count() >= $offset && $countProducts->count() - $offset >= 20) {
                        ?>
                        <button type="submit" class="ui right labeled icon button primary" name="submit-offset-up">
                            <i class="right arrow icon"></i>
                            Volgende pagina
                        </button>
                        <?php
                    }
                    ?>
                </form>
            </div>
        </div>
    </div>
</main>

<?php include INCLUDES . 'footer.inc.php'; ?>
<?php include INCLUDES . 'foot.inc.php'; ?>