<?php


class Product
{

    //Functions to create rows of products. A row will exit out of 5 products and if there are more product they automatically will correctly move to the next row
    //As parameter a sql query statement is needed which pulls information out of the 'Voorwerp" table
    public static function createRows ($stmt) { ?>
        <?php foreach($stmt->results() as $result) { ?>
            <div class="column">
                <div class="ui fluid card">
                    <a class="image" href="product.php?p=<?= $result->voorwerpnummer ?>">
                        <img src="<?= $result->voorwerpAfbeelding?>" alt="Product image">
                    </a>
                    <div class="content">
                        <a class="header" href="product.php?p=<?= $result->voorwerpnummer ?>"><?= $result->titel; ?></a>
                        <div class="description"><?= $result->beschrijving; ?></div>
                        <div class="description bold">€<?= $result->startprijs; ?></div>
                    </div>
                </div>
            </div>
        <?php } ?>
    <?php }
}