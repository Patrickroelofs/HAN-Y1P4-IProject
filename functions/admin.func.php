<?php

if(isset($_POST['banuser'])) {
    Admin::banUser($thisUser->first()->id);

    Message::noticeMulti('profile.php?user='.$thisUser->first()->id.'&', array(
        'm' => 'Dit account is succesvol geblokeert op eenmaalandermaal.'
    ));
}