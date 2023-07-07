@extends('admin.layouts.master')

@section('content')
<div class="content p-2">
    <div class="d-flex justify-content-between align-items-center p-2">
        <strong class="font-weight-bold" style="font-size:20px">مشاهده سفارش ها </strong>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card p-2 shadow-sm">
               <div class="row">
                   <div class="col-12 ">
                       <div class="justify-content-center align-items-center d-flex">
                           <table class="table table-bordered ">
                               <thead>
                                   <th>ردیف</th>
                                   <th>نام و نام خانوادگی</th>
                                   <th>کد سفارش</th>
                                   <th>آدرس</th>
                                   <th>ادمین</th>
                                   <th>راننده</th>
                                   <th>وضعیت</th>
                                   <th>تاریخ دریافت</th>
                                   <th></th>
                               </thead>
                               <tbody>
                                   @foreach ($orders as $key=>$order)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>
                                                {{$order->getUserInfo()}}
                                            </td>
                                            <td >
                                                <span >
                                                    {{$order->code}}
                                                </span>

                                            </td>
                                            <td>{{$order->address->title}}</td>
                                            <td>{{$order->admin ? $order->admin->name : '---'}}</td>
                                            <td>
                                                {{ $order->get_driver_info() }}
                                            </td>
                                            <td data-status="{{$order->status_id}}">{{$order->status ? $order->status->title : '---'}}</td>
                                            <td>{{getjalaliDate($order->delivery_date)}}</td>
                                            <td>
                                                <a href="{{route('panel.orders.show',$order->id)}}" class="btn btn-success btn-sm" target="_blank" rel="noopener noreferrer"><i class="ion-ios-eye"></i></a>
                                                <a href="{{route('panel.orders.edit',$order->id)}}" class="btn btn-primary btn-sm" ><i class="dripicons-document-edit"></i></a>
                                                <button type="button"
                                                    data-id={{$order->id}}
                                                    data-code="{{$order->code}}"
                                                    data-update="{{route('panel.orders.changeStatus',$order->id)}}"
                                                    class="btn btn-warning btn-sm btn-cancel" data-toggle="modal" data-target="#exampleModal">
                                                    لغو سفارش
                                                </button>
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
          <h5 class="modal-title" id="exampleModalLabel">
              کد سفارش : <span class="code" id="code"></span>
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body ">
          <form action="" class="modal-form" name="change_status" method="post">
              @method('patch')
              @csrf
                <div class="col-12 col-lg-12 form-group">
                    <label for="status_id">وضعیت</label>
                    <select name="status_id" id="status_id" class="form-control">
                        @foreach ($statuses as $status)
                            <option value="{{$status->id}}">{{$status->title}}</option>
                        @endforeach
                    </select>
                </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">لغو</button>
          <button type="submit" class="btn btn-primary">به روز رسانی</button>
        </div>

    </form>

      </div>
    </div>
  </div>


@endsection


@section('scripts')
    <script>
        $('body').on('click','.btn-cancel',function(){
            let code = $(this).data("code");
            let route = $(this).data("update");
            $("#code").text(code);
            $(".modal-form").attr("action", route)


        })



    </script>
@endsection
