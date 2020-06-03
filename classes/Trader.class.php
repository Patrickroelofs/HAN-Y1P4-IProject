<?php


class Trader
{
    /**
     * Checks if an item needs to be closed, specifically when the time is < 0, if it is true mark the item as closed and send notifications.
     * @param $username
     * @throws Exception
     */
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
                            Notification::add($bids->first()->username, "U heeft het bod gewonnen op <a href='product.php?p=". $item->id ."'>" . $item->title . "</a>");
                            Notification::add($item->trader, "<a href='product.php?p=$item->id'>" . $item->title . " is succesvol verkocht. Neem contact op met de koper</a>");

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