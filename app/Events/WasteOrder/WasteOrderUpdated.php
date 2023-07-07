<?php

namespace App\Events\WasteOrder;

use App\Models\Padideh\WasteOrderHead;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class WasteOrderUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $status;
    public $waste_order;

    public function __construct(WasteOrderHead $waste_order,$status)
    {
        $this->status = $status;
        $this->waste_order = $waste_order;
    }

    
}
