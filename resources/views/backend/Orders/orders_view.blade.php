@extends('admin.admin_master')
@section('admin')

<div class="page-wrapper">
    <div class="page-content">
        <div class="card radius-10">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <h5 class="mb-0">All Orders</h5>
                        <br><br>
                        <a href="{{ route('xml.orders') }}" class="btn btn-info">XML</a>
                        <a href="{{ route('xslt.orders') }}" class="btn btn-info">XSLT</a>
                        <a href="{{ route('downloadXML.orders') }}" class="btn btn-warning">Download XML</a>
                    </div>
                    <div class="font-22 ms-auto"></i>
                    </div>
                </div>
                <hr>
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>No.</th>
                                <th>Order ID</th>
                                <th>Place Date</th>
                                <th>Order Status</th>
                                <th>Last Update At</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($orders as $item)
                            <tr>
                                <td>{{$orders->firstItem()+$loop->index}}</td>
                                <td>{{$item->OrderID}}</td>
                                <td>{{$item->DateTime}}</td>
                                @if($item->Status == "TOSHIP")
                                    <td><span style="color: red; font-weight:bold;">{{$item->Status}}</span></td>
                                @elseif($item->Status == "TORECEIVE")
                                    <td><span style="color: orange; font-weight:bold;">{{$item->Status}}</span></td>
                                @elseif($item->Status == "RECEIVED")
                                    <td><span style="color: green; font-weight:bold;">{{$item->Status}}</span></td>
                                @endif

                                @if($item->updated_at != NULL)
                                    <td>{{$item->updated_at}}</td>
                                @else
                                    <td><a>-</a></td>
                                @endif

                                <td>
                                    <a href="{{route('update.orders',$item->OrderID)}}" class="btn btn-info">Update</a>
                                    <a href="{{route('Receipt.Admin',$item->OrderID)}}" class="btn btn-primary">View Details</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{$orders->links('vendor.pagination.custom')}}
    </div>
</div>

@endsection