<?php
namespace App\Repositories\Admin;

use App\Http\Traits\FileUploadTrait;
use App\Models\Padideh\Waste;
use App\Models\Padideh\Product;
use App\Models\Padideh\ProductCategory;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class PasmandRepo {
    use FileUploadTrait;
    public function all(){
        $pasmands = Waste::latest()->paginate(15);
        return view('Padideh.pasmands.index')->with([
            'pasmands' => $pasmands,
        ]);
    }

    public function create()
    {
        return view('Padideh.pasmands.create');
    }

    public function store($request)
    {
        $icon = null;
        if ($request->hasFile('icon')) {
            $icon = $this->uploadFile($request->icon, Waste::UPLOAD_URL, 'waste_image_', 'storage', ['png','jpeg', 'jpg', 'svg']);
        }

        return Waste::create([
            'name' => $request->input('name'),
            'unit' => $request->input('unit'),
            'buy_price' => $request->input('buy_price'),
            'sale_price' => $request->input('sale_price'),
            'description' => $request->input('description'),
            'icon' => $icon,
            'is_active' => $request->input('is_active') ? true : false,
        ]);
    }
    public function show($pasmand)
    {
        return view('Padideh.pasmands.show')->with([
            'pasmand' => $pasmand
        ]);
    }
    public function edit($pasmand)
    {
        return view('Padideh.pasmands.edit')->with([
            'pasmand' => $pasmand,
        ]);
    }

    public function update($request,$pasmand){
        $icon = null;
        if ($request->hasFile('icon')) {
            $this->removeFile('storage', Waste::SHOW_URL.$pasmand->icon);
            $icon = $this->uploadFile($request->icon, Waste::UPLOAD_URL, 'waste_image_', 'storage', ['png','jpeg', 'jpg', 'svg']);
        }

        return $pasmand->update([
            'name' => $request->input('name'),
            'unit' => $request->input('unit'),
            'buy_price' => $request->input('buy_price'),
            'sale_price' => $request->input('sale_price'),
            'description' => $request->input('description'),
            'icon' =>  $icon ?? $pasmand->icon,
            'is_active' => $request->input('is_active') ? true : false,
        ]);
    }


    public function destroy($pasmand)
    {
        $this->removeFile('storage', Waste::SHOW_URL.$pasmand->icon);
        //File::delete($pasmand->image);
        return $pasmand->delete();
    }

    //apis

    public function getWastes($request)
    {
        return Waste::query()->active()->get();
    }
}
