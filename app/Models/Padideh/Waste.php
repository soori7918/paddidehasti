<?php

namespace App\Models\Padideh;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Verta;
class Waste extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded=[];
    protected $table="wastes";

    const ACTIVE = 1;
    const INACTIVE = 0;

    const UPLOAD_URL = 'wastes/images/';
    const SHOW_URL = '/storage/wastes/images/';

    public static $types = [
        'rial' => 'ریال',
        'toman' => 'تومان'
    ];

    public function get_status()
    {
        try{
            if($this->is_active == true){
                return ('<span class="badge badge-success">فعال</span>');
            }else{
                return ('<span class="badge badge-danger">غیرفعال</span>');

            }
        }catch(Exception $e){
            return '#';
        }
    }

    public function getjalaliCreatedAtAttribute()
    {
        $v = new Verta($this->created_at);
        return $v->formatJalaliDate();
    }

    function getImageSrc($image = '', $template = 'original')
    {
        if ($image) {
            return route('imagecache', ['template' => $template, 'filename' => $image]);
        }
        return null;
    }
    public function getImage()
    {
        return $this->icon ? self::SHOW_URL.$this->icon : 'previewImage.gif';
    }

    public function getTypeTitle(){
        try{
            return Self::$types[$this->type];
        }catch(Exception $e){
            return '#';
        }
    }

   


    //scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', self::ACTIVE);
    }
}
