@extends('admin.layouts.master')

@section('content')
<div class="content p-2">
    <div class="d-flex justify-content-between align-items-center p-2">
        <strong class="font-weight-bold" style="font-size:20px">ویرایش اطلاعات{{$admin->name}}</strong>
        <a class="btn btn-secondary waves-effect waves-light" href="{{route('panel.admins.index')}}">بازگشت</a>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card p-2">
                @include('components.messages')

                <form action="{{route('panel.admins.update',$admin->id)}}" method="post">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-12 col-lg-4 form-group">
                            <label for="name">نام</label>
                            <input type="text" name="name" class="form-control" value="{{old('name') ?: $admin->name}}" id="name">
                        </div>
                        <div class="col-12 col-lg-4 form-group">
                            <label for="family">نام خانوادگی</label>
                            <input type="text" name="family" class="form-control" value="{{old('family') ?: $admin->family}}" id="family">
                        </div>
                        <div class="col-12 col-lg-4 form-group">
                            <label for="email">ایمیل</label>
                            <input type="email" name="email" class="form-control" value="{{old('email') ?: $admin->email}}" id="email">
                        </div>
                        <div class="col-12 col-lg-4 form-group">
                            <label for="mobile">شماره همراه</label>
                            <input type="text" name="mobile" class="form-control" value="{{old('mobile') ?: $admin->mobile}}" id="mobile">
                        </div>
                        {{-- <div class="col-12 col-lg-4 form-group">
                            <label for="region">منطقه</label>
                            <input type="text" name="region" class="form-control" value="{{old('region') or $admin->region}}" id="region">
                        </div> --}}
                        <div class="col-12 col-lg-12 form-group">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="access_status" {{$admin->access_status == true ? 'checked' : ''}} name="access_status">
                                <label class="form-check-label pr-4" for="access_status">فعال باشد</label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">ویرایش اطلاعات</button>
                    <a class="btn btn-secondary" href="{{route('panel.admins.index')}}">بازگشت</a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
