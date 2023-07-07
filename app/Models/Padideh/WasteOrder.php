<?php

namespace App\Models\Padideh;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class WasteOrder extends Model
{
    use HasFactory,Notifiable;
    use SoftDeletes;
    protected $guarded=[];
    protected $table = "waste_orders";

    public function order_head(){
        return $this->belongsTo(WasteOrderHead::class , 'waste_orderhead_id');
    }

    public function user(){
        return $this->belongsTo(User::class , 'user_id','id');
    }

    public function pasmand(){
        return $this->belongsTo(Waste::class , 'pasmand_id');
    }



}
