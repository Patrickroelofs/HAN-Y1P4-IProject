<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
include INCLUDES . 'head.inc.php';
?>

<main>
    <div class="ui container">
        <h2>Zoekresultaten</h2>
        <?php include FUNCTIONS . 'searchResults.func.php'; ?>
    </div>
</main>

<?php include INCLUDES . 'footer.inc.php'; ?>
<?php include INCLUDES . 'foot.inc.php'; ?>
