@extends('admin.layouts.master')

@section('content')
<div class="content p-2">
    <div class="d-flex justify-content-between align-items-center p-2">
        <strong class="font-weight-bold" style="font-size:20px">ثبت دسته بندی جدید</strong>
        <a class="btn btn-secondary waves-effect waves-light" href="{{route('panel.article_categories.index')}}">بازگشت</a>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card p-2">
                @include('components.messages')
                <form action="{{route('panel.article_categories.store')}}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-lg-9">
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
                        </div>
                        <div class="col-12 col-lg-3">
                            <div class="col-12 col-lg-4 form-group">
                                <label for="image">
                                    <img id="preview-image-before-upload" src="{{asset('./previewImage.gif')}}" style="max-width: 200px" alt="preview image" >
                                    <input type="file" name="image" class="form-control"  id="image">
                                </label>
                            </div>
                        </div>
                    </div>
                   
                    <button type="submit" class="btn btn-success">ثبت </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
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