<?php

//======================================================================
// SEARCH SUBMIT
//======================================================================

// Is submit pressed
if (isset($_POST['search-submit'])) {

    // Save data in temporary variables
    $query = escape(str_replace(" ", "+", $_POST['query']));

    // Redirect to search results page
    Redirect::to('searchresults.php?search=' . $query);
}


//======================================================================
// SEARCH RESULTS
//======================================================================

// Is search filled in
if (isset($_GET['search'])) {
    $search = escape($_GET['search']);

    // Check database if it contains $query
    $condition = '';
    $query = explode(" ", $search);
    foreach($query as $text) {
        $condition .= "title LIKE '%$text%' OR description LIKE '%$text%' OR ";
    }

    $condition = substr($condition, 0,-4);

    $stmt = Database::getInstance()->query("SELECT * FROM Items WHERE $condition",array());

    if ($stmt->count() < 1) {
        // no data passed by get
        echo "<p>Geen resultaten</p>";
    }
}