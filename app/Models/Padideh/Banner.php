<?php

namespace App\Models\Padideh;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Verta;
class Banner extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded=[];

    protected $table="banners";

    protected $casts = [
        'image',
        'image_cover',
    ];

    const UPLOAD_URL = 'banners/images/';
    const SHOW_URL = '/storage/banners/images/';



    const ACTIVE = 1;
    const INACTIVE = 0;

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
        return $this->image ? self::SHOW_URL.$this->image : 'previewImage.gif';
    }
    public function getImageCover()
    {
        return $this->image_cover ? self::SHOW_URL.$this->image_cover : 'previewImage.gif';
    }

    public function scopeActive($query){
        return $query->where('is_active',Self::ACTIVE);
    }
}
