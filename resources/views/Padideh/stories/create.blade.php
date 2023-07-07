@extends('admin.layouts.master')

@section('css')
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap-select.min.css')}}">
@endsection

@section('content')
<div class="content p-2">
    <div class="d-flex justify-content-between align-items-center p-2">
        <strong class="font-weight-bold" style="font-size:20px">ثبت استوری جدید</strong>
        <a class="btn btn-secondary waves-effect waves-light" href="{{route('panel.admins.index')}}">بازگشت</a>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card p-2">
                @include('components.messages')
                <form action="{{route('panel.stories.store')}}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-9">
                            <div class="row">
                                <div class="col-12 col-lg-6 form-group">
                                    <label for="title">عنوان</label>
                                    <input type="text" name="title" class="form-control" value="{{old('title')}}" id="title">
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
                    <button type="submit" class="btn btn-success">ثبت استوری</button>
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