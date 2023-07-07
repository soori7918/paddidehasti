<?php


namespace App\Http\Traits\Padideh;

use App\Models\Padideh\{
    Driver,
};

trait DriverTrait
{
    public function driverWithMobileExists($mobile){
        return Driver::where('mobile','=',$mobile)->first();
    }

}
