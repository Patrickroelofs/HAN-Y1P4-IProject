<?php include_once MODALS . 'login.inc.php' ?>
<?php include_once MODALS . 'register.inc.php' ?>

<nav class="white primary background">
    <div class="ui secondary menu main-nav">
        <div class="ui four column grid container">

            <div class="two wide tablet mobile only column mobile-button">
                <a id="mobile_item" class="item"><i class="bars icon white"></i></a>
            </div>

            <div class="three wide tablet phone three wide computer logo">
                <a href="index.php"><h1>EenmaalAndermaal</h1></a>
            </div>

            <div class="seven wide computer tablet fourteen wide phone item column center aligned">
                <?php include_once 'navigation/search.inc.php'; ?>
            </div>

            <div class="computer or lower hidden item three wide column right aligned nopadding">
                <?php include_once 'navigation/account.inc.php'; ?>
            </div>
        </div>
    </div>

    <div class="ui secondary menu categories tablet or lower hidden">
        <div class="ui container">
            <div class="ui dropdown select link item dropdown-hover hidden">
                <span class="text bold">Categorieën</span>
                <i class="dropdown icon"></i>
            </div>

            <div class="ui fluid popup bottom middle transition hidden">
                <div class="ui four column center aligned grid">
                    <div class="column">
                        <div class="four wide column">
                            <a class="text-left link item" href="categories.php">Bekijk alle Categorieën</a>
                            <div class="ui fluid vertical tabular menu text-left">
                                <?php
                                // Get all ROOT rubrieken
                                $categories = Database::getInstance()->query("SELECT TOP 6 * FROM Categories WHERE within = -1", array());

                                // Echo each rubriek
                                foreach ($categories->results() as $result) {
                                    echo "<a class='item' data-tab='$result->id'>" . $result->name . "</a>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="stretched twelve wide column">
                        <?php foreach($categories->results() as $result) { ?>
                        <div class="ui bottom attached tab" data-tab="<?= $result->id ?>">
                            <div class="ui stackable three column grid categories-navbar-list">
                            <?php
                                //Get all rubrieken inside of the rubriek tab
                                $category = Database::getInstance()->query("SELECT * FROM Categories WHERE within = $result->id");
                                foreach($category->results() as $cat) {
                            ?>
                            <div class="column">
                                <a href="category.php?cat=<?= $cat->id ?>"><?= $cat->name; ?></a>
                            </div>
                            <?php } ?>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <?php if(Session::exists('username')) { ?>
                <a href="foryou.php" class="ui item link">Voor Jou</a>
                <a href="nearby.php" class="ui item link">Dichtbij</a>
            <?php } ?>

            <a href="new.php" class="ui item link">Nieuw</a>
        </div>
    </div>
</nav>
<?php include INCLUDES . 'systemMessage.inc.php'; ?>
