<?php
include FUNCTIONS . 'search.func.php';
?>

<form id="search" method="post" action="">
    <div class="ui search fluid">
        <div class="ui icon input">
                <input id="search" class="prompt" autocomplete="off" type="text" name="query" placeholder="Zoeken..." value="<?php if(isset($_GET['search'])) {echo escape($_GET['search']); } ?>">
                <i class="search icon"></i>
                <input class="hidden-element" type="submit" name="search-submit">
        </div>

        <div class="results">
            <!-- Search results -->
        </div>
    </div>
</form>
