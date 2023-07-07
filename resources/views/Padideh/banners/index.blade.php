@extends('admin.layouts.master')

@section('content')
<div class="content p-2">
    <div class="d-flex justify-content-between align-items-center p-2">
        <h3>لیست بنرها</h3>
        <a class="btn btn-info" href="{{route('panel.banners.create')}}">ایجاد بنر</a>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                @include('components.messages')

                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>آیکن</th>
                            <th>تصویر اصلی</th>
                            <th>عنوان</th>
                            <th>لینک</th>
                            <th>وضعیت</th>
                            <th>تاریخ ثبت </th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($banners as $key => $banner)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>
                                <img src="{{ $banner->getImage()  }}" width="30px" height="30" class="rounded-circle" alt="">    
                            </td>
                            <td>
                                <img src="{{ $banner->getImageCover() }}" width="30px" height="30" class="rounded-circle" alt="">    
                            </td>
                            <td>{{ $banner->title }}</td>
                            <td>{{ $banner->link }}</td>
                            <td>{!!$banner->get_status() !!}</td>
                            <td>{{ $banner->getjalaliCreatedAtAttribute()}}</td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <a class="btn btn-info btn-sm" href="{{route('panel.banners.show',$banner->id)}}"><i class="ion-ios-eye"></i></a>
                                    <a class="btn btn-success btn-sm" href="{{route('panel.banners.edit',$banner->id)}}"><i class="dripicons-document-edit"></i></a>
                                    <form action="{{route('panel.banners.destroy',$banner->id)}}" method="post">
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
