<?php
namespace App\Repositories\Admin;

use App\Http\Traits\FileUploadTrait;
use App\Models\Padideh\Driver;
use App\Models\Padideh\DriverStatus;
use App\Models\Padideh\User;
use Illuminate\Support\Facades\Hash;

class DriverRepo {
    use FileUploadTrait;

    public function all(){
        $drivers =Driver::latest()->paginate(15);
        return view('Padideh.drivers.index')->with([
            'drivers' => $drivers
        ]);
    }

    public function create()
    {
        return view('Padideh.drivers.create');
    }

    public function store($request)
    {
        $image = null;
        if ($request->hasFile('image')) {
            $image = $this->uploadFile($request->image, Driver::UPLOAD_URL, 'driver_image_', 'storage', ['png','jpeg', 'jpg', 'svg']);
        }

        $cm_image = null;
        if ($request->hasFile('cm_image')) {
            $cm_image = $this->uploadFile($request->cm_image, Driver::UPLOAD_URL, 'cm_image_image_', 'storage', ['png','jpeg', 'jpg', 'svg']);
        }

        $certificate_image = null;
        if ($request->hasFile('certificate_image')) {
            $certificate_image = $this->uploadFile($request->certificate_image, Driver::UPLOAD_URL, 'certificate_image_image_', 'storage', ['png','jpeg', 'jpg', 'svg']);
        }

        $car_cart_image = null;
        if ($request->hasFile('car_cart_image')) {
            $car_cart_image = $this->uploadFile($request->car_cart_image, Driver::UPLOAD_URL, 'car_cart_image_image_', 'storage', ['png','jpeg', 'jpg', 'svg']);
        }
        return Driver::create([
            'name' => $request->input('name'),
            'family' => $request->input('family'),
            'mobile' => $request->input('mobile'),
            'car_id' => $request->input('car_id'),
            'lat' => $request->input('lat'),
            'lng' => $request->input('lng'),
            'car_pelak' => $request->input('car_pelak'),
            'car_name' => $request->input('car_name'),
            'shaba_number' => $request->input('shaba_number'),
            'card_number' => $request->input('card_number'),
            'image' => $image,
            'cm_image' => $cm_image,
            'certificate_image' => $certificate_image,
            'car_cart_image' => $car_cart_image,
            'is_active' => $request->input('is_active') ? true : false,
        ]);
    }

    public function show($driver)
    {
        return view('Padideh.drivers.show')->with([
            'driver' => $driver
        ]);
    }

    public function edit($driver)
    {
        $driver_statuses = DriverStatus::all();
        return view('Padideh.drivers.edit')->with([
            'driver' => $driver,
            'driver_statuses' => $driver_statuses
        ]);
    }
   

    public function update($request,$driver){
        $image = null;
        if ($request->hasFile('image')) {
            $this->removeFile('storage', Driver::SHOW_URL.$driver->image);
            $image = $this->uploadFile($request->image, Driver::UPLOAD_URL, 'driver_image_', 'storage', ['png','jpeg', 'jpg', 'svg']);
        }

        $cm_image = null;
        if ($request->hasFile('cm_image')) {
            $this->removeFile('storage', Driver::SHOW_URL.$driver->cm_image);
            $cm_image = $this->uploadFile($request->cm_image, Driver::UPLOAD_URL, 'cm_image_image_', 'storage', ['png','jpeg', 'jpg', 'svg']);
        }

        $certificate_image = null;
        if ($request->hasFile('certificate_image')) {
            $this->removeFile('storage', Driver::SHOW_URL.$driver->certificate_image);
            $certificate_image = $this->uploadFile($request->certificate_image, Driver::UPLOAD_URL, 'certificate_image_image_', 'storage', ['png','jpeg', 'jpg', 'svg']);
        }

        $car_cart_image = null;
        if ($request->hasFile('car_cart_image')) {
            $this->removeFile('storage', Driver::SHOW_URL.$driver->car_cart_image);
            $car_cart_image = $this->uploadFile($request->car_cart_image, Driver::UPLOAD_URL, 'car_cart_image_image_', 'storage', ['png','jpeg', 'jpg', 'svg']);
        }
        return $driver->update([
            'name' => $request->input('name'),
            'family' => $request->input('family'),
            'mobile' => $request->input('mobile'),
            'car_id' => $request->input('car_id'),
            'lat' => $request->input('lat'),
            'lng' => $request->input('lng'),
            'car_pelak' => $request->input('car_pelak'),
            'car_name' => $request->input('car_name'),
            'shaba_number' => $request->input('shaba_number'),
            'card_number' => $request->input('card_number'),
            'image' => $image ?? $driver->image,
            'cm_image' => $cm_image ?? $driver->cm_image,
            'certificate_image' => $certificate_image ?? $driver->certificate_image,
            'car_cart_image' => $car_cart_image ?? $driver->car_cart_image,
            'is_active' => $request->input('is_active') ? true : false,
            'status_id' => $request->input('driver_status_id') ? true : false,
        ]);
    }


    public function destroy($driver)
    {
        $this->removeFile('storage', Driver::SHOW_URL.$driver->image);
        return $driver->delete();
    }


}
