<?php
/**
 * Created by PhpStorm.
 * User: moren
 * Date: 24.05.2018
 * Time: 23:48
 */

namespace borrow\EventHandler;

use borrow\Event\BookReturned;

class BookRentalSettled
{
    public function __invoke(BookReturned $event)
    {
        echo "PROCESS COMPLETED!";
    }
}