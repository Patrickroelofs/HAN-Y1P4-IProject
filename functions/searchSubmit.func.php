<?php
//======================================================================
// SEARCH SUBMIT
//======================================================================

// Is submit pressed
if (isset($_POST['search-submit'])) {

    // Save data in temporary variables
    $query = $_POST['query'];

    // Redirect to search results page
    Redirect::to('searchresults.php?search=' . $query);
}