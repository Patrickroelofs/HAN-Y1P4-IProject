<?php include_once 'modals/login.inc.php' ?>
<?php include_once 'modals/register.inc.php' ?>

<nav class="white">
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
            <div class="ui dropdown link item dropdown-hover hidden">
                <span class="text bold">Categorieën</span>
                <i class="dropdown icon"></i>
            </div>

            <div class="ui fluid popup bottom middle transition hidden">
                <div class="ui four column center aligned grid">
                    <div class="column">
                        <div class="four wide column">
                            <a class="text-left link item" href="categories.php">Bekijk alle Categorieën</a>
                            <div class="ui fluid vertical tabular menu text-left">
                                <a class="active item" data-tab="1">Computer en Electronica</a>
                                <a class="item" data-tab="2">Tab 2</a>
                                <a class="item" data-tab="3">Tab 3</a>
                            </div>
                        </div>
                    </div>

                    <div class="stretched twelve wide column">
                        <div class="ui bottom attached active tab" data-tab="1">
                            <div class="ui four column grid text-left">
                                <div class="column">
                                    <h4 class="header">Computer</h4>
                                </div>
                                <div class="column">
                                    <h4 class="header">Tablets & Telefonie</h4>
                                </div>
                                <div class="column">
                                    <h4 class="header">Televisie</h4>
                                </div>
                                <div class="column">
                                    <h4 class="header">Audio & Hifi</h4>
                                </div>
                            </div>
                        </div>

                        <div class="ui bottom attached tab" data-tab="2">

                        </div>

                        <div class="ui bottom attached tab" data-tab="3">

                        </div>
                    </div>
                </div>
            </div>

            <div class="ui item link">Voor Jou</div>
            <div class="ui item link">Dichtbij</div>
            <div class="ui item link">Nieuw</div>
        </div>
    </div>
</nav>

