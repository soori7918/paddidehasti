@extends('admin.layouts.master')

@section('content')
<div class="content p-2">
    <div class="d-flex justify-content-between align-items-center p-2">
        <h3>ثبت راننده جدید</h3>
        <a class="btn btn-secondary waves-effect waves-light" href="{{route('panel.drivers.lists.index')}}">بازگشت</a>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card p-2">
                @include('components.messages')
                <form action="{{route('panel.drivers.lists.store')}}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-lg-4 form-group">
                            <label for="name">نام</label>
                            <input type="text" name="name" value="{{old('name')}}" class="form-control" id="name">
                        </div>
                        <div class="col-12 col-lg-4 form-group">
                            <label for="family">نام خانوادگی</label>
                            <input type="text" name="family" class="form-control" value="{{old('family')}}" id="family">
                        </div>
                        <div class="col-12 col-lg-4 form-group">
                            <label for="mobile">شماره همراه</label>
                            <input type="text" name="mobile" class="form-control" value="{{old('mobile')}}" id="mobile">
                        </div>
                        <div class="col-12 col-lg-4 form-group">
                            <label for="car_pelak">شماره پلاک</label>
                            <input type="text" name="car_pelak" class="form-control" value="{{old('car_pelak')}}" id="car_pelak">
                        </div>
                        <div class="col-12 col-lg-4 form-group">
                            <label for="car_id"> شناسه ماشین</label>
                            <input type="text" name="car_id" class="form-control" value="{{old('car_id')}}" id="car_name">
                        </div>
                        <div class="col-12 col-lg-4 form-group">
                            <label for="car_name">نام ماشین</label>
                            <input type="text" name="car_name" class="form-control" value="{{old('car_name')}}" id="car_name">
                        </div>
                        <div class="col-12 col-lg-4 form-group">
                            <label for="shaba_number">شماره شبا</label>
                            <input type="text" name="shaba_number" class="form-control" value="{{old('shaba_number')}}" id="shaba_number">
                        </div>
                        <div class="col-12 col-lg-4 form-group">
                            <label for="card_number">شماره کارت</label>
                            <input type="text" name="card_number" class="form-control" value="{{old('card_number')}}" id="card_number">
                        </div>
                        
                        <div class="col-12 col-lg-12 form-group">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="is_active" name="is_active">
                                <label class="form-check-label pr-4" for="is_active">فعال باشد</label>
                            </div>
                        </div>
                
                        <div class="col-12 col-lg-4 form-group">
                            <label for="image">تصویر راننده</label>
                            <label for="image">
                                <img id="preview-image-before-upload" src="{{asset('./previewImage.gif')}}" style="max-width: 100px" alt="preview image" >
                                <input type="file" name="image" class="form-control"  id="image">
                            </label>
                        </div>
                        <div class="col-12 col-lg-4 form-group">
                            <label for="certificate">تصویر گواهینامه</label>
                            <label for="certificate_image">
                                <img id="preview-certificate-image-before-upload" src="{{asset('./previewImage.gif')}}" style="max-width: 100px" alt="preview image" >
                                <input type="file" name="certificate_image" class="form-control"  id="certificate_image">
                            </label>
                        </div>
                        <div class="col-12 col-lg-4 form-group">
                            <label for="cm">تصویر کارت ملی</label>
                            <label for="cm_image">
                                <img id="preview-cm-image-before-upload" src="{{asset('./previewImage.gif')}}" style="max-width: 100px" alt="preview image" >
                                <input type="file" name="cm_image" class="form-control"  id="cm_image">
                            </label>
                        </div>
                        <div class="col-12 col-lg-4 form-group">
                            <label for="car_cart_image">تصویر کارت ماشین</label>
                            <label for="car_cart_image">
                                <img id="preview-car_cart-image-before-upload" src="{{asset('./previewImage.gif')}}" style="max-width: 100px" alt="preview image" >
                                <input type="file" name="car_cart_image" class="form-control"  id="car_cart_image">
                            </label>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-success">ثبت نام</button>
                        </div>
                    </div>
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
            $('#certificate_image').change(function(){
                let reader = new FileReader();
                reader.onload = (e) => { 
                $('#preview-certificate-image-before-upload').attr('src', e.target.result); 
                }
                reader.readAsDataURL(this.files[0]); 
            });
            $('#cm_image').change(function(){
                let reader = new FileReader();
                reader.onload = (e) => { 
                $('#preview-cm-image-before-upload').attr('src', e.target.result); 
                }
                reader.readAsDataURL(this.files[0]); 
            });
            $('#car_cart_image').change(function(){
                let reader = new FileReader();
                reader.onload = (e) => { 
                $('#preview-car_cart-image-before-upload').attr('src', e.target.result); 
                }
                reader.readAsDataURL(this.files[0]); 
            });
          
            });
     
    </script>
@endsection