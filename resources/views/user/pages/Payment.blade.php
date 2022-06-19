<x-app-layout>
    @include('../user/components/home/NavMenu')

    <style>
        body {
            background-color: #eee
        }

        .container {
            height: 100vh
        }

        .card {
            border: none
        }

        .form-control {
            border-bottom: 2px solid #eee !important;
            border: none;
            font-weight: 600
        }

        .form-control:focus {
            color: #495057;
            background-color: #fff;
            border-color: #8bbafe;
            outline: 0;
            box-shadow: none;
            border-radius: 0px;
            border-bottom: 2px solid blue !important
        }

        .inputbox {
            position: relative;
            margin-bottom: 20px;
            width: 100%
        }

        .inputbox span {
            position: absolute;
            top: 7px;
            left: 11px;
            transition: 0.5s
        }

        .inputbox i {
            position: absolute;
            top: 13px;
            right: 8px;
            transition: 0.5s;
            color: #3F51B5
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0
        }

        .inputbox input:focus~span {
            transform: translateX(-0px) translateY(-15px);
            font-size: 12px
        }

        .inputbox input:valid~span {
            transform: translateX(-0px) translateY(-15px);
            font-size: 12px
        }

        .card-blue {
            background-color: #492bc4
        }

        .hightlight {
            background-color: #5737d9;
            padding: 10px;
            border-radius: 10px;
            margin-top: 15px;
            font-size: 14px
        }

        .yellow {
            color: #fdcc49
        }

        .decoration {
            text-decoration: none;
            font-size: 14px
        }

        .btn-success {
            color: #fff;
            background-color: #492bc4;
            border-color: #492bc4
        }

        .btn-success:hover {
            color: #fff;
            background-color: #492bc4;
            border-color: #492bc4
        }

        .decoration:hover {
            text-decoration: none;
            color: #fdcc49
        }
    </style>


    @php
    $productTotal = 0;
    @endphp
    @foreach($cart as $product)

    @php

    $productTotal += ($product['PrtPrice']*$product['PrtQty']);
    @endphp

    @endforeach


    <form method="post" action="{{ route('Place.Order') }}" enctype="multipart/form-data"> 
	 @csrf

     <input type="hidden" name="type" value="Payment" >
     <input type="hidden" name="totalPrice" value="@php echo($productTotal);@endphp" >

    <div class="container mt-5 px-5">
        <div class="mb-4">
            <h2>Confirm order and pay</h2> <span>please make the payment, after that you can enjoy all the features and benefits.</span>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="card p-3">
                    <h6 class="text-uppercase">Payment details</h6>
                    <b>Name on card</b>
                    
                    <div class="inputbox mt-3"> <input type="text" name="name" class="form-control"> 
                    @error('name')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                        <b>Card Number</b>
                        
                            <div class="inputbox mt-3 mr-2"> <input type="text" name="creditNum" class="form-control"> <i class="fa fa-credit-card"></i> 
                            @error('creditNum')
                                <small class="text-danger">{{$message}}</small>
                                @enderror     
                            </div>
                           
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex flex-row">
                            
                                <div class="inputbox mt-3 mr-2"> 
                                <b>Expiry</b>
                                      
                                <input type="text" name="creditExp" class="form-control"> 
                                @error('creditExp')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror  
                                </div>
                                <div class="inputbox mt-3 mr-2"> 
                                <b>CVV</b>  
                                 
                                <input type="text" name="creditCCV" class="form-control"> 
                                @error('creditCCV')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror     
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 mb-4">
                        <h6 class="text-uppercase">Billing Address</h6>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="inputbox mt-3 mr-2"> 
                                    
                                <b>Street Address</b>
                                <input type="text" name="address" class="form-control"> 
                                    @error('address')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                            <b>City</b>
                           
                                <div class="inputbox mt-3 mr-2"> <input type="text" name="city" class="form-control"> 
                                @error('city')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror         
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <div class="inputbox mt-3 mr-2">

                                    <select class="form-select" name="state" style="width:250px;">
                                        <option disabled selected>Choose State</option>
                                        <option value="Johor">Johor</option>
                                        <option value="Kedah">Kedah</option>
                                        <option value="Kelantan">Kelantan</option>
                                        <option value="Kuala Lumpur">Kuala Lumpur</option>
                                        <option value="Labuan">Labuan</option>
                                        <option value="Melaka">Melaka</option>
                                        <option value="Negeri Sembilan">Negeri Sembilan</option>
                                        <option value="Pahang">Pahang</option>
                                        <option value="Penang">Penang</option>
                                        <option value="Perak">Perak</option>
                                        <option value="Perlis">Perlis</option>
                                        <option value="Putrajaya">Putrajaya</option>
                                        <option value="Sabah">Sabah</option>
                                        <option value="Sarawak">Sarawak</option>
                                        <option value="Selangor">Selangor</option>
                                        <option value="Terengganu">Terengganu</option>
                                    </select>
                                    @error('state')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                            <b>Zip code</b>
                                <div class="inputbox mt-3 mr-2"> <input type="text" name="zipCode" class="form-control"> 
                                    @error('zipCode')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-4 mb-4 d-flex justify-content-between"> <a href="{{route('CartPage','abc123')}}">Previous step</a> 
                <input type="submit" class="btn btn-success px-3" value="Pay RM@php echo($productTotal);@endphp"> </div>
            </div>
            <div class="col-md-4">
                <div class="card card-blue p-3 text-white mb-3"> <span>You have to pay</span>
                    <div class="d-flex flex-row align-items-end mb-3">
                        <h1 class="mb-0 yellow">RM@php
                        echo($productTotal);
                        @endphp</h1> <span>.00</span>
                    </div> <span>Enjoy all the features after you complete the payment</span> <span class="yellow decoration">Please Double Confirm All The Info</span>
                    <div class="hightlight"> <span>100% Guaranteed goods will be shipping out between 5 working days.</span> </div>
                </div>
            </div>
        </div>
    </div>

    </form>





    @include('../user/components/home/Footer')

</x-app-layout>