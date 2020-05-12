<?php if(isset($_GET['error'])){ ?>

    <div class="ui container systemMessage">
        <div class="ui error message">
            <i class="exclamation triangle icon"></i>
            <?php
                if(isset($_GET['m'])) {
                    escape($_GET['m']);
                }
             ?>
        </div>
    </div>

<?php } else if (isset($_GET['warning'])) { ?>

    <div class="ui container systemMessage">
        <div class="ui warning message">
            <i class="exclamation icon"></i>
            <?php
            if(isset($_GET['m'])) {
                escape($_GET['m']);
            }
            ?>
        </div>
    </div>

<?php } else if (isset($_GET['notice'])) { ?>


    <div class="ui container systemMessage">
        <div class="ui notice message">
            <i class="exclamation icon"></i>
            <?php
            if(isset($_GET['m'])) {
                escape($_GET['m']);
            }
            ?>
        </div>
    </div>

<?php } else if (isset ($_GET['info'])) { ?>

    <div class="ui container systemMessage">
        <div class="ui info message">
            <i class="question icon"></i>
            <?php
            if(isset($_GET['m'])) {
                escape($_GET['m']);
            }
            ?>
        </div>
    </div>

<?php } ?>