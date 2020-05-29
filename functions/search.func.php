<?php

//======================================================================
// SEARCH SUBMIT
//======================================================================

// Is submit pressed
if (isset($_POST['search-submit'])) {

    // Save data in temporary variables
    // Replace spaces with +
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

    $data = '';
    $data .= '?search=' . $search;

    if(isset($_GET['offset'])) {
        if(!empty($_GET['offset'])) {
            $offset = $_GET['offset'];
        } else {
            $offset = 0;
        }
    } else {
        $offset = 0;
    }

    if(isset($_POST['submit-search-down'])) {
        $data .= '&offset='. $offset -= 10;

        Redirect::to('searchresults.php' . $data);
    }

    if(isset($_POST['submit-search-up'])) {
        $data .= '&offset=' . $offset += 10;

        Redirect::to('searchresults.php' . $data);
    }

    // Explode query and loop through each request
    $condition = '';
    $query = explode(" ", $search);
    foreach($query as $text) {
        $condition .= "title LIKE '%$text%' OR description LIKE '%$text%' OR ";
    }

    $condition = substr($condition, 0,-4);

    if(isset($_GET['offset'])) {
        $offset = $_GET['offset'];
    } else {
        $offset = 0;
    }

    $stmt = Database::getInstance()->query("SELECT * FROM Items WHERE $condition ORDER BY TITLE OFFSET $offset ROWS FETCH NEXT 20 ROWS ONLY",array());
    $countSearch = Database::getInstance()->query("SELECT id FROM Items WHERE $condition");
}