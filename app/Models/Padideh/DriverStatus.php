<?php

namespace App\Models\Padideh;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriverStatus extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function driver()
    {
        return $this->hasOne(Driver::class);
    }
}
