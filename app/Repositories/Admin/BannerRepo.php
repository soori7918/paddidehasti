<?php
namespace App\Repositories\Admin;

use App\Http\Traits\FileUploadTrait;
use App\Models\Padideh\Banner;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class BannerRepo {
    use FileUploadTrait;

    public function all(){
        $banners = Banner::latest()->paginate(15);
        return view('Padideh.banners.index')->with([
            'banners' => $banners,
        ]);
    }

    public function create()
    {
        return view('Padideh.banners.create');
    }

    public function store($request)
    {
        $image = null;
        if ($request->hasFile('image')) {
            $image = $this->uploadFile($request->image, Banner::UPLOAD_URL, 'banner_image_', 'storage', ['png','jpeg', 'jpg', 'svg']);
        }

        $image_cover = null;
        if ($request->hasFile('image_cover')) {
            $image_cover = $this->uploadFile($request->image_cover, Banner::UPLOAD_URL, 'banner_image_cover_', 'storage', ['png','jpeg', 'jpg', 'svg']);
        }

        return Banner::create([
            'title' => $request->title,
            'link' => $request->link,
            'image_cover' => $image_cover,
            'image' => $image,
            'is_active' => $request->input('access_status') ? true : false,
        ]);

       
    }
    public function show($banner)
    {
        return view('Padideh.banners.show')->with([
            'banner' => $banner
        ]);
    }
    public function edit($banner)
    {
        return view('Padideh.banners.edit')->with([
            'banner' => $banner,
        ]);
    }

    public function update($request,$banner){
        $image = null;
        if ($request->hasFile('image')) {
            $this->removeFile('storage', Banner::SHOW_URL.$banner->image);
            $image = $this->uploadFile($request->image, Banner::UPLOAD_URL, 'banner_image_', 'storage', ['png','jpeg', 'jpg', 'svg']);
        }
        $image_cover = null;
        if ($request->hasFile('image_cover')) {
            $this->removeFile('storage', Banner::SHOW_URL.$banner->image_cover);
            $image_cover = $this->uploadFile($request->image_cover, Banner::UPLOAD_URL, 'banner_image_cover_', 'storage', ['png','jpeg', 'jpg', 'svg']);
        }

        return $banner->update([
            'title' => $request->title,
            'link' => $request->link,
            'image_cover' => $image_cover ?? $banner->image_cover,
            'image' => $image ?? $banner->image,
            'is_active' => $request->input('is_active') ? true : false,
        ]);
        
    }


    public function destroy($banner)
    {
        $this->removeFile('storage', Banner::SHOW_URL.$banner->image);
        $this->removeFile('storage', Banner::SHOW_URL.$banner->cover_image);
        return $banner->delete();
        
    }


    /////api
    public function getbanners($request){
        return Banner::query()->active()->get();
    }
    
}
