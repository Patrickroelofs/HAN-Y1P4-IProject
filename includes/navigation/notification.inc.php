<?php
if(Session::exists('username')) {?>
    <div class="vertical-margin-12">
        <button class="ui icon top left pointing circular white dropdown button">
            <?php
            $notifications = Database::getInstance()->query("SELECT * FROM Notifications WHERE username = '". escape(Session::get('username')) . "' ORDER BY date, time DESC");
            if($notifications->count() < 1) {
                ?>
                <i class="bell outline icon"></i>
            <?php } else {?>
                <i class="bell icon"></i>
            <?php } ?>
            <div class="menu">
                <div class="header">Notificaties</div>
                <?php
                if($notifications->count() < 1) { // check notifications
                    echo"<div class='item'>U heeft geen meldingen</div>";
                } else {
                    foreach($notifications->results() as $notification) {
                        ?>
                        <div class="item"><?php echo escape($notification->message);?></div>
                    <?php }
                } ?>
            </div>
        </button>
    </div>
<?php } ?>
