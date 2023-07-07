@extends('admin.layouts.master')

@section('content')
<div class="content p-2">
    <div class="d-flex justify-content-between align-items-center p-2">
        <strong class="font-weight-bold" style="font-size:20px">ثبت مدیر جدید</strong>
        <a class="btn btn-secondary waves-effect waves-light" href="{{route('panel.admins.index')}}">بازگشت</a>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card p-2">
                @include('components.messages')
                <form action="{{route('panel.admins.store')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-lg-4 form-group">
                            <label for="name">نام</label>
                            <input type="text" name="name" class="form-control" value="{{old('name')}}" id="name">
                        </div>
                        <div class="col-12 col-lg-4 form-group">
                            <label for="family">نام خانوادگی</label>
                            <input type="text" name="family" class="form-control"  value="{{old('family')}}" id="family">
                        </div>
                        <div class="col-12 col-lg-4 form-group">
                            <label for="email">ایمیل</label>
                            <input type="email" name="email" class="form-control"  value="{{old('email')}}" id="email">
                        </div>
                        <div class="col-12 col-lg-4 form-group">
                            <label for="mobile">شماره همراه</label>
                            <input type="text" name="mobile" class="form-control"  value="{{old('mobile')}}" id="mobile">
                        </div>
                        {{-- <div class="col-12 col-lg-4 form-group">
                            <label for="region">منطقه</label>
                            <input type="text" name="region" class="form-control" id="region">
                        </div> --}}
                        <div class="col-12 col-lg-4 form-group">
                            <label for="password">رمز عبور</label>
                            <input type="password" name="password" class="form-control" id="password" required>
                        </div>
                        <div class="col-12 col-lg-4 form-group">
                            <label for="password_confirmation">تکرار رمز</label>
                            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required>
                        </div>
                        <div class="col-12 col-lg-12 form-group">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="access_status" name="access_status">
                                <label class="form-check-label pr-4" for="access_status">فعال باشد</label>
                            </div>
                        </div>

                    </div>
                    <button type="submit" class="btn btn-success">ثبت نام</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
