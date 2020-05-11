<?php
if (isset($_POST['versturen'])) {
    $query = $_POST['email'];

    $stmt = Database::getInstance()->query("SELECT emailadres FROM Gebruiker WHERE emailadres = '$query'", array());
    if ($stmt->count() == 0) {
        echo "<p>Voer een geldig emailadres in.</p>";
    } else {
        foreach ($stmt->results() as $result) {
            $to = $result->emailadres;
        }
    }
}
?>