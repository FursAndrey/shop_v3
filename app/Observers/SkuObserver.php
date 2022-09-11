<?php

namespace App\Observers;

use App\Models\Sku;
use App\Models\Subscribtion;

class SkuObserver
{
    public function updating(Sku $sku)
    {
        $oldCount = $sku->getOriginal('count');

        if ($oldCount == 0 && $sku->count > $oldCount) {
            Subscribtion::sendEmailBySubscribtion($sku);
        }
    }
}
