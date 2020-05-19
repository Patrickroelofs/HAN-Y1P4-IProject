<footer>
    <section class="primary background">
        <div class="ui container selling-point">
            <div class="centered aligned ui five column grid">
                <div class="row">
                    <div class="centered aligned column sixteen wide mobile tablet three wide computer">
                        <div class="vertical-margin-12">
                            <i class="ui huge award icon"></i>
                            <p class="bold">Veiligheid</p>
                            <p>De veiligheid van gebruikers is van groot belang bij ons.</p>
                        </div>
                    </div>
                    <div class="centered aligned column sixteen wide mobile tablet three wide computer">
                        <div class="vertical-margin-12">
                            <i class="ui huge hands helping icon"></i>
                            <p class="bold">Professionele hulp</p>
                            <p>Bij het aanschaffen en veilen van producten!</p>
                        </div>
                    </div>
                    <div class="centered aligned column sixteen wide mobile tablet three wide computer">
                        <div class="vertical-margin-12">
                            <i class="ui huge truck icon"></i>
                            <p class="bold">Je bepaalt alles zelf</p>
                            <p>Je kan zelf kiezen hoe jouw producten op de site staan.</p>
                        </div>
                    </div>
                    <div class="centered aligned column sixteen wide mobile tablet three wide computer">
                        <div class="vertical-margin-12">
                            <i class="ui huge laugh outline icon"></i>
                            <p class="bold">Vrolijke klanten</p>
                            <p>Wij zorgen voor een onvergetelijke ervaring</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ui footer vertical-margin-24">
        <div class="ui container">
            <div class="ui stackable divided grid">
                <div class="three wide column">
                    <h4 class="ui header">Informatie</h4>
                    <div class="ui link list">
                        <a href="#" class="item">Over Ons</a>
                        <a href="#" class="item">Info en Hulp</a>
                    </div>
                </div>
                <div class="three wide column">
                    <h4 class="ui header">Koper</h4>
                    <div class="ui link list">
                        <a href="foryou.php" class="item">Voor Jou</a>
                        <a href="nearby.php" class="item">Dichtbij</a>
                    </div>
                </div>
                <div class="three wide column">
                    <h4 class="ui header">Verkoper</h4>
                    <div class="ui link list">
                        <a href="yourbids.php" class="item">Jouw Biedingen</a>
                        <a href="createauction.php" class="item">Advertentie Plaatsen</a>
                    </div>
                </div>
                <div class="seven wide column">
                    <h4 class="ui header">Jouw online Veilingsite.</h4>
                    <p>Je hoor het! U bevindt zich momenteel op de nieuwe veilingsite genaamd EenmaalAndermaal. Hier kunt u producten aanschaffen en ook zelf producten veilen.</p>
                    <p>Deze site is ontwikkeld door het bedrijf <a class="item" href="#">iConcepts</a></p>
                </div>
            </div>
            <div class="ui section divider"></div>
            <div class="ui container center aligned">
                <h2>Eenmaal Andermaal</h2>
                <div class="ui horizontal small divided link list center aligned">
                    <a class="item" href="#">Algemene voorwaarden</a>
                    <a class="item" href="#">Privacy</a>
                    <a class="item" href="#">Cookies</a>
                    <?php if (Session::exists('username')) {
                        echo '<a class="item" href="removeaccount.php">Verwijder Account</a>';
                    } ?>
                    <p class="vertical-margin-6">iConcepts (EenmaalAndermaal) is niet aansprakelijk voor (gevolg)schade die voortkomt uit het gebruik van deze site. <br>Copyright © 2020 EenmaalAndermaal B.V.</p>
                </div>
            </div>
        </div>
    </section>
</footer>