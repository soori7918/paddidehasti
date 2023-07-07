@extends('admin.layouts.master')

@section('content')
<div class="content p-2">
    <div class="d-flex justify-content-end align-items-center p-2">
        <a class="btn btn-secondary waves-effect waves-light" href="{{route('panel.users.index')}}">بازگشت</a>
    </div>
  
        @include('Padideh.users.tab')
    <div class="row">
        <div class="col-12">
            <div class="card p-2 shadow-sm">
               <div class="row">
                   <div class="col-9">
                       <div class="p-4">
                           <strong class="font-weight-bold" style="font-size:20px">مشاهده اطلاعات {{$user->family}}</strong>
                       </div>

                       <table class="table table-bordered table-sm">
                           <thead>
                               <tbody>
                                   <tr>
                                       <td>نام</td>
                                       <td>{{$user->name ?: '---'}}</td>
                                   </tr>
                                   <tr>
                                       <td>نام خانوادگی</td>
                                       <td>{{$user->family ?: '---'}}</td>
                                   </tr>
                                   <tr>
                                       <td>شماره تماس</td>
                                       <td>{{$user->mobile ?: '---'}}</td>
                                   </tr>
                                   <tr>
                                       <td>ایمیل</td>
                                       <td>{{$user->email ?: '---'}}</td>
                                   </tr>
                                   <tr>
                                       <td>وضعیت</td>
                                       <td>{!!$user->get_status()!!}</td>
                                   </tr>
                               </tbody>
                           </thead>
                       </table>
                   </div>
                   <div class="col-3">
                       
                   </div>
                   <div class="col-12">
                       @foreach ($user->addresses as $address)
                           {{$address->title}}
                       @endforeach
                   </div>
               </div>
            </div>
        </div>
    </div>
</div>

@endsection
