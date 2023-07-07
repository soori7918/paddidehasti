@extends('admin.layouts.master')

@section('content')
<div class="content p-2">
    <div class="d-flex justify-content-between align-items-center p-2">
        <h3>لیست مقالات</h3>
        <a class="btn btn-info" href="{{route('panel.articles.create')}}">ایجاد مقاله</a>
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
                            <th>عنوان</th>
                            <th>دسته بندی</th>
                            <th>وضعیت</th>
                            <th>تاریخ ثبت </th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($articles as $key => $article)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>
                                <img src="{{  $article->getImage()  }}" width="30px" height="30" class="rounded-circle" alt="">    
                            </td>
                            <td>{{$article->title ?: '---'}}</td>
                            <td>
                                {!!$article->get_category()!!}
                            </td>
                            <td>{!!$article->get_status() !!}</td>
                            <td>{{ $article->getjalaliCreatedAtAttribute()}}</td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <a class="btn btn-info btn-sm" href="{{route('panel.articles.show',$article->id)}}"><i class="ion-ios-eye"></i></a>
                                    <a class="btn btn-success btn-sm" href="{{route('panel.articles.edit',$article->id)}}"><i class="dripicons-document-edit"></i></a>
                                    <form action="{{route('panel.articles.destroy',$article->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" onclick="return confirm('آیا مطمعن هستید؟')" class="btn btn-sm btn-danger"><i class="ion-ios-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        @endforeach
                
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
