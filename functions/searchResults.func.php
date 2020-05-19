<?php
//======================================================================
// SEARCH RESULTS
//======================================================================

// Is search filled in
if (isset($_GET['search'])) {
    $query = escape($_GET['search']);

    // Check database if it contains $query
    $stmt = Database::getInstance()->query("SELECT * FROM Items WHERE title LIKE '%$query%' OR description LIKE '%$query%'",array());

    if ($stmt->count() < 1) {
        // no data passed by get
        echo "<p>Geen resultaten</p>";
    }
}