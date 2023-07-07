<?php

namespace App\Models\Padideh;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Verta;

class Article extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table="articles";

    
    const UPLOAD_URL = 'articles/images/';
    const SHOW_URL = '/storage/articles/images/';

    const ACTIVE = 1;
    const INACTIVE = 0;

    public function article_categories()
    {
        return $this->belongsToMany(ArticleCategory::class,'article_category','article_id','category_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function get_category(){
        foreach($this->article_categories as $category){
            return "<span class='badge badge-light'>$category->name</span>";
        }
    }
    public function get_status()
    {
        try{
            if($this->published == true){
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
    public function scopeActive($query){
        return $query->where('published',Self::ACTIVE);
    }

}
