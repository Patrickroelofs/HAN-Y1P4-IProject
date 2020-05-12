<?php
// Get random products from the database
// TODO: Top 3 gives error, but works on site. Might need to fix this so that the code doesn't give any error.
// TODO: NEWID() gives an error, but works on the site how it is supposed to. Might need to fix this so that the code doesn't give any error.
$randomProducts = Database::getInstance()->query("SELECT TOP 10 * FROM Voorwerp ORDER BY NEWID()");

if ($randomProducts->count() < 1) {
    // no data passed by get
    echo "<p>Geen resultaten</p>";
}