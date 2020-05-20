<div class="adminbar">
    <div class="ui container">
        <div class="ui two column grid">
            <div class="column left aligned">
                <div class="admintitle">
                    <em>Administrator ingelogd:</em>
                    <strong>
                        <?php
                        if(empty($user->first()->firstname) || empty($user->first()->lastname)) {
                            echo escape($user->first()->username);
                        } else {
                            echo escape($user->first()->firstname) . ' ' . escape($user->first()->lastname);
                        }
                        ?>
                    </strong>
                </div>
            </div>

            <div class="column right aligned">
                <a target="_blank" href="admin/index.php" class="ui inverted button">Admin Paneel</a>
            </div>
        </div>
    </div>
</div>