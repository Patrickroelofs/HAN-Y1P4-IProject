<?php

if(isset($_POST['banuser'])) {
    Admin::banUser($thisUser->first()->id);

    Message::noticeMulti('profile.php?user='.$thisUser->first()->id, array(
        'm' => 'Dit account is succesvol geblokeert op eenmaalandermaal.'
    ));
}

if(isset($_POST['unbanuser'])) {
    Admin::unbanUser($thisUser->first()->id);

    Message::noticeMulti('profile.php?user='.$thisUser->first()->id, array(
        'm' => 'Dit account kan eenmaalandermaal weer gebruiken!'
    ));
}