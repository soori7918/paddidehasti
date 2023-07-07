<?php

namespace App\Http\Controllers\Padideh\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Padideh\Admin\OrderStatusRequest;
use App\Models\Padideh\OrderStatus;
use App\Repositories\Admin\OrderStatusRepo;

class OrderStatusController extends Controller
{
    private $orderStatusRepo;

    public function __construct(OrderStatusRepo $orderStatusRepo){
        $this->orderStatusRepo = $orderStatusRepo;
    }
    public function index()
    {
        $orderStatuses = $this->orderStatusRepo->all();
        return view('Padideh.order-statuses.index')->with([
            'orderStatuses' => $orderStatuses
        ]);
    }

    
    public function create()
    {
        return $this->orderStatusRepo->create();
    }

    
    public function store(OrderStatusRequest $request)
    {
        $status = $this->orderStatusRepo->store($request);
        if($status)
        {
            return redirect()->route('panel.orders.statuses.index')->with([
                'success' => 'با موفقیت ثبت شد'
            ]);
        }
    }



   
    public function destroy(OrderStatus $status)
    {
        $result =  $this->orderStatusRepo->destroy($status);
        if ($result) {
            return redirect()->back()->with([
                'success' => 'با موفقیت ثبت شد'
            ]);
        }
    }
}
