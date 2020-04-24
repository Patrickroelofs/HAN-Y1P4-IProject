<?php
require_once ('verbinddatabase.php');

if (isset($_POST['zoeken'])) {
    try {
        $tekst = $_POST['zoektekst'];
        $sql = "SELECT * FROM Voorwerp WHERE titel LIKE '%$tekst%' ORDER BY voorwerpnummer";
        $blogs = $e->prepare($sql);
        $blogs->execute();
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }

}

?>
<main>
    <div class="zoekbalk">
        <form method="post" action="zoekbalk.php">
            <input type="text" placeholder="Zoeken..." name="zoektekst" id="zoektekst">
            <input type="submit" name="zoeken" id="zoeken" value="Zoeken">
        </form>
    </div>
    <?php foreach ($blogs as $blog) { ?>
        <article>
            <h2><?= $blog['titel'] ?></h2>
            <?php
            $blogTekst = $blog['beschrijving'];
            ?>
            <p><?= $blogTekst ?></p>
        </article>
    <?php } ?>
</main>
<?php
if ($blogs) {
    echo 1;
    if ($blogs->rowCount()>0) {
        echo 2;
    }
}
?>