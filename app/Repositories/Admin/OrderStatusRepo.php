<?php
namespace App\Repositories\Admin;

use App\Http\Requests\Padideh\Admin\OrderStatusRequest;
use App\Models\Padideh\OrderStatus;

class OrderStatusRepo {

    public function all(){
        return $orderStatuses = OrderStatus::latest()->paginate(20);
       
    }


    public function show($orderStatus)
    {
        return view('Padideh.order-statuses.show')->with([
            'orderStatus' => $orderStatus
        ]);
    }


    public function create()
    {
        return view('Padideh.order-statuses.create');
    }

    public function store($request)
    {
        return $order_status = OrderStatus::create([
            'title' => $request->input('title'),
            'step' => $request->input('step'),
            'description' => $request->input('description'),
        ]);
    }

    public function destroy($ordeStatus)
    {
        return $ordeStatus->delete();
    }





}
