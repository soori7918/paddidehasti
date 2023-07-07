@extends('admin.layouts.master')

@section('content')
<div class="content p-2">
    <div class="d-flex justify-content-end align-items-center p-2">
        <a class="btn btn-secondary waves-effect waves-light" href="{{route('panel.drivers.lists.index')}}">بازگشت</a>
    </div>
      <div class="row">
        <div class="col-12">
            <div class="card p-2 shadow-sm">
                <div class="col-12">
                    <div class="p-4">
                        <strong class="font-weight-bold" style="font-size:20px">مشاهده اطلاعات {{$driver->family}}</strong>
                    </div>

                    <table class="table table-bordered table-sm w-50 " >
                        <thead>
                            <tbody>
                                <tr>
                                    <td>نام</td>
                                    <td>{{$driver->name ?: '---'}}</td>
                                </tr>
                                <tr>
                                    <td>نام خانوادگی</td>
                                    <td>{{$driver->family ?: '---'}}</td>
                                </tr>
                                <tr>
                                    <td>شماره تماس</td>
                                    <td>{{$driver->mobile ?: '---'}}</td>
                                </tr>
                                <tr>
                                    <td>شناسه ماشین</td>
                                    <td>{{$driver->car_id ?: '---'}}</td>
                                </tr>
                                <tr>
                                    <td>نام ماشین</td>
                                    <td>{{$driver->car_name ?: '---'}}</td>
                                </tr>
                                <tr>
                                    <td>پلاک ماشین</td>
                                    <td>{{$driver->car_pelak ?: '---'}}</td>
                                </tr>
                                <tr>
                                    <td>شماره شبا</td>
                                    <td>{{$driver->shaba_number ?: '---'}}</td>
                                </tr>
                                <tr>
                                    <td>شماره کارت</td>
                                    <td>{{$driver->card_number ?: '---'}}</td>
                                </tr>
                                <tr>
                                    <td>وضعیت</td>
                                    <td>{!!$driver->get_status()!!}</td>
                                </tr>
                            </tbody>
                        </thead>
                    </table>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-4">
                        <label for="">تصویر راننده</label>
                        <br>
                        <img src="{{ $driver->getImage() }}" alt="" width="50%" height="50%">
                    </div>
                    <div class="col-12 col-lg-4">
                        <label for="">تصویر کارت ملی</label>
                        <br>
                        <img src="{{ $driver->getCmImage() }}" alt=""  width="50%" height="50%">
                    </div>
                    <div class="col-12 col-lg-4">
                        <label for="">تصویر گواهی نامه</label>
                        <br>
                        <img src="{{ $driver->getCertificateImage() }}" alt=""  width="50%" height="50%">
                    </div>
                    <div class="col-12 col-lg-4">
                        <label for="">تصویر کارت ماشین</label>
                        <br>
                        <img src="{{ $driver->getCarCartImage() }}" alt=""  width="50%" height="50%">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
