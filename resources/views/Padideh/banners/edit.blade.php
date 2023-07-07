@extends('admin.layouts.master')

@section('content')
<div class="content p-2">
    <div class="d-flex justify-content-between align-items-center p-2">
        <strong class="font-weight-bold" style="font-size:20px">ویرایش اطلاعات{{$banner->title}}</strong>
        <a class="btn btn-secondary waves-effect waves-light" href="{{route('panel.banners.index')}}">بازگشت</a>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card p-2">
                @include('components.messages')

                <form action="{{route('panel.banners.update',$banner->id)}}" enctype="multipart/form-data" method="post">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-9">
                            <div class="row">
                                <div class="col-12 col-lg-6 form-group">
                                    <label for="title">عنوان</label>
                                    <input type="text" name="title" class="form-control" value="{{old('title') ?: $banner->title}}" id="title">
                                </div>
                                <div class="col-12 col-lg-6 form-group">
                                    <label for="link">لینک</label>
                                    <input type="link" name="link" class="form-control" value="{{old('link') ?: $banner->link}}" id="email">
                                </div>
                                <div class="col-12 col-lg-12 form-group">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="is_active" {{$banner->is_active == true ? 'checked' : ''}} name="is_active">
                                        <label class="form-check-label pr-4" for="is_active">فعال باشد</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="col-12 col-lg-4 form-group">
                                <label for="image">
                                    <img id="preview-image-before-upload" src="{{ $banner->getImage() }}" style="max-width: 200px" alt="preview image" >
                                    <input type="file" name="image" class="form-control"  id="image">
                                </label>
                            </div>
                            <div class="col-12 col-lg-4 form-group">
                                <label for="image_cover">
                                    <img id="preview-image-cover-before-upload" src="{{ $banner->getImageCover() }}" style="max-width: 200px" alt="preview image" >
                                    <input type="file" name="image_cover" class="form-control"  id="image_cover">
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-success">ویرایش اطلاعات</button>
                    <a class="btn btn-secondary" href="{{route('panel.banners.index')}}">بازگشت</a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script type="text/javascript">
      
    $(document).ready(function (e) {
     
       
       $('#image').change(function(){
                
        let reader = new FileReader();
     
        reader.onload = (e) => { 
     
          $('#preview-image-before-upload').attr('src', e.target.result); 
        }
     
        reader.readAsDataURL(this.files[0]); 
       
       });
       $('#image_cover').change(function(){
                
        let reader = new FileReader();
     
        reader.onload = (e) => { 
     
          $('#preview-image-cover-before-upload').attr('src', e.target.result); 
        }
     
        reader.readAsDataURL(this.files[0]); 
       
       });
       
    });
     
    </script>
@endsection