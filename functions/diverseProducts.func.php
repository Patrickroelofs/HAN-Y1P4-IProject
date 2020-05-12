<?php
// Check databse if it contains results
// TODO: Top 3 gives error, but works on site. Might need to fix this so that the code doesn't give any error.
$stmt = Database::getInstance()->query("SELECT TOP 10 * FROM Voorwerp");

if ($stmt->count() < 1) {
    // no data passed by get
    echo "<p>Geen resultaten</p>";
}