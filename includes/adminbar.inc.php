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
        </div>
    </div>
</div>