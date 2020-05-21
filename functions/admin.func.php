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

if(isset($_POST['hideitem'])) {
    Admin::hideItem($thisItem->first()->id);

    Message::noticeMulti('product.php?p='.$thisItem->first()->id, array(
        'm' => 'Dit product is succesvol geblokeert op eenmaalandermaal.'
    ));
}

if(isset($_POST['unhideitem'])) {
    Admin::showItem($thisItem->first()->id);

    Message::noticeMulti('product.php?p='.$thisItem->first()->id, array(
        'm' => 'Dit product is weer zichtbaar op EenmaalAndermaal.'
    ));
}