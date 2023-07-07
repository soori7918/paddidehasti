@extends('admin.layouts.master')

@section('content')
<div class="content p-2">
    <div class="d-flex justify-content-between align-items-center p-2">
        <h3>لیست رانندگان</h3>
        <a class="btn btn-info" href="{{route('panel.drivers.lists.create')}}">ایجاد راننده</a>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                @include('components.messages')

                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>تصویر</th>
                            <th>نام</th>
                            <th>نام خانوادگی</th>
                            <th>شماره تماس</th>
                            <th>نام ماشین</th>
                            <th>وضعیت</th>
                            <th>وضعیت مدارک</th>
                            <th>تاریخ ثبت نام</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($drivers as $key => $driver)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>
                                <img src="{{ $driver->getImage()  }}" width="30px" height="30" class="rounded-circle" alt="">        
                            </td>
                            <td>{{$driver->name ?: '---'}}</td>
                            <td>{{$driver->family ?: '---'}}</td>
                            <td>{{$driver->mobile ?: '---'}}</td>
                            <td>{{$driver->car_name ?: '---'}}</td>
                            <td>{!!$driver->get_status() !!}</td>
                            <td>{!!$driver->get_driver_status() !!}</td>
                            <td>{{getjalaliDate($driver->created_at)}}</td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <a class="btn btn-info btn-sm" href="{{route('panel.drivers.lists.show',$driver->id)}}"><i class="ion-ios-eye"></i></a>
                                    <a class="btn btn-success btn-sm" href="{{route('panel.drivers.lists.edit',$driver->id)}}"><i class="dripicons-document-edit"></i></a>
                                    <form action="{{route('panel.drivers.lists.destroy',$driver->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" onclick="return confirm('آیا مطمعن هستید؟')" class="btn btn-sm btn-danger"><i class="ion-ios-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        @endforeach
                
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
