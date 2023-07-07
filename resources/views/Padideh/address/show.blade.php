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
                           <strong class="font-weight-bold" style="font-size:20px">مشاهده آدرس های {{$user->family}}</strong>
                       </div>
                       <table class="table table-bordered ">
                           <thead>
                               <th>#</th>
                               <th>عنوان</th>
                               <th>آدرس</th>
                               <th>نام کاربری</th>
                               <th>موبایل</th>
                           </thead>
                           <tbody>
                               @foreach ($user->addresses as $key=>$address)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$address->title}}</td>
                                        <td>{{$address->address}}</td>
                                        <td>{{$address->user_name}}</td>
                                        <td>{{$address->user_mobile}}</td>
                                        <td></td>
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

@endsection
