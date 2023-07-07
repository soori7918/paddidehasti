@extends('admin.layouts.master')

@section('content')
<div class="content p-2">
    <div class="d-flex justify-content-between align-items-center p-2">
        <strong class="font-weight-bold" style="font-size:20px">مشاهده اطلاعات {{$product->name}}</strong>
        <a class="btn btn-secondary waves-effect waves-light" href="{{route('panel.products.index')}}">بازگشت</a>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card p-2 shadow-sm">
               <div class="row">
                   <div class="col-9">
                       <table class="table table-bordered table-sm">
                           <thead>
                               <tbody>
                                   <tr>
                                       <td>نام</td>
                                       <td>{{$product->name ?: '---'}}</td>
                                   </tr>
                                   <tr>
                                       <td>قیمت</td>
                                       <td>{{$product->price ?: '---'}}</td>
                                   </tr>
                                   <tr>
                                       <td>لینک</td>
                                       <td>{{$product->link ?: '---'}}</td>
                                   </tr>
                                   <tr>
                                       <td>توضیحات</td>
                                       <td>{{$product->description ?: '---'}}</td>
                                   </tr>
                                   <tr>
                                       <td>وضعیت</td>
                                       <td>{!!$product->get_status()!!}</td>
                                   </tr>
                               </tbody>
                           </thead>
                       </table>
                   </div>
                   <div class="col-3">
                       <img src="{{ $product->getImage() }}" alt="">
                   </div>
               </div>
            </div>
        </div>
    </div>
</div>

@endsection
