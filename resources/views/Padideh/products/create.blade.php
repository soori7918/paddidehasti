@extends('admin.layouts.master')

@section('css')
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap-select.min.css')}}">
@endsection

@section('content')
<div class="content p-2">
    <div class="d-flex justify-content-between align-items-center p-2">
        <strong class="font-weight-bold" style="font-size:20px">ثبت محصول جدید</strong>
        <a class="btn btn-secondary waves-effect waves-light" href="{{route('panel.admins.index')}}">بازگشت</a>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card p-2">
                @include('components.messages')
                <form action="{{route('panel.products.store')}}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-9">
                            <div class="row">
                                <div class="col-12 col-lg-6 form-group">
                                    <label for="name">نام</label>
                                    <input type="text" name="name" class="form-control" value="{{old('name')}}" id="name">
                                </div>
                                <div class="col-12 col-lg-6 form-group">
                                    <label for="category_id">دسته بندی</label>
                                    <select name="category_id[]" id="category_id" data-live-search="true" multiple id="selectpicker" class="form-control">
                                        <option value=""></option>
                                        @foreach ($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-lg-6 form-group">
                                    
                                    <label for="link">قیمت</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="price" name="price" aria-label="price" aria-describedby="basic-addon1">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text" id="basic-addon1">تومان</span>
                                        </div>
                                    </div>
                                   
                                </div>
                                <div class="col-12 col-lg-6 form-group">
                                    <label for="link">لینک</label>
                                    <input type="link" name="link" class="form-control"  value="{{old('link')}}" id="link">
                                </div>
                                
                                <div class="col-12 col-lg-12 form-group">
                                    <label for="description">توضیحات</label>
                                    <textarea name="description" id="" cols="30" class="form-control" rows="10"></textarea>
                                </div>
                                <div class="col-12 col-lg-12 form-group">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="access_status" name="access_status">
                                        <label class="form-check-label pr-4" for="access_status">فعال باشد</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="col-12 col-lg-4 form-group">
                                <label for="image">
                                    <img id="preview-image-before-upload" src="{{asset('./previewImage.gif')}}" style="max-width: 200px" alt="preview image" >
                                    <input type="file" name="image" class="form-control"  id="image">
                                </label>
                            </div>
                        </div>
                     

                    </div>
                    <button type="submit" class="btn btn-success">ثبت محصول</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script src="{{ asset('assets/js/bootstrap-select.min.js')  }}"></script>
    <script>
            $('#selectpicker').selectpicker()

            $(document).ready(function (e) {
            
            
            $('#image').change(function(){
                        
                let reader = new FileReader();
            
                reader.onload = (e) => { 
            
                $('#preview-image-before-upload').attr('src', e.target.result); 
                }
            
                reader.readAsDataURL(this.files[0]); 
            
            });
            
            });
     
    </script>
@endsection