<?php
//======================================================================
// SEARCH RESULTS
//======================================================================

// Is search filled in
if (isset($_GET['search'])) {
    $query = $_GET['search'];

    // Check database if it contains $query
    $stmt = Database::getInstance()->prepare("SELECT * FROM Gebruiker WHERE gebruikersnaam LIKE :query");
    $stmt->execute(array(
        ':query' => $query
    ));

    // Get results
    $results = $stmt->fetch(PDO::FETCH_OBJ);

    // TODO: Display results in cards
    print_r($results);
}