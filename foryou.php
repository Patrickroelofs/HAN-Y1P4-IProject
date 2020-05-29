<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
    include INCLUDES . 'head.inc.php';

    if(!Session::exists('username')){
        Redirect::to('index.php');
    }

    ?>

<main>
    <div class="ui container">
        <?php if($user->first()->trader) { ?>
        <h2 id="yourSoldAuctions">Gesloten advertenties</h2><br>
        <div class="ui stackable five column grid">
            <?php
            $usertraderProducts = Database::getInstance()->query("SELECT * FROM Items WHERE trader = '". Session::get('username') . "' ORDER BY durationbegindate, durationbegintime DESC", array());

            foreach($usertraderProducts->results() as $result) {
                if($result->closed) {
                    ?>

                    <div class="column">
                        <div class="ui fluid card">
                            <a class="image" href="product.php?p=<?= $result->id; ?>">
                                <img src="<?= ROOT . $result->thumbnail; ?>" alt="Foto van <?= $result->title; ?>">
                            </a>
                            <div class="content">
                                <a class="header" href="product.php?p=<?= $result->id; ?>"><?= $result->title; ?></a>
                                <div class="description">Verkocht voor <span class="bold">€ <?= $result->saleprice ?></span></div>
                            </div>
                        </div>
                    </div>

                    <?php
                }
            }

            if ($usertraderProducts->count() <= 0) {
                echo '<p>Geen gesloten advertenties gevonden...</p>';
            }
            ?>
        </div>
        <?php } ?>

        <?php if (!$user->first()->trader) {
            $userbuyerProducts = Database::getInstance()->query("SELECT * FROM Items WHERE buyer = '". Session::get('username') . "' ORDER BY durationenddate, durationendtime DESC", array());
            ?>

            <h2 id="boughtAuctions">Gekochte advertenties</h2><br>
            <div class="ui stackable five column grid">
                <?php foreach($userbuyerProducts->results() as $result) {
                    if($result->closed) {
                        ?>

                        <div class="column">
                            <div class="ui fluid card">
                                <a class="image" href="product.php?p=<?= $result->id; ?>">
                                    <img src="<?= ROOT . $result->thumbnail; ?>" alt="Foto van <?= $result->title; ?>">
                                </a>
                                <div class="content">
                                    <a class="header" href="product.php?p=<?= $result->id; ?>"><?= $result->title; ?></a>
                                    <div class="description">Verkocht voor <span class="bold">€ <?= $result->saleprice ?></span></div>
                                </div>
                            </div>
                        </div>

                        <?php
                    }
                }

                if ($userbuyerProducts->count() <= 0) {
                    echo '<p>Geen gekochte producten gevonden...</p>';
                }
                ?>
            </div>

        <?php
        }
        ?>

        <?php if($user->first()->trader && !$usertraderProducts->count() <= 0) { ?>
        <h2 id="yourAuctions">Lopende advertenties</h2>
        <div class="ui stackable five column grid">
            <div class="five column row">
                <?php foreach ($usertraderProducts->results() as $result) {
                    // Calculate time left in offer
                    $currentDate = new DateTime(date("Y-m-d"));
                    $endDate = new DateTime($result->durationenddate);
                    if ($endDate > $currentDate) {
                        $timeLeft = $currentDate->diff($endDate)->format("%d");
                    } else {
                        $timeLeft = 0;
                    }

                    if(!$result->closed) {
                    ?>
                    <div class="column">
                        <div class="ui fluid card">
                            <a class="image" href="product.php?p=<?= $result->id; ?>">
                                <img src="<?= ROOT . $result->thumbnail; ?>" alt="Foto van <?= $result->title; ?>">
                            </a>
                            <div class="content">
                                <a class="header" href="product.php?p=<?= $result->id; ?>"><?= $result->title; ?></a>
                                <div class="description">Tijd tot verkoop: <?= $timeLeft ?> dagen</div>
                                <div class="description">Vanaf <span class="bold">€ <?= $result->price ?></span></div>
                            </div>
                        </div>
                    </div>
                <?php } else { echo '<div class="column"><p>Geen lopende advertenties...</p></div>'; }
                } ?>
            </div>
        </div>
    <?php } ?>
    </div>
</main>

<?php include INCLUDES . 'footer.inc.php'; ?>
<?php include INCLUDES . 'foot.inc.php'; ?>