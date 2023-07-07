<?php

namespace App\Listeners\WasteOrder;

use App\Events\WasteOrder\WasteOrderUpdated;
use App\Notifications\UpdateWasteOrder;
use Illuminate\Support\Facades\Notification;

class UpdateWasteOrderHandler
{
    
    public function handle(WasteOrderUpdated $event)
    {
        $waste_order = $event->waste_order;
        $status = $event->status;

        Notification::send(
            $waste_order->user,
            new UpdateWasteOrder(
                $waste_order,
                'تغییر وضعیت سفارش',
                "وضعیت سفارش $waste_order->code تغییر کرد",
                route('panel.orders.index')
            )
        );
       

    }
}
