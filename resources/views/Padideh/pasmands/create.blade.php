@extends('admin.layouts.master')

@section('css')
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap-select.min.css')}}">
@endsection

@section('content')
<div class="content p-2">
    <div class="d-flex justify-content-between align-items-center p-2">
        <strong class="font-weight-bold" style="font-size:20px">ثبت پسماند جدید</strong>
        <a class="btn btn-secondary waves-effect waves-light" href="{{route('panel.admins.index')}}">بازگشت</a>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card p-2">
                @include('components.messages')
                <form action="{{route('panel.pasmands.store')}}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-9">
                            <div class="row">
                                <div class="col-12 col-lg-6 form-group">
                                    <label for="name">نام</label>
                                    <input type="text" name="name" class="form-control" value="{{old('name')}}" id="name">
                                </div>

                                <div class="col-12 col-lg-6 form-group">

                                    <label for="unit">واحد</label>
                                    <select name="unit" id="unit" class="form-control">
                                        <option value="">انتخاب واحد</option>
                                        @foreach (App\Models\Padideh\Waste::$types as $key=>$value)
                                        <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="col-12 col-lg-6 form-group">

                                    <label for="buy_price">قیمت خرید</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="buy_price" name="buy_price" aria-label="buy_price" aria-describedby="basic-addon1">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text" id="basic-addon1">تومان</span>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-12 col-lg-6 form-group">

                                    <label for="sale_price">قیمت فروش</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="sale_price" name="sale_price" aria-label="sale_price" aria-describedby="basic-addon1">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text" id="basic-addon1">تومان</span>
                                        </div>
                                    </div>

                                </div>


                                <div class="col-12 col-lg-12 form-group">
                                    <label for="description">توضیحات</label>
                                    <textarea name="description" id="" cols="30" class="form-control" rows="5"></textarea>
                                </div>
                                <div class="col-12 col-lg-12 form-group">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="is_active" name="is_active">
                                        <label class="form-check-label pr-4" for="is_active">فعال باشد</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="col-12 col-lg-4 form-group">
                                <label for="image">
                                    <img id="preview-image-before-upload" src="{{asset('./previewImage.gif')}}" style="max-width: 200px" alt="preview image" >
                                    <input type="file" name="icon" class="form-control"  id="icon">
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


            $('#icon').change(function(){

                let reader = new FileReader();

                reader.onload = (e) => {

                $('#preview-image-before-upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);

            });

            });

    </script>
@endsection
