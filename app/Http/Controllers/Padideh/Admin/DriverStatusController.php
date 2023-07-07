<?php

namespace App\Http\Controllers\Padideh\Admin;

use App\Http\Controllers\Controller;
use App\Models\Padideh\DriverStatus;
use App\Repositories\Admin\DriverStatusRepository;
use Illuminate\Http\Request;

class DriverStatusController extends Controller
{
    private $driverStatusRepository;
   
    public function __construct(DriverStatusRepository $driverStatusRepository)
    {
        $this->driverStatusRepository = $driverStatusRepository;
    }


    public function index()
    {
        $driverStatuses =  $this->driverStatusRepository->index();
        return view('Padideh.driver-statuses.index')->with([
            'driverStatuses' => $driverStatuses
        ]);
    }

    

    
    public function store(Request $request)
    {
        $driverStatus = $this->driverStatusRepository->store($request);
        if($driverStatus)
        {
            return \redirect()->back()->with([
                'success' => 'با موفقیت ثبت شد'
            ]);
        }

    }

    

  
    public function destroy(DriverStatus $status)
    {
        $result =  $this->driverStatusRepository->destroy($status);

        if($result)
        {
            return \redirect()->back()->with([
                'success' => 'با موفقیت ثبت شد'
            ]);
        }

    }
}
