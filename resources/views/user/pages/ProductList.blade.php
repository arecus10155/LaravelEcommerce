<x-app-layout>
    @include('../user/components/home/NavMenu')


    <div class="container pb-5">
        <div class='section-title text-center mt-5 '>
            <h2>Products</h2>
        </div>

        <div class="row mb-5">
            @foreach($productList as $product)
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-6 mt-5" style="text-decoration: none;">
                <a href="{{route('ProductDetails',$product->id)}}" style="text-decoration: none;">
                <div class="card text-center">
                    <div class="card-header">
                    <img src="{{$product['image']}}"/>
                    </div>
                    <div class="card-body" >
                        
                        <p class="card-text" style="color:black;">{{$product['title']}}</p>
                     
                    </div>
                    
                </div>
                </a>

            </div>
            @endforeach
        </div>

        </Container>


        @include('../user/components/home/Footer')

</x-app-layout>