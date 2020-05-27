<?php


class Trader
{
    public static function checkItems($username) {
        $items = Database::getInstance()->get('Items', array('trader', '=', $username));

        $currentDate = new DateTime(date("Y-m-d"));
        $currentTime = new DateTime(strftime("%H:%M:%S"));

        foreach($items->results() as $item) {
            $bids = Database::getInstance()->query("SELECT * FROM Bids WHERE item = '$item->id' ORDER BY amount DESC",array());

            $endDate = new DateTime($item->durationenddate);
            $endTime = new DateTime($item->durationendtime);

            $timeLeft = $currentDate->diff($endDate)->format("%d");

            if ($endDate > $currentDate) {

            } else {
                if($endTime <= $currentTime) {
                    if(!$item->closed) {
                        Database::getInstance()->insert("Notifications", array(
                            'username' => $bids->first()->username,
                            'message' => 'U heeft het bod gewonnen op' . $item->title
                        ));

                        Database::getInstance()->insert("Notifications", array(
                            'username' => $item->trader,
                            'message' => $item->title . 'is succesvol verkocht'
                        ));

                        if ($bids->count() >= 1) {
                            Database::getInstance()->update("Items", "id", "$item->id", array(
                                'closed' => true,
                                'buyer' => $bids->first()->username,
                                'saleprice' => $bids->first()->amount
                            ));
                        }

                        Database::getInstance()->update("Items", "id", "$item->id", array(
                            'closed' => true
                        ));
                    }
                }
            }
        }
    }
}