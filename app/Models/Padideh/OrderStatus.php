<?php

namespace App\Models\Padideh;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class OrderStatus extends Model
{
    use HasFactory,Notifiable;
    protected $table="order_statuses";
    protected $guarded=[];

    public function waste_order()
    {
        return $this->hasOne(WasteOrderHead::class);
    }

    public function scopeStep($query , $step) 
    {
        return $query->where('step',$step);
    }

}
