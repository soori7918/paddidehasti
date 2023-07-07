@extends('admin.layouts.master')

@section('content')
<div class="content p-2">
    <div class="d-flex justify-content-between align-items-center p-2">
        <h3>لیست دسته بندی</h3>
        <a class="btn btn-info" href="{{route('panel.product_categories.create')}}">ایجاد دسته بندی</a>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                @include('components.messages')

                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>نام</th>
                            <th>دسته والد</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($product_categories as $key => $product_category)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$product_category->name ?: '---'}}</td>
                            <td>{{$product_category->parent_id ?: '---'}}</td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <form action="{{route('panel.product_categories.destroy',$product_category->id)}}" method="post">
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
