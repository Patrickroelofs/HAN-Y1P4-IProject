<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
    include INCLUDES . 'head.inc.php';
?>

<main>
    <?php
        $stmt = Database::getInstance()->query("SELECT * FROM Rubriek WHERE rubriek = -1", array());

        foreach($stmt->results() as $result) {
            echo $result->rubrieknaam;
            echo '<br>';
        }
    ?>
</main>

<?php include INCLUDES . 'footer.inc.php'; ?>
<?php include INCLUDES . 'foot.inc.php'; ?>