<?php include_once 'modals/login.inc.php' ?>
<?php include_once 'modals/register.inc.php' ?>

<nav class="white">
    <div class="ui secondary menu">
        <div class="ui four column grid container">

            <div class="two wide tablet mobile only column mobile-button">
                <a id="mobile_item" class="item"><i class="bars icon white"></i></a>
            </div>

            <div class="three wide tablet phone three wide computer logo">
                <a href="index.php"><h1>EenmaalAndermaal</h1></a>
            </div>

            <div class="item six wide column">
                <?php include_once 'navigation/search.inc.php'; ?>
            </div>

            <div class="computer only item five wide column right aligned nopadding">
                <?php include_once 'navigation/account.inc.php'; ?>
            </div>
        </div>
    </div>

    <div class="computer only ui secondary menu categories">
        <div class="ui container">
            <a class="ui dropdown link item dropdown-hover">
                <span class="text bold">Categorieën</span>
                <i class="dropdown icon"></i>
            </a>

            <div class="ui fluid popup bottom middle transition hidden">
                <div class="ui four column divided center aligned grid">
                    <div class="column">
                        
                    </div>

                    <div class="column">

                    </div>

                    <div class="column">

                    </div>

                    <div class="column">

                    </div>
                </div>
            </div>

            <div class="ui item link">Voor Jou</div>
            <div class="ui item link">Dichtbij</div>
            <div class="ui item link">Nieuw</div>
        </div>
    </div>
</nav>

