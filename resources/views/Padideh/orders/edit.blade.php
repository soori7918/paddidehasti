@extends('admin.layouts.master')

@section('css')

<link href="{{ asset('css/persian-datepicker.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/css/bootstrap-select.min.css">
<link href="{{asset('css/bootstrap-select.min.css')}}" rel="stylesheet">
@endsection


@section('content')
<div class="content p-2">
    <div class="d-flex justify-content-between align-items-center p-2">
        <strong class="font-weight-bold" style="font-size:20px">مشاهده جزئیات سفارش</strong>

        <a class="btn btn-secondary waves-effect waves-light" href="{{route('panel.orders.index')}}">بازگشت</a>
    </div>


</div>
<div class="content">
    <div class="container-fluid">
        <div class="card bg-white mb-4 shadow-sm rounded p-4">
            <form action="{{route('panel.orders.update',$order->id)}}" method="post">
                @method('patch')
                @csrf
                <div class="row">
                    <div class="col-12 col-lg-4 form-group">
                        <label for="code">کد سفارش</label>
                        <input type="text" name="code" id="code" class="form-control" value="{{$order->code}}">
                    </div>
                    <div class="col-12 col-lg-4 form-group">
                        <label for="driver_id">راننده</label>
                        <select name="driver_id" id="driver_id" class="form-control">
                            @foreach ($drivers as $driver)
                                <option value="{{$driver->id}}">{{$driver->name}} {{$driver->family}} -{{$driver->mobile}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-lg-4 form-group">
                        <label for="status_id">وضعیت</label>
                        <select name="status_id" id="status_id" class="form-control">
                            @foreach ($statuses as $status)
                                <option value="{{$status->id}}">{{$status->title}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-4 form-group">
                        <label for="delivery_date_picker">تاریخ دریافت</label>
                        <input type="text" class="form-control"  autocomplete="off" id="delivery_date_picker">
                        <input type="hidden" class="form-control" id="delivery_date" name="delivery_date">
                    </div>
                    <div class="col-12 col-lg-4 form-group">
                        <label for="address_id">آدرس</label>
                        <select name="address_id" id="address_id" class="form-control">
                            @foreach ($order->user->addresses as $address)
                                <option value="{{$address->id}}">{{$address->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-success">ثبت تغییرات</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{asset('js/bootstrap-select.min.js')}}"></script>
<script src="{{ asset('js/persian-date.js') }}"></script>
<script src="{{ asset('js/persian-datepicker.js') }}"></script>


    <script>
        delivery_date = $('#delivery_date_picker').persianDatepicker({
                format: 'YYYY/MM/DD',
                altField: '#delivery_date',
                observer: false,
                initialValue: {{$order->delivery_date != null ? 'true' : 'false'}},
                timePicker: {
                    enabled : true,
                    step : 1,
                    hour:{
                        enabled:true,
                        step:1
                    },
                    minute :{
                        enabled:true,
                        step:30
                    },
                    second:{
                        enabled:false
                    }
                }
        });
    </script>
@endsection
