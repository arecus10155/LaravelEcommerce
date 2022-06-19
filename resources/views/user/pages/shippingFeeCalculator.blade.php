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
                            <li class="breadcrumb-item active" aria-current="page">Shipping Fee Calculator</li>
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
                                    <form action="{{ route('shippingFeeCalc.call')}}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <select class="form-select" name="from" style="width:250px;" required>
                                                <option disabled selected>FROM</option>
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
                                        </div>

                                        <div class="mb-3">
                                            <select class="form-select" name="to" style="width:250px;" required>
                                                <option disabled selected>TO</option>
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
                                        </div>

                                        <div class="mb-3">
                                            <input type="number" name="weight" step="any" placeholder="WEIGHT" />
                                        </div>

                                        <div class="text-right">
                                            <input type="submit" class="btn btn-primary" value="Calculate">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        @if(isset($result,$from,$to,$weight))

                        <div class="col-lg-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Results:</h5>
                                    
                                        <?php
                                            echo '<b style="color:blue;">'.$from.'</b>';

                                            echo' > ';
                                            echo '<b style="color:green;">'.$to.'</b>';

                                            echo '<br><br><b>WEIGHT Fee:</b> RM '. number_format($result->weightPrice, 2). '<br>';
                                            echo '<b>DISTANCE Rate:</b> '. number_format($result->distanceRate, 1). '<br>';
                                            echo '<b>TOTAL SHIPPING FEE :</b> RM '. number_format($result->total, 2). '<br>';
                                        ?>

                                </div>
                            </div>
                        </div>

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


</x-app-layout>