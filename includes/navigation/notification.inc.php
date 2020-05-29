<?php
// Check if the user is logged in
if (Session::exists('username')) {
    // Get notifications from db
    $notifications = Database::getInstance()->query("SELECT * FROM Notifications WHERE username = '". escape(Session::get('username')) . "' ORDER BY date, time DESC");
    include INCLUDES . 'modals/showNotifications.inc.php';

    // Check if there are any notifications
    if ($notifications->count() > 0) { ?>
        <div class="vertical-margin-12">
            <button class="ui icon circular primary button notification" type="submit" id="showNotifications">
                <i class="bell icon"></i>
            </button>
        </div>
        <?php // Delete messages
        if (isset($_POST['notification-submit'])) {
            for ($i = 0; $i < $notifications->count(); $i++) {
                if (isset($_POST["delete-$i"])) {
                    $deleteNotifications = Database::getInstance()->query("DELETE FROM Notifications WHERE username = '". escape(Session::get('username')) . "' AND date = '".$notifications->id($i)->date."' AND time = '".$notifications->id($i)->time."'");

                    Redirect::refresh();
                }
            }
        }

    } else { ?>
        <div class="vertical-margin-12">
            <button class="ui icon circular primary button notification" type="submit" id="showNotifications">
                <i class="bell outline icon"></i>
            </button>
        </div>
    <?php }
}