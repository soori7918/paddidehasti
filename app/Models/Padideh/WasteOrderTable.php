<?php

namespace App\Models\Padideh;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WasteOrderTable extends Model
{
    use HasFactory;
    protected $gurded=[];
    protected $table = "waste_orders";

    public function order_head(){
        return $this->belongsTo(WasteOrderHead::class);
    }

    public function user(){
        return $this->belongsTo(User::class , 'user_id','id');
    }

    public function waste(){
        return $this->hasOne(Waste::class ,'waste_id');
    }



}
