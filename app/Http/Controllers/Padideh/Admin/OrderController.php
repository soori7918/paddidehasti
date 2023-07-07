<?php

namespace App\Http\Controllers\Padideh\Admin;

use App\Http\Controllers\Controller;
use App\Models\Padideh\WasteOrderHead;
use App\Repositories\Admin\OrderRepository;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function index()
    {
        return $this->orderRepository->all();
    }

    public function show(WasteOrderHead $order)
    {
        return $this->orderRepository->show($order);
    }


    public function edit(WasteOrderHead $order)
    {
        return $this->orderRepository->edit($order);
    }


    public function update(Request $request,WasteOrderHead $order)
    {
        $order = $this->orderRepository->update($request,$order);
        if($order)
        {
            return \redirect()->route('panel.orders.index')->with([
                'success' => 'با موفقیت ثبت شد'
            ]);
        }
    }

    public function confirmations()
    {
        $wasteOrders = $this->orderRepository->confirmation();
        return view('Padideh.orders.confirmation',compact('wasteOrders'));
    }

    public function waitingProcess()
    {
        $waste_orders = $this->orderRepository->process();
        return view('Padideh.orders.process')->with([
            'waste_orders' => $waste_orders
        ]);
    }

    public function wattingDriver()
    {
        $waste_orders = $this->orderRepository->watting_driver();
        return view('Padideh.orders.watting_driver')->with([
            'waste_orders' => $waste_orders
        ]);
    }

    

    public function changeStatus(Request $request,WasteOrderHead $order)
    {
        $order = $this->orderRepository->ChangeStatus($request,$order);
        if($order)
        {
            return \redirect()->back()->with([
                'success' => 'وضعیت سفارش تغییر کرد'
            ]);
        }
    }


}
