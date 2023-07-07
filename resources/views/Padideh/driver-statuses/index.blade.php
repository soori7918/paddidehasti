@extends('admin.layouts.master')

@section('content')
<div class="content p-2">
    <div class="d-flex justify-content-between align-items-center p-2">
        <strong class="font-weight-bold" style="font-size:20px">مشاهده وضعیت ها </strong>
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
            ایجاد وضعیت جدید
        </button>

    </div>
    <div class="row">
        <div class="col-12">
            <div class="card p-2 shadow-sm">
               <div class="row">
                   <div class="col-12 ">
                       <div class="justify-content-center align-items-center d-flex">
                           <table class="table table-bordered ">
                               <thead>
                                   <th>#</th>
                                   <th>عنوان </th>
                                   <th>مرحله</th>
                                   <th>توضیحات</th>
                                   <th></th>
                               </thead>
                               <tbody>
                                   @foreach ($driverStatuses as $key=>$status)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$status->title}}</td>
                                            <td>{{$status->step}}</td>
                                            <td>{{$status->description }}</td>
                                            <td>
                                                <form action="{{route('panel.drivers.statuses.destroy',$status->id)}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('آیا مایل به حذف هستید؟')" ><i class="ion-ios-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                   @endforeach
                               </tbody>
                           </table>
                       </div>
                   </div>
               </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">ثبت وضعیت جدید</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{route('panel.drivers.statuses.store')}}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12 col-lg-6 form-group">
                                <label for="title">عنوان</label>
                                <input type="text" name="title" class="form-control" value="{{old('title')}}" id="title">
                            </div>
                           
                            <div class="col-12 col-lg-6 form-group">
                                <label for="step">مرحله</label>
                                <input type="step" name="step" class="form-control"  value="{{old('step')}}" id="step">
                            </div>
                            <div class="col-12 col-lg-12 form-group">
                                <label for="description">توضیحات</label>
                                <textarea name="description" id="description" class="form-control" cols="30" rows="5"></textarea>
                            </div>
                            
                        </div>
                    </div>
                   

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">ثبت</button>
            </div>
        </form>
      </div>
    </div>
  </div>




@endsection
