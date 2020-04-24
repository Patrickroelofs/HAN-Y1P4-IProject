<nav class="white">
    <div class="ui secondary menu">
        <div class="ui three column grid container">

            <div class="two wide tablet mobile only column mobile-button">
                <a id="mobile_item" class="item"><i class="bars icon white"></i></a>
            </div>

            <div class="three wide tablet phone three wide computer logo">
                <a href="index.php"><h1>EenmaalAndermaal</h1></a>
            </div>

            <div class="computer tablet only item seven wide column">
                <?php include_once 'navigation/search.inc.php'; ?>
            </div>

            <div class="computer only item five wide column right aligned nopadding">
                <?php include_once 'navigation/account.inc.php'; ?>
            </div>
        </div>
    </div>

    <div class="computer only ui secondary menu categories">
        <div class="ui container">
            <div class="ui dropdown link item">
                <span class="text bold">Categorieën</span>
                <i class="dropdown icon"></i>
                <div class="menu">
                    <div class="item">
                        <i class="dropdown icon"></i>
                        <span class="text">Clothing</span>
                        <div class="menu">
                            <div class="header">Mens</div>
                            <div class="item">Shirts</div>
                            <div class="item">Pants</div>
                            <div class="item">Jeans</div>
                            <div class="item">Shoes</div>
                            <div class="divider"></div>
                            <div class="header">Womens</div>
                            <div class="item">Dresses</div>
                            <div class="item">Shoes</div>
                            <div class="item">Bags</div>
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

