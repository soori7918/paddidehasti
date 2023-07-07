@extends('admin.layouts.master')

@section('content')
<div class="content p-2">
    <div class="d-flex justify-content-between align-items-center p-2">
        <strong class="font-weight-bold" style="font-size:20px">سفارش های در حال ارسال</strong>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card p-2 shadow-sm">
               <div class="row">
                   <div class="col-12 ">
                       <div class="justify-content-center align-items-center d-flex">
                           <table class="table table-bordered ">
                               <thead>
                                   <th>#</th>
                                   <th>نام و نام خانوادگی</th>
                                   <th>کد سفارش</th>
                                   <th>آدرس</th>
                                   <th>ادمین</th>
                                   <th>راننده</th>
                                   <th>وضعیت</th>
                                   <th>تاریخ دریافت</th>
                                   <th></th>
                               </thead>
                               <tbody>
                                   @foreach ($waste_orders as $key=>$order)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>
                                                {{$order->getUserInfo()}}
                                            </td>
                                            <td>{{$order->code}}</td>
                                            <td>{{$order->address->title}}</td>
                                            <td>{{$order->admin ? $order->admin->name : '---'}}</td>
                                            <td>
                                                {{ $order->get_driver_info() }}
                                            </td>
                                            <td>{{$order->status->title ?: '---'}}</td>
                                            <td>{{getjalaliDate($order->delivery_date)}}</td>
                                            <td>
                                                <a href="{{route('panel.orders.show',$order->id)}}" class="btn btn-success btn-sm" target="_blank" rel="noopener noreferrer">مشاهده جزئیات سفارش</a>
                                                <a href="{{route('panel.orders.edit',$order->id)}}" class="btn btn-primary btn-sm" >ویرایش سفارش</a>
                                            </td>
                                        </tr>
                                   @endforeach
                               </tbody>
                           </table>
                       </div>
                   </div>
               </div>
            </div>
        </div>
    </div>
</div>

@endsection
