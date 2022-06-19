@extends('admin.admin_master')
@section('admin')

<div class="page-wrapper">
    <div class="page-content">

        <div class="card radius-10">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <h5 class="mb-0">All Product</h5>
                        <br><br>
                        <!-- <a href="{{ asset('product.xml') }}" class="btn btn-info">XML</a> -->
                        <a href="{{ route('xml.product') }}" class="btn btn-info">XML</a>
                        <a href="{{ route('xslt.product') }}" class="btn btn-info">XSLT</a>
                        <a href="{{ route('downloadXML.product') }}" class="btn btn-warning">Download XML</a>
                    </div>

                    <div class="font-22 ms-auto"><i class="bx bx-dots-horizontal-rounded"></i>
                    </div>
                </div>
                <hr>
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>No.</th>
                                <th>Product Image</th>
                                <th>Product Name</th>
                                <th>Product Category</th>
                                <th>Product Color</th>
                                <th>Product Quantity</th>
                                <th>Product Code</th>
                                <th>Action</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            @php
                            $i = $products->firstItem();
                            @endphp

                            @foreach($products as $item)

                            <tr>
                                <td>{{$products->firstItem()+$loop->index}}</td>

                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="recent-product-img">
                                            <img src="{{$item->image}}">
                                        </div>
                                    </div>
                                </td>

                                <td>{{$item->title}}</td>
                                <td>{{$item->category}}</td>
                                <td>{{$productDetails[($i-1)]->color}}</td>
                                <td>{{$productDetails[($i-1)]->quantity}}</td>
                                <td>{{$item->product_code}}</td>
                                <td>
                                    <a href="{{route('edit.product',$item->id)}}" class="btn btn-info">Edit</a>
                                    <a href="{{route('delete.product',$item->id)}}" id="delete" class="btn btn-danger">Delete</a>
                                </td>


                            </tr>

                            @php
                            $i++;
                            @endphp
                            @endforeach

                        </tbody>

                    </table>


                </div>

            </div>

        </div>
        <div>{{$products->links('vendor.pagination.custom')}}</div>

    </div>

</div>












@endsection