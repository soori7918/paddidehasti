<?php

namespace App\Http\Controllers\Padideh\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Padideh\Admin\StoreDriverRequest;
use App\Http\Requests\Padideh\Admin\UpdateDriverRequest;
use App\Models\Padideh\Driver;
use App\Repositories\Admin\DriverRepo;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    private $driver_repo;

    public function __construct(DriverRepo $driver_repo)
    {
        $this->driver_repo = $driver_repo;
    }
    
    public function index()
    {
        return $this->driver_repo->all();
    }

    
    public function create()
    {
        return $this->driver_repo->create();

    }

    
    public function store(StoreDriverRequest $request)
    {
        $driver = $this->driver_repo->store($request);
        if($driver)
        {
            return redirect()->route('panel.drivers.index')->with([
                'success' => 'با موفقیت ثبت شد'
            ]);
        }
    }

    
    public function show(Driver $driver)
    {
        return $this->driver_repo->show($driver);

    }

    
    public function edit(Driver $driver)
    {
       return $this->driver_repo->edit($driver);
       
    }

    
    public function update(UpdateDriverRequest $request,Driver $driver)
    {
        $driver = $this->driver_repo->update($request,$driver);
        if($driver)
        {
            return \redirect()->route('panel.drivers.index')->with([
                'success' => 'با موفقیت ثبت شد'
            ]);
        }

    }

     
    public function destroy(Driver $driver)
    {
        $result =  $this->driver_repo->destroy($driver);
        if($result)
        {
            return \redirect()->route('panel.drivers.index')->with([
                'success' => 'با موفقیت حذف شد'
            ]);
        }

    }
}
