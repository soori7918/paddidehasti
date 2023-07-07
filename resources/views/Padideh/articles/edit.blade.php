@extends('admin.layouts.master')

@section('content')
<div class="content p-2">
    <div class="d-flex justify-content-between align-items-center p-2">
        <strong class="font-weight-bold" style="font-size:20px">ویرایش اطلاعات{{$article->name}}</strong>
        <a class="btn btn-secondary waves-effect waves-light" href="{{route('panel.articles.index')}}">بازگشت</a>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card p-2">
                @include('components.messages')

                <form action="{{route('panel.articles.update',$article->id)}}" enctype="multipart/form-data" method="post">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-9">
                            <div class="row">
                                <div class="col-12 col-lg-6 form-group">
                                    <label for="name">نام</label>
                                    <input type="text" name="name" class="form-control" value="{{old('name') ?: $article->name}}" id="name">
                                </div>
                                <div class="col-12 col-lg-6 form-group">
                                    <label for="category_id">دسته بندی</label>
                                    <select name="category_id[]" id="category_id" class="form-control">
                                        <option value=""></option>
                                        @foreach ($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-lg-6 form-group">
                                    
                                    <label for="link">قیمت</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="price" value="{{old('price') ?: $article->price}}" name="price" aria-label="price" aria-describedby="basic-addon1">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text" id="basic-addon1">تومان</span>
                                        </div>
                                    </div>
                                   
                                </div>
                                <div class="col-12 col-lg-6 form-group">
                                    <label for="link">لینک</label>
                                    <input type="link" name="link" class="form-control" value="{{old('link') ?: $article->link}}" id="email">
                                </div>
                                <div class="col-12 col-lg-12 form-group">
                                    <label for="description">توضیحات</label>
                                    <textarea name="description" id="description" class="form-control" cols="30" rows="10">{{old('description') ?: $article->description}}</textarea>
                                </div>
                                <div class="col-12 col-lg-12 form-group">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="is_active" {{$article->published == true ? 'checked' : ''}} name="is_active">
                                        <label class="form-check-label pr-4" for="is_active">فعال باشد</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="col-12 col-lg-4 form-group">
                                <label for="image">
                                    <img id="preview-image-before-upload" src="{{ $article->getImage() }}" style="max-width: 200px" alt="preview image" >
                                    <input type="file" name="image" class="form-control"  id="image">
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-success">ویرایش اطلاعات</button>
                    <a class="btn btn-secondary" href="{{route('panel.articles.index')}}">بازگشت</a>
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
       
    });
     
    </script>
@endsection