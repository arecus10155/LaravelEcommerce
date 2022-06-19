@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="page-wrapper">
    <div class="page-content">

        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">eCommerce</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Update Order</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title">Update Order</h5>
                <hr>
                <div class="form-body mt-4">

                    <form method="post" action="{{ route('updateOrderProcess.orders') }}" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="id" id="inputProductTitle">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="border border-3 p-4 rounded">

                                    <div class="mb-3">
                                        <label for="inputProductTitle" class="form-label">Order ID</label>

                                        <?php
                                        foreach ($orders as $order => $val) {
                                            //echo $val->OrderID;
                                            break;
                                        }
                                                                                    
                                      
                                        ?>
                                        <input type="orderID" name="orderID" class="form-control" id="inputProductTitle" value="{{$val->OrderID}}" readonly>

                                    </div>

                                    <div class="mb-3">
                                        <label for="inputProductTitle" class="form-label">Order Status</label>
                                        <select name="orderStatus" class="form-select" id="inputProductType">
                                            <option disabled selected>Select Status</option>
                                           @foreach ($status as $ss => $s)
                                            <option value="{{ $s }}" {{$val->Status == $s?'selected':''}}> {{ $s }}</option>
                                          @endforeach
                                        </select>
                                    </div>

                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary">Update order</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>
</div>


@endsection