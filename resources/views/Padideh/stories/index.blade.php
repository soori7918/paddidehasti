@extends('admin.layouts.master')

@section('content')
<div class="content p-2">
    <div class="d-flex justify-content-between align-items-center p-2">
        <h3>لیست استوری ها</h3>
        <a class="btn btn-info" href="{{route('panel.stories.create')}}">ایجاد استوری</a>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                @include('components.messages')

                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>تصویر </th>
                            <th>عنوان</th>
                            <th>وضعیت</th>
                            <th>تاریخ ثبت </th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($stories as $key => $story)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>
                                <img src="{{  $story->getImage() }}" width="30px" height="30" class="rounded-circle" alt="">    
                            </td>
                            <td>{{ $story->title }}</td>
                            <td>{!!$story->get_status() !!}</td>
                            <td>{{ $story->getjalaliCreatedAtAttribute()}}</td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <a class="btn btn-info btn-sm" href="{{route('panel.stories.show',$story->id)}}"><i class="ion-ios-eye"></i></a>
                                    <a class="btn btn-success btn-sm" href="{{route('panel.stories.edit',$story->id)}}"><i class="dripicons-document-edit"></i></a>
                                    <form action="{{route('panel.stories.destroy',$story->id)}}" method="post">
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
