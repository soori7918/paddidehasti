<?php
namespace App\Repositories\Admin;

use App\Events\WasteOrder\WasteOrderUpdated;
use App\Models\Padideh\Driver;
use App\Models\Padideh\OrderStatus;
use App\Models\Padideh\Waste;
use App\Models\Padideh\WasteOrderHead;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class OrderRepository {

    public function all(){
        $orders = WasteOrderHead::with(['user','status','address','admin'])->latest()->paginate(20);
        $statuses = OrderStatus::all();
        return view('Padideh.orders.index')->with([
            'orders' => $orders,
            'statuses' => $statuses,

        ]);
    }

    public function show($waste)
    {
       $waste=$waste->with('orders')->first();
        return view('Padideh.orders.show')->with([
            'waste' => $waste
        ]);
    }


    public function edit($order)
    {
       $order=$order->with('orders')->first();
       $drivers = Driver::all();
       $statuses = OrderStatus::all();
        return view('Padideh.orders.edit')->with([
            'order' => $order,
            'drivers' => $drivers,
            'statuses' => $statuses,
        ]);
    }

    public function update($request,$order)
    {
        $order->update([
            'address_id' => $request->address_id,
            'driver_id' => $request->driver_id,
            'delivery_date' => Carbon::createFromTimestampMs($request->delivery_date)  ?: $order->delivery_date ,
            'admin_id' => Auth::id() ,
        ]);

        if($order->status_id != $request->status_id)
        {
            $order->update([
                'status_id' => $request->status_id
            ]);
            event(new WasteOrderUpdated($order,$request->status_id));
        }

        return $order;
    }


    public function confirmation()
    {
        $wasteOrders = WasteOrderHead::with(['user','status','address','admin'])
                ->whereHas('status',function($q){
                    $q->step(1);
                })->latest()->paginate(20);

                return $wasteOrders;
    }

    public function process()
    {
        $waste_orders = WasteOrderHead::with(['user','status','address','admin']) ->whereHas('status',function($q){
            $q->step(2);
        })->latest()->paginate(20);
       return $waste_orders;
    }

    public function watting_driver()
    {
        $waste_orders = WasteOrderHead::with(['user','status','address','admin']) ->whereHas('status',function($q){
            $q->step(3);
        })->latest()->paginate(20);

        return $waste_orders;

    }

    public function changeStatus($request ,$order)
    {
        if($order->status_id != $request->status_id)
        {
            $order->update([
                'status_id' => $request->status_id
            ]);
            event(new WasteOrderUpdated($order,$request->status_id));
        }
        return $order;
    }

    



    //api

    public function getIndex($user)
    {
        return $user->wasteOrders()->latest('updated_at')->get();
    }

    public function storeUserOrder($data, $user)
    {
        $status = OrderStatus::where('step', 1)->first();
        $orderHead = WasteOrderHead::create([
            'status_id' => $status->id,
            'user_id' => $user->id,
            'address_id' => $data['address_id'],
            'delivery_date' => $data['delivery_date'],
        ]);
        $totalPrice = 0;
        $inserts = [];
        if ($orderHead and count($data['orders'])) {
            $orders = $data['orders'];
            $wastes = Waste::active()->whereIn('id', array_column($orders, 'waste_id'))->get();
            foreach ($orders as $order) {
                $waste = $wastes->where('id', $order['waste_id'])->first();
                if ($waste) {
                    $inserts [] = [
                        'waste_id' => $waste->id,
                        'weight' => $order['weight'],
                        'waste_orderhead_id' => $orderHead->id,
                        'price' => $waste->buy_price,
                        'unit' => $waste->unit,
                        'name' => $waste->name,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                    $totalPrice += $waste->buy_price * $order['weight'];
                }
            }
        }

        $orderHead->update([
            'code' => $orderHead->generateCode(),
            'total_price' => $totalPrice
        ]);

        $orderHead->orders()->insert($inserts);
        return $orderHead;
    }
    
    public function cancelOrderHead($order)
    {
        $order->update([
            'status_id' => $order->status
        ]);
        event(new WasteOrderUpdated($order,7));
        return $order;
    }



}
