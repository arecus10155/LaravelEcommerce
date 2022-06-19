<x-app-layout>
    @include('../user/components/home/NavMenu')

    <style>
        body {
            background: #ffc107;
            font-family: Arial, Helvetica, sans-serif
        }

        .abc {
            padding-left: 40px
        }

        .pqr {
            padding-right: 70px;
            padding-top: 14px
        }

        .para {
            float: right;
            margin-right: 0;
            padding-left: 80%;
            top: 0
        }

        .fa-star {
            color: yellow
        }

        li {
            list-style: none;
            line-height: 50px;
            color: #000
        }

        .col-md-2 {
            padding-bottom: 20px;
            font-weight: bold
        }

        .col-md-2 a {
            text-decoration: none;
            color: #000
        }

        .col-md-2.mio {
            font-size: 12px;
            padding-top: 7px
        }

        .des::after {
            content: '.';
            font-size: 0;
            display: block;
            border-radius: 20px;
            height: 6px;
            width: 55%;
            background: yellow;
            margin: 14px 0
        }

        .r4 {
            padding-left: 25px
        }

        .btn-outline-warning {
            border-radius: 0;
            border: 2px solid yellow;
            color: #000;
            font-size: 12px;
            font-weight: bold;
            width: 70%
        }

        @media screen and (max-width: 620px) {
            .container {
                width: 98%;
                display: flex;
                flex-flow: column;
                text-align: center
            }

            .des::after {
                content: '.';
                font-size: 0;
                display: block;
                border-radius: 20px;
                height: 6px;
                width: 35%;
                background: yellow;
                margin: 10px auto
            }

            .pqr {
                text-align: center;
                margin: 0 30px
            }

            .para {
                text-align: center;
                padding-left: 90px;
                padding-top: 10px
            }

            .klo {
                display: flex;
                text-align: center;
                margin: 0 auto;
                margin-right: 40px
            }
        }
    </style>

    <form method="post" action="{{route('addToCart')}}" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="type" value="AddtoCart">
        @foreach($productDetails as $productDetail)
        @foreach($productList as $product)
        <div class="container py-4 my-4 mx-auto d-flex flex-column" style="background: #fff !important;border: none;border-radius: none">
            <div class="header">
                <div class="row r1">
                    <div class="col-md-9 abc">

                        <h1>{{$product['title']}}</h1>

                    </div>
                </div>
            </div>


            <input type="hidden" name="prtID" value="{{$product['id']}}">



            <div class="container-body mt-4" style="background: #fff !important;border: none;border-radius: none">
                <div class="row ">
                    <div class="col-md-5"> <img src="{{$productDetail['image_one']}}" width="auto"> </div>
                    <div class="col-md-7 px-5">
                        {!!nl2br($productDetail['short_description'])!!}
                        <br><br><br>
                        Color : {{$productDetail['color']}}


                        <br><br><br>


    @php
    if(Auth::check() == null){
      @endphp

                
      
        <span class="badge bg-danger">Please Login</span>
  
    @php
    }else{
    @endphp
                        @if($productDetail['quantity'] > 0)

                        Choose Quantity :
                        <select class="form-select" name="qty" style="width:250px;">
                            <option disabled selected>Choose Quantity</option>
                            <option value="1">01</option>
                            <option value="2">02</option>
                            <option value="3">03</option>
                            <option value="4">04</option>
                            <option value="5">05</option>
                            <option value="6">06</option>
                            <option value="7">07</option>
                            <option value="8">08</option>
                            <option value="9">09</option>
                            <option value="10">10</option>
                        </select>

                        @error('qty')
                        <small class="text-danger">{{$message}}</small>
                        @enderror


                        <br> <br> <br>

                        <input type="submit" class="btn btn-outline-warning" style="width:260px;" value="ADD TO CART" />
                        @else
                        <span class="badge bg-danger">Out Of Stock</span>
                        @endif
                        @php
    }
    @endphp
                    </div>

                </div>

            </div>
   
    </form>

    </div>


    <div class="container">

        <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        Description
                    </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">{{$productDetail['long_description']}}</div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                        Review
                    </button>
                </h2>
                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <h3>Always believe that good things are about to happen</h3>
                        <p>
                            Xiaomi Corporation was established in 2010. Officially established in 2010, it is an official electronic and smart electronic product and smart phone with smartphones, smart hardware and the Internet of Things as the core. Xiaomi Corporation only needs 4 years to break through the company. production platform. In 2018, Xiaomi's business spread to more than 80 countries and regions around the world.

                            Xiaomi's mission is to continue to make "moving and affordable products, so that everyone in the world can enjoy the beautiful life brought by technology".
                        </p>


                    </div>
                </div>
            </div>

        </div>

    </div>

    @endforeach
    @endforeach
    @include('../user/components/home/Footer')

</x-app-layout>