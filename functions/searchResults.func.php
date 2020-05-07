<?php
//======================================================================
// SEARCH RESULTS
//======================================================================

// Is search filled in
if (isset($_GET['search'])) {
    $query = $_GET['search'];

    // Check database if it contains $query
    $stmt = Database::getInstance()->query("SELECT * FROM Voorwerp WHERE titel LIKE '%$query%' OR beschrijving LIKE '%$query%'",array());

    if ($stmt->count() < 1) {
        // no data passed by get
        echo "<p>Geen resultaten</p>";
    }
}