<!--  Author: Loh Wei Sheng -->
@extends('admin.admin_master')
@section('admin')

<div class="page-wrapper">
    <div class="page-content">

        <div class="card radius-10">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <h5 class="mb-0">Customer List</h5>
                        <br><br>
                       
                       <a href="{{ route("custXML") }}" class="btn btn-info">XML</a> 
                        <a href="{{ route('downloadXML.customerList') }}" class="btn btn-warning">Download XML</a>

                    </div>


                </div>

                <div class="table-responsive">
                    
                    {!!$data['new_xml_doc']!!}

                </div>
                <hr>
            </div>

        </div>


    </div>

</div>
@endsection 