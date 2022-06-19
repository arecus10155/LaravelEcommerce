<x-app-layout>
    @include('../user/components/home/NavMenu')
    @include('../user/components/home/HomeSlider')

    <div class="container pb-5">
    <div class='section-title text-center mt-5 '>
        <h2>CATEGORIES</h2>
        <p>Some Of Our Exclusive Collection, You May Like</p>
    </div>
    
    <div class="row mb-5">
    
    @foreach($categories as $category) 
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-6 mt-5">
        
        
      
        <div class="card" >
        <a  href="{{route('ProductListByCategory',$category->category_name)}}" style="text-decoration:none; color:black;">
        <div class="card-header">
        
        @foreach($products as $product) 
            @if($product['category'] == $category['category_name'])

            <img src="{{$product['image']}}" width="auto">
            @break
            @endif
            @endforeach
    
      </div>

            <div class="card-body">
           

           

                <h5 class="text-center">{{$category['category_name']}}</h5>
               
                
          </div>
          </a>
       </div>
        
        
    </div>
    @endforeach       
    </div>
     
</div>

<div >
@include('../user/components/home/Footer')
</div>
</x-app-layout>