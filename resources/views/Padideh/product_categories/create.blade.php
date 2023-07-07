@extends('admin.layouts.master')

@section('content')
<div class="content p-2">
    <div class="d-flex justify-content-between align-items-center p-2">
        <strong class="font-weight-bold" style="font-size:20px">ثبت دسته بندی جدید</strong>
        <a class="btn btn-secondary waves-effect waves-light" href="{{route('panel.product_categories.index')}}">بازگشت</a>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card p-2">
                @include('components.messages')
                <form action="{{route('panel.product_categories.store')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-lg-4 form-group">
                            <label for="name">نام</label>
                            <input type="text" name="name" class="form-control" value="{{old('name')}}" id="name">
                        </div>
                        <div class="col-12 col-lg-4 form-group">
                            <label for="family">دسته والد</label>
                            <select name="parent_id" class="form-control" id="parent_id">
                                <option value=""></option>
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <button type="submit" class="btn btn-success">ثبت </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
