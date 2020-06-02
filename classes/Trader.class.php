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
                        if ($bids->count() >= 1) {
                            Notification::add($bids->first()->username, 'U heeft het bod gewonnen op ' . $item->title);
                            Notification::add($item->trader, $item->title . ' is succesvol verkocht. Neem contact op met de koper');

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