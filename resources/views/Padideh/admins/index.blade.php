@extends('admin.layouts.master')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/jquery.dataTables.css')}}">
    <link href="{{asset('admin/plugins/bootstrap-sweetalert/sweet-alert.css')}}" rel="stylesheet" type="text/css" />

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" /> --}}
@endsection

@section('scripts')
    <script src="{{asset('admin/plugins/bootstrap-sweetalert/sweet-alert.min.js')}}"></script>
    <script src="{{asset('admin/pages/jquery.sweet-alert.init.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    {{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}

    <script>
        var get_admins_table = "{{ route('panel.admins.get_admins.table') }}";
        var editAdminRoute = "{{ route('panel.admins.index') }}";
        var ajax_delete_url = "{{ url('/panel/admins/') }}";
        var ajax_token = "{{ csrf_token() }}";
    </script>
    <script src="{{asset('js/pages/admins.js')}}"></script>
    <script src="{{asset('admin/js/delete.js')}}"></script>

@endsection
@section('content')
    <div class="content p-2">
        <div class="d-flex justify-content-between align-items-center p-2">
            <h3>لیست مدیران</h3>
            <a class="btn btn-info" href="{{route('panel.admins.create')}}">ایجاد ادمین</a>
        </div>

        <div class="row bg-white rounded-sm shadow-sm">
            <div class="col-12 p-4">
                <div class="bgc-white bd bdrs-3 mB-20">
                    <form id="search_form" action="#" method="POST" class="form-horizontal">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" id="search_like" name="search_like" placeholder="جستجو" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <button type="submit" name="submit" class="btn btn-success btn-block">
                                        <i class="fa fa-btn fa-search"></i> جستجو
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-12  mt-20">
                @include('components.messages')
                {{-- <div class="table-responsive"> --}}
                    <table id="admins_table" class="table table-hover" >
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>نام</th>
                                <th>نام خانوادگی</th>
                                <th>شماره تماس</th>
                                <th>ایمیل</th>
                                <th>وضعیت</th>
                                <th>تاریخ ثبت نام</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table> 
                {{-- </div> --}}
                @csrf           
            </div>     
        </div>
        
    </div>
@endsection

