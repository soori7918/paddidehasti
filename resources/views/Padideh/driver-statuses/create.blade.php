@extends('admin.layouts.master')
@section('content')
<div class="content p-2">
    <div class="d-flex justify-content-between align-items-center p-2">
        <strong class="font-weight-bold" style="font-size:20px">ایجاد وضعیت جدید</strong>
        <a class="btn btn-secondary waves-effect waves-light" href="{{route('panel.driver_status.index')}}">بازگشت</a>
    </div>
    
  

    <div class="row">
        <div class="col-12">
            <div class="card p-2">
                @include('components.messages')
                <form action="{{route('panel.driver_status.store')}}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 col-lg-6 form-group">
                                    <label for="title">عنوان</label>
                                    <input type="text" name="title" class="form-control" value="{{old('title')}}" id="title">
                                </div>
                               
                                <div class="col-12 col-lg-6 form-group">
                                    <label for="step">مرحله</label>
                                    <input type="step" name="step" class="form-control"  value="{{old('step')}}" id="step">
                                </div>
                                <div class="col-12 col-lg-12 form-group">
                                    <label for="description">توضیحات</label>
                                    <textarea name="description" id="description" class="form-control" cols="30" rows="5"></textarea>
                                </div>
                                
                            </div>
                        </div>
                       

                    </div>
                    <button type="submit" class="btn btn-success">ثبت وضعیت</button>
                </form>
            </div>
        </div>
    </div>


</div>

@endsection
