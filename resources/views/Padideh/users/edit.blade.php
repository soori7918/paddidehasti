@extends('admin.layouts.master')

@section('content')
<div class="content p-2">
    <div class="d-flex justify-content-between align-items-center p-2">
        <strong class="font-weight-bold" style="font-size:20px">ویرایش اطلاعات{{$user->name}}</strong>
        <a class="btn btn-secondary waves-effect waves-light" href="{{route('panel.users.index')}}">بازگشت</a>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card p-2">
                @include('components.messages')

                <form action="{{route('panel.users.update',$user->id)}}"  method="post">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-12 col-lg-4 form-group">
                            <label for="name">نام</label>
                            <input type="text" name="name" class="form-control" value="{{old('name') ?: $user->name}}" id="name">
                        </div>
                        <div class="col-12 col-lg-4 form-group">
                            <label for="family">نام خانوادگی</label>
                            <input type="text" name="family" class="form-control" value="{{old('family') ?: $user->family}}" id="family">
                        </div>
                        <div class="col-12 col-lg-4 form-group">
                            <label for="email">ایمیل</label>
                            <input type="email" name="email" class="form-control" value="{{old('email') ?: $user->email}}" id="email">
                        </div>
                        <div class="col-12 col-lg-4 form-group">
                            <label for="mobile">شماره همراه</label>
                            <input type="text" name="mobile" class="form-control" value="{{old('mobile') ?: $user->mobile}}" id="mobile">
                        </div>
                        <div class="col-12 col-lg-12 form-group">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="access_status" {{$user->access_status == true ? 'checked' : ''}} name="access_status">
                                <label class="form-check-label pr-4" for="access_status">فعال باشد</label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">ویرایش اطلاعات</button>
                    <a class="btn btn-secondary" href="{{route('panel.users.index')}}">بازگشت</a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
