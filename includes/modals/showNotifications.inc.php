<?php if ($notifications->count() >= 1) { ?>
    <div class="ui modal showNotifications">
        <i class="close icon"></i>
        <div class="header">
            Notificaties
        </div>
        <div class="content">
            <form method="post" id="notification-form">
                <div class="ui grid">
                    <div class="seven wide column bold">Bericht</div>
                    <div class="three wide column bold">Datum</div>
                    <div class="three wide column bold">Tijd</div>
                    <div class="three wide column bold">Verwijder</div>

                    <?php // show notifications one by one
                    for ($i = 0; $i < $notifications->count(); $i++) { ?>
                        <div class="seven wide column"><?= $notifications->id($i)->message ?></div>
                        <div class="three wide column"><?= $notifications->id($i)->date ?></div>
                        <div class="three wide column"><?= substr($notifications->id($i)->time, 0,5) ?></div>
                        <div class="three wide column">
                            <div class="ui fitted checkbox">
                                <input type="checkbox" name="delete-<?= $i ?>">
                                <label></label>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </form>
        </div>
        <div class="actions">
            <div class="ui input labeled input">
                <button type="submit" form="notification-form" name="notification-submit" class="ui primary labeled icon button">
                    <i class="checkmark icon"></i>
                    Okay
                </button>
            </div>
        </div>
    </div>
<?php } else { ?>
    <div class="ui mini modal showNotifications">
        <div class="ui header">
            Geen notificaties
        </div>
        <div class="content">
            U heeft geen notificaties
        </div>
        <div class="actions">
            <div class="ui green ok inverted button">
                <i class='checkmark icon'></i>
                Okay
            </div>
        </div>
    </div>
<?php } ?>