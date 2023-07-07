@extends('admin.layouts.master')

@section('content')

<div class="page-title-box">

    <div class="row align-items-center ">
        <div class="col-md-8">
            <div class="page-title-box">
                <h4 class="page-title">پیشخوان</h4>
                
            </div>
        </div>

        
    </div>
</div>
<!-- end page-title -->

<!-- start top-Contant -->
<div class="row">
    <div class="col-sm-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center p-1">
                    <div class="col-lg-6">
                        <h5 class="font-16">Total Expenses</h5>
                        <h4 class="text-info pt-1 mb-0">$67,670</h4>
                    </div>
                    <div class="col-lg-6">
                        <div id="chart1"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

















