<nav class="navbar navbar-expand-lg navbar-light bg-light" style="height: 80px; margin-bottom:10px;">
  <div class="container-fluid">
  
    <a class="navbar-brand" href="{{route('all.category')}}" style="margin-left: 50px;"><img src="{{asset('/frontend/assets/images/LmutedLogo.png')}}" style="width: 110px;"/></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <ul class="nav justify-content-end">
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="{{route('productsPage')}}">Products</a>
  </li>
  <li class="nav-item">
  @if(Auth::check())
    <a class="nav-link" href="{{route('CartPage')}}">Cart</a>
    @endif
  </li>
  <li class="nav-item">
    @if(Auth::check())
    <a class="nav-link" href="{{route('my.order')}}">My Order</a>
    @endif
  </li>
  <li class="nav-item">
      @if(Auth::check())
        <a class="nav-link active" aria-current="page" href="{{route('customer.profile')}}">Profile</a>
      @endif
  </li>
  <li class="nav-item">
     @if(Auth::check())
        <a class="nav-link active" aria-current="page" href="{{route('customer.logout')}}">Logout</a>
     @else
        <a class="nav-link active" aria-current="page" href="{{route('login')}}">Login</a>
      @endif
  </li>
</ul>
    
  </div>
</nav>
