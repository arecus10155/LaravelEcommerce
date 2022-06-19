@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="page-wrapper">
			<div class="page-content">

				<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
	<div class="breadcrumb-title pe-3">eCommerce</div>
	<div class="ps-3">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb mb-0 p-0">
				<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
				</li>
				<li class="breadcrumb-item active" aria-current="page">Edit Product</li>
			</ol>
		</nav>
	</div>
	 
</div>
<!--end breadcrumb-->

<div class="card">
  <div class="card-body p-4">
	  <h5 class="card-title">Edit Product</h5>
	  <hr>
       <div class="form-body mt-4">

<form method="post" action="{{ route('update.product') }}" enctype="multipart/form-data"> 
	 @csrf

	 <input type="hidden" name="type" value="EditProduct" >

	 <input type="hidden" name="id" id="inputProductTitle" value="{{ $product->id }}">
	    <div class="row">
		   <div class="col-lg-8">
           <div class="border border-3 p-4 rounded">

			<div class="mb-3">
				<label for="inputProductTitle" class="form-label">Product Title</label>
				<input type="text" name="title" class="form-control" id="inputProductTitle" value="{{$product->title}}">
				@error('title')
             <span class="text-danger">{{$message}}</span>
          @enderror
			</div>

			  <div class="mb-3">
				<label for="inputProductTitle" class="form-label">Product Code</label>
				<input type="text" name="product_code" class="form-control" id="inputProductTitle" value="{{$product->product_code}}">
				@error('product_code')
             <span class="text-danger">{{$message}}</span>
          @enderror  
			</div>



<div class="mb-3">
 <label for="formFile" class="form-label">Product Image </label>
	 <input class="form-control" name="image"  type="file" id="image">
	 @error('image')
             <span class="text-danger">{{$message}}</span>
          @enderror
	 </div>

     <input type="hidden" name="imageOld"  value="{{ asset($product->image) }}">
	 <div class="mb-3">
	 	<img id="showImage" src="{{ asset($product->image)}}"   style="width:100px; height: 100px;" > 
	 </div>
	 






	 
@foreach($details as $item)
  <div class="mb-3">
	<label for="inputProductDescription" class="form-label">Short Description</label>
	<textarea name="short_description" class="form-control" id="inputProductDescription" rows="3">{{$item->short_description}}</textarea>
  </div>


 <div class="mb-3">
	<label for="inputProductDescription" class="form-label">Long Description</label>
	<textarea id="mytextarea" name="long_description">{{$item->long_description}}</textarea>
  </div>
 
		 
    </div>
</div>
@endforeach




<div class="col-lg-4">
<div class="border border-3 p-4 rounded">
  <div class="row g-3">
	<div class="col-md-12">
		<label for="inputPrice" class="form-label">Product Price</label>
		<input type="text" name="price" class="form-control" id="inputPrice" value="{{$product->price}}">
		@error('price')
             <span class="text-danger">{{$message}}</span>
          @enderror
	</div>


	

 
	  <div class="col-12">
		<label for="inputProductType" class="form-label">Product Category</label>
		<select name="category" class="form-select" id="inputProductType">
			 
	   <option disabled selected>Select Category</option>
		@foreach($category as $item)
		<option value="{{ $item->category_name }}" {{$item->category_name == $product->category?'selected':''}}> {{ $item->category_name }}</option>
	 	@endforeach
		  </select>
		  @error('category')
             <span class="text-danger">{{$message}}</span>
          @enderror
	  </div>


	  <div class="col-12">
		<label for="inputProductType" class="form-label">Product Color</label>
		<select name="color" class="form-select" id="inputProductType">
			 
	   <option disabled selected>Select Color</option>
	   @foreach($details as $item)
		<option value="White" {{$item->color == 'White' ? 'selected':''}}> White</option>
		<option value="Black" {{$item->color == 'Black' ? 'selected':''}}> Black</option>
		<option value="Grey" {{$item->color == 'Grey' ? 'selected':''}}> Grey</option>
		<option value="Blue" {{$item->color == 'Blue' ? 'selected':''}}> Blue</option>
		@endforeach
		  </select>
		  @error('color')
             <span class="text-danger">{{$message}}</span>
          @enderror
	  </div>



	 

@foreach($details as $item)
<div class="col-md-12">
		<label for="inputQty" class="form-label">Product Quantity</label>
		<input type="text" name="quantity" class="form-control" id="inputQty" value="{{$item->quantity}}">
		@error('quantity')
             <span class="text-danger">{{$message}}</span>
          @enderror
</div>
@endforeach




<div class="form-check">



	  <div class="col-12">
		  <div class="d-grid">
             <button type="submit" class="btn btn-primary">Update Product</button>
		  </div>
	  </div>
  </div> 
		  </div>
		  </div>
					   </div><!--end row-->


					</form>


					</div>
				  </div>
			  </div>

			</div>
		</div>
 
		<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
		<script>
			
	const inputColors = document.getElementsByName('quantity').value;
	console.log(inputColors)
	const inputQty = document.getElementById('inputQty').value;
	const arrayColors = inputColors.split(",");
	const arrayQty = inputQty.split(",");

	console.log(inputColors)
	console.log(arrayQty)
	

	form.addEventListener('submit',(e)=>{

		if(arrayColors.length != arrayQty.length){
		
			e.preventDefault()
			toastr.error("", "Variations and Quantity must be same ", {
					iconClass: "toast-custom-error"
			});
		}
         
	})


	
	</script> -->


<script type="text/javascript">
	$(document).ready(function(){
		$('#image').change(function(e){
			var reader = new FileReader();
			reader.onload = function(e){
				$('#showImage').attr('src',e.target.result);
			}
			reader.readAsDataURL(e.target.files['0']);

		});
	});	
</script>


<script src='https://cdn.tiny.cloud/1/vdqx2klew412up5bcbpwivg1th6nrh3murc6maz8bukgos4v/tinymce/5/tinymce.min.js' referrerpolicy="origin">
	</script>
	<script>
		tinymce.init({
		  selector: '#mytextarea'
		});
	</script>

	




@endsection