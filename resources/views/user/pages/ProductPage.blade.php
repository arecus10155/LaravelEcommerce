<x-app-layout>
    @include('../user/components/home/NavMenu')


    <div class="container ">
        <div class='section-title text-center mt-5 '>
            <h2>PRODUCTS</h2>

        </div>

        <div class="row mb-5">

            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">

                        <h4>Filters</h4>

                    </div>

                    <div class="card-body">

                        <form method="get" action="{{ route('productsPage') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                            Categories
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">



                                            @php($i = 1)
                                            @foreach($category as $item)

                                            <input type="checkbox" id="category{{$i}}" name="category[]" value="{{ $item->category_name }}">
                                            <label for="category{{$i++}}"> {{ $item->category_name }}</label><br>


                                            @endforeach


                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingThree">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                            Price
                                        </button>
                                    </h2>
                                    <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">

                                            <select name="price" class="form-select">

                                                <option disabled selected>Select Price Range</option>
                                                
                                                <option value="0-999">0-999</option>
                                                <option value="1000-1999">1000-1999</option>
                                                <option value="2000-2999">2000-2999</option>
                                                <option value="3000-10000">>3000</option>
                                                
                                            </select>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" name="submit" value="filter" style="margin-left:10px;" class="btn btn-info">Filter</button>
                            <button type="submit" name="submit" value="clear" class="btn btn-warning">Clear All</button>



                        </form>

                    </div>



                </div>
            </div>

            <div class="col-md-9">
                <div class="row">
                    @foreach($products as $product)
                    <div class="col-md-3">



                        <div class="card">
                            <a href="{{route('ProductDetails',$product->id)}}" style="text-decoration:none; color:black;">
                                <div class="card-header">


                                    <img src="{{$product['image']}}" width="auto">


                                </div>

                                <div class="card-body">




                                    <h5 class="text-center">{{$product['title']}}</h5>
                                    <div  class="text-center">
                                    <span class="badge bg-warning text-dark">RM</span>
                                    <span class="badge bg-dark">{{$product['price']}}</span>
                                    </div>
                                </div>
                            </a>
                        </div>


                    </div>
                    @endforeach
                </div>
                
            </div>
        </div>

    </div>
    <div style="margin-left: 440px;">{{$products->links('vendor.pagination.custom')}}</div>





    <div>
        @include('../user/components/home/Footer')
    </div>
</x-app-layout>