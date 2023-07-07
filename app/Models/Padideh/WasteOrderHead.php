<?php

namespace App\Models\Padideh;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class WasteOrderHead extends Model
{
    use SoftDeletes,Notifiable;

    protected $guarded=[];
    protected $table="waste_orderheads";

    const BASE_CODE = 'PDH';

    //relations

    public function orders(){
        return $this->hasMany(WasteOrder::class,'waste_orderhead_id');
    }

    public function admin(){
        return $this->belongsTo(Admin::class , 'admin_id');
    }
    public function user(){
        return $this->belongsTo(User::class , 'user_id','id');
    }

    public function driver(){
        return $this->belongsTo(Driver::class , 'driver_id');
    }

    public function status(){
        return $this->belongsTo(OrderStatus::class ,'status_id');
    }

    public function address(){
        return $this->belongsTo(Address::class,'address_id');
    }

    //scopes



    //functions
    public function getFinalPrice()
    {
        return $this->total_price;

    }

    public function generateCode()
    {
        return self::BASE_CODE.'-'.now()->format('Ymd').'-'.$this->id;
    }

    public function get_driver_info(){
        try{
            return $this->driver->name.$this->driver->family.$this->driver->mobile;
        }catch(Exception $e){
            return 'نامشخص';
        }
    }
    public function getUserInfo(){
        $name = '';
        if ($this->user) {
            $name = $this->user->name.' '.$this->user->family.' '.$this->user->mobile;
        }

        return $name;
    }


}
