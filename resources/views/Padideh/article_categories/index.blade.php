@extends('admin.layouts.master')

@section('content')
<div class="content p-2">
    <div class="d-flex justify-content-between align-items-center p-2">
        <h3>لیست دسته بندی</h3>
        <a class="btn btn-info" href="{{route('panel.article_categories.create')}}">ایجاد دسته بندی</a>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                @include('components.messages')

                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>تصویر</th>
                            <th>نام</th>
                            <th>دسته والد</th>
                            <th>تاریخ ایجاد</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        <ul>
                            @foreach ($article_categories as $key => $article_category)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>
                                        <img src="{{ $article_category->getImage()  }}" width="30px" height="30" class="rounded-circle" alt="">    
                                    </td>
                                    <td>{{$article_category->name ?: '---'}}</td>
                                    <td>{{$article_category->parent ? $article_category->parent->name : '---'}}</td>
                                    <td>{{ $article_category->getjalaliCreatedAtAttribute()}}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <form action="{{route('panel.article_categories.destroy',$article_category->id)}}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" onclick="return confirm('آیا مطمعن هستید؟')" class="btn btn-sm btn-danger"><i class="ion-ios-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </ul>
                    </tbody>
                </table>
               

              

            </div>
        </div>
    </div>
</div>

@endsection
