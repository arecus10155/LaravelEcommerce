<!-- Author: Loh Wei Sheng -->
@extends('admin.admin_master')
@section('admin')

<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">User Profile</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">User Profile</li>
                    </ol>
                </nav>
            </div>






        </div>



        <!--end breadcrumb-->
        <div class="container">
            <div class="main-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">

                                    @if($adminData->profile_photo_path != null)
                                    <img src="/storage/{{$adminData->profile_photo_path}}" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
                                    @else
                                    <img src="{{asset('backend/assets/images/avatars/mystery.jpg')}}" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
                                    @endif 
                                    <div class="mt-3">
                                        <h4>{{$adminData->name}}</h4>
                                        <p class="text-secondary mb-1">{{$adminData->email}}</p>

                                        <button class="btn btn-primary" onclick="window.location ='{{ route("profile.show") }}'">Edit Profile</button>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>












@endsection