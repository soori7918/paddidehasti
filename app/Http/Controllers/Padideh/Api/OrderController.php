<?php

namespace App\Http\Controllers\Padideh\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Padideh\Api\StoreWasteOrderHead;
use App\Http\Resources\Padideh\WasteOrderHeadResource;
use App\Models\Padideh\WasteOrder;
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

    public function index(Request $request)
    {
        $orders = WasteOrderHeadResource::collection($this->orderRepository->getIndex($request->user()));

        return $this->successResponse('لیست سفارشات', $orders);

    }

    public function store(StoreWasteOrderHead $request)
    {
        $orderhead = $this->orderRepository->storeUserOrder($request->all() , $request->user());
        if ($orderhead) {

            return $this->successResponse('سفارش شما با موفقیت ثبت شد', new WasteOrderHeadResource($orderhead));
        }

        return $this->failedResponse('w', 'سفارش ثبت نشد دوباره تلاش کنید');
    }

    public function cancelOrder(WasteOrderHead $order)
    {
        return $this->orderRepository->cancelOrderHead($order);
    }

}

