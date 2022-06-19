<x-app-layout>
    @include('../user/components/home/NavMenu')
    
    
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                &nbsp;&nbsp;&nbsp;&nbsp;<div class="breadcrumb-title pe-3">Customer</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Customer Profile</li>
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
                                        @if($customerData->profile_photo_path != null)
                                        <img src="/storage/{{$customerData->profile_photo_path}}" alt="Customer" class="rounded-circle p-1 bg-primary" width="110">
                                        @else
                                        <img src="{{asset('backend/assets/images/avatars/mystery.jpg')}}" alt="Customer" class="rounded-circle p-1 bg-primary" width="110">
                                        @endif
                                        <div class="mt-3">
                                            <h4>{{$customerData->name}}</h4>
                                            <p class="text-secondary mb-1">{{$customerData->email}}</p>

                                            <button class="btn btn-primary" onclick="window.location ='{{ route("profile.show") }}'">Edit Profile</button>
                                        
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-5">
                            <div class="row-lg mb-4" style="width: 300px;" >
                                <div class="card">
                                    <div class="card-body" style="text-align: center;">
                                        <h5 class="card-title">Installment Fee Calculator</h5>

                                        <button class="btn btn-primary" onclick="window.location ='{{ route("customer.installmentCalc") }}'">Click Me !</button>
                                    </div>
                                </div>
                            </div>

                            <br>

                            <div class="row-lg mt-2" style="width: 300px;" >
                                <div class="card">
                                    <div class="card-body" style="text-align: center;">
                                        <h5 class="card-title">Shipping Fee Calculator</h5>

                                        <button class="btn btn-primary" onclick="window.location ='{{ route("customer.shippingFeeCalc") }}'">Click Me !</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>