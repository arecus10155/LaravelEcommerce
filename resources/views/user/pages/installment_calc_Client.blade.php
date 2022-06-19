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
                            <li class="breadcrumb-item active" aria-current="page">Installment Fee Calculator</li>
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
                                    <div class="mb-3">
                                        <form action="{{ route('installmentCalc.call')}}" method="POST">
                                            @csrf
                                            <label for="price">Price (RM): </label>
                                            <input type="number" id="price" name="price" class="form-control" required autofocus min="1" >
                                            </div>

                                            <div class="mb-3">
                                                <label for="duration">Duration of Pay (month): </label>
                                                <input type="number" id="price" name="duration" class="form-control" min="1" required >
                                            </div>

                                            <div class="mb-3">
                                                <label for="rate">Installment Rate (%): </label>
                                                <input type="number" id="price" name="rate" class="form-control" min="0.1" required step="any" >

                                            </div>

                                            <div class="mb-3">
                                                <label for="budget">Budget (RM): </label>
                                                <input type="number" id="price" name="budget" class="form-control" min="1" required>
                                            </div>


                                            <div class="text-right">
                                                <input type="submit" class="btn btn-primary" value="Calculate">
                                            </div>
                                        </form>
                                    </div>


                                </div>
                            </div>
                            @if(isset($result,$price,$duration,$budget))

                            <div class="col-lg-6 mb-4">
                                <div class="card">
                                    <img class="card-img-top" src="" alt="">

                                    <div class="card-body">
                                        <h5 class="card-title">Results:</h5>
                                        <div style="margin-bottom: 10px;">
                                            <?php
                                            echo "Price: RM " . number_format($price, 2) . "</br>";
                                            echo "Installment Rate: " . number_format($rate, 2) . " % </br>";
                                            echo "Duration of paying(months):  " . $duration . "</br>";
                                            echo "Your Budget: RM " . number_format($budget, 2) . "</br>";
                                            ?>
                                        </div>
                                        <?php
                                        echo "Price per Pay: RM " . number_format($result->pricePerPay, 2) . "</br>";
                                        echo "Total Charge:  RM " . number_format($result->totalCharge, 2) . "</br>";
                                        echo "Difference between budget and price : RM " . number_format($result->differBudget, 2) . "</br></br></br>";
                                        if ($result->differBudget < 0) {
                                            echo "<b style='color:red; font-size:20px;'>Oops!</b><b style='font-size:20px;'> You budget is not enough to pay the installment...</b> </br>";
                                        } else {
                                            echo "<b style='color:green; font-size:20px;'>Great!</b><b style='font-size:20px;'> You have enough budget to pay the installment for your favor!!</b> </br>";
                                        }
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