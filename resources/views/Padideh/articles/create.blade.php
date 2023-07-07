@extends('admin.layouts.master')

@section('css')
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap-select.min.css')}}">
@endsection

@section('content')
<div class="content p-2">
    <div class="d-flex justify-content-between align-items-center p-2">
        <strong class="font-weight-bold" style="font-size:20px">ثبت مقاله جدید</strong>
        <a class="btn btn-secondary waves-effect waves-light" href="{{route('panel.admins.index')}}">بازگشت</a>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card p-2">
                @include('components.messages')
                <form action="{{route('panel.articles.store')}}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-9">
                            <div class="row">
                                <div class="col-12 col-lg-6 form-group">
                                    <label for="title">عنوان</label>
                                    <input type="text" name="title" class="form-control" value="{{old('title')}}" id="title">
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
                            
                                <div class="col-12 col-lg-12 form-group">
                                    <label for="short_description">توضیحات</label>
                                    <textarea name="short_description" id="" cols="30" class="form-control" rows="10"></textarea>
                                </div>
                                <div class="col-12 col-lg-12 form-group">
                                    <label for="full_description">توضیحات</label>
                                    <textarea name="full_description" id="" cols="30" class="form-control" rows="10"></textarea>
                                </div>
                                <div class="col-12 col-lg-12 form-group">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="published" name="published">
                                        <label class="form-check-label pr-4" for="published">فعال باشد</label>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-12 form-group">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="can_comment" name="can_comment">
                                        <label class="form-check-label pr-4" for="can_comment">کامنت ها دیده شود</label>
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
<script
type="text/javascript"
src='https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js'
referrerpolicy="origin">
</script><script type="text/javascript">
    tinymce.init({
        selector: 'textarea',
        height: 100,
        language : 'fa',
    paste_data_images: true,
    height:300,
    plugins: 'preview link image  code table emoticons textcolor numberlist codesample lists media lists advlist directionality',
    toolbar: 'undo redo | styleselect | bold italic Underline| alignleft aligncenter alignright alignjustify numlist bullist| outdent indent forecolor backcolor ltr rtl| link image media table| copy cut paste | preview | list |emoticons codesample|',
    image_title: true,
    automatic_uploads: true,
    file_picker_types: 'image',
    file_picker_callback: function(cb, value, meta) {
        var input = document.createElement('input');
        input.setAttribute('type', 'file');
        input.setAttribute('accept', 'image/*');
        input.onchange = function() {
            var file = this.files[0];

            var reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = function () {
                var id = 'blobid' + (new Date()).getTime();
                var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                var base64 = reader.result.split(',')[1];
                var blobInfo = blobCache.create(id, file, base64);
                blobCache.add(blobInfo);
                cb(blobInfo.blobUri(), { title: file.name });
            };
        };
        input.click();
    }
    });
</script>
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