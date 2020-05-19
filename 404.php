<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
include INCLUDES . 'head.inc.php';
?>

<main>
    <div class="ui container">
        <div class="grid">
            <div class="column">
                <h1>404 pagina niet gevonden</h1>
                <p>Sorry, deze pagina is niet gevonden.</p>
                <p>U kan de volgende dingen proberen om naar de goede pagina te gaan:</p>
                <ul>
                    <li>Controleer of alles goed geschreven is in de URL</li>
                    <li>Ga terug naar de vorige pagina</li>
                    <li>Zoek uw item in de sites zoekbalk</li>
                    <li>Ga terug naar de <a href="index.php">homepagina</a></li>
                </ul>
            </div>
        </div>
    </div>
</main>

<?php include INCLUDES . 'footer.inc.php'; ?>
<?php include INCLUDES . 'foot.inc.php'; ?>
