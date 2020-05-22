<?php
include FUNCTIONS . 'search.func.php';
?>

<form id="search" method="post" action="">
    <div class="ui search fluid">
        <div class="ui icon input">
                <input class="prompt" autocomplete="off" type="text" placeholder="Zoeken..." name="query">
                <i class="search icon"></i>
                <input  class="hidden-element" type="submit" name="search-submit">
        </div>

        <div class="results">
            <!-- Search results -->
        </div>
    </div>
</form>
