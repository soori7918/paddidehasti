<?php

namespace App\Repositories\Admin;

use App\Models\Padideh\DriverStatus;

class DriverStatusRepository{

    public function index()
    {
        return  DriverStatus::latest()->paginate(20);
    }

    public function store($request)
    {
        return  DriverStatus::create([
            'title' => $request->title,
            'step' => $request->step,
            'description' => $request->description,
        ]);
    }

    public function destroy($status)
    {
        return $status->delete();

    }

}