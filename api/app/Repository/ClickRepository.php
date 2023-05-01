<?php

declare(strict_types=1);

namespace App\Repository;

use App\Click;
use App\Interface\ClickInterface;

class ClickRepository implements ClickInterface {

    public function index($date) {
        // fetch & check if have click record today
        return Click::where('date', $date)->first();
    }

    public function storeOrupdate($date)
    {
        // create/update clicks recount count
        $clicks = Click::firstOrCreate(['date' => $date]);
        // clicks increment
        $clicks->clicks += 1;
        // save the new click counts
        $clicks->save();
        // return new clicks count refresh data
        return $clicks->refresh();
    }
}