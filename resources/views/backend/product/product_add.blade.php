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
				<li class="breadcrumb-item active" aria-current="page">Add New Product</li>
			</ol>
		</nav>
	</div>
	 
</div>
<!--end breadcrumb-->

<div class="card">
  <div class="card-body p-4">
	  <h5 class="card-title">Add New Product</h5>
	  <hr>
       <div class="form-body mt-4">

<form method="post" action="{{ route('product.store') }}" enctype="multipart/form-data"> 
	 @csrf


	 <input type="hidden" name="type" value="StoreProduct" >


	    <div class="row">
		   <div class="col-lg-8">
           <div class="border border-3 p-4 rounded">

			<div class="mb-3">
				<label for="inputProductTitle" class="form-label">Product Title</label>
				<input type="text" name="title" class="form-control" id="inputProductTitle" placeholder="Enter product title">
				@error('title')
             <span class="text-danger">{{$message}}</span>
          @enderror
			</div>

			  <div class="mb-3">
				<label for="inputProductTitle" class="form-label">Product Code</label>
				<input type="text" name="product_code" class="form-control" id="inputProductTitle" placeholder="Enter product title">
				@error('product_code')
             <span class="text-danger">{{$message}}</span>
          @enderror  
			</div>



<div class="mb-3">
 <label for="formFile" class="form-label">Product Image </label>
	 <input class="form-control" name="image" type="file" id="image">
	 @error('image')
             <span class="text-danger">{{$message}}</span>
          @enderror
	 </div>


	 <div class="mb-3">
	 	<img id="showImage" src="{{ asset('/backend/assets/images/No_Image_Available.png')   }}" style="width:100px; height: 100px;" > 
	 </div>
	 






	 

  <div class="mb-3">
	<label for="inputProductDescription" class="form-label">Short Description</label>
	<textarea name="short_description" class="form-control" id="inputProductDescription" rows="3"></textarea>
  </div>


 <div class="mb-3">
	<label for="inputProductDescription" class="form-label">Long Description</label>
	<textarea id="mytextarea" name="long_description">Hello, World!</textarea>
  </div>
 
		 
    </div>
</div>




<div class="col-lg-4">
<div class="border border-3 p-4 rounded">
  <div class="row g-3">
	<div class="col-12">
		<label for="inputPrice" class="form-label">Product Price</label>
		<input type="text" name="price" class="form-control" id="inputPrice" placeholder="00">
		@error('price')
             <span class="text-danger">{{$message}}</span>
          @enderror
	</div>


	

 
	  <div class="col-12">
		<label for="inputProductType" class="form-label">Product Category</label>
		<select name="category" class="form-select" id="inputProductType">
			 
	   <option disabled selected>Select Category</option>
		@foreach($category as $item)
		<option value="{{ $item->category_name }}"> {{ $item->category_name }}</option>
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
		<option value="White"> White</option>
		<option value="Black"> Black</option>
		<option value="Grey" > Grey</option>
		<option value="Blue" > Blue</option>
	
		  </select>
		  @error('color')
             <span class="text-danger">{{$message}}</span>
          @enderror
	  </div>

	  <div class="col-md-12">
		<label for="inputQty" class="form-label">Product Quantity</label>
		<input type="text" name="quantity" class="form-control" id="inputQty" placeholder="Product Quantity">
		@error('quantity')
             <span class="text-danger">{{$message}}</span>
          @enderror
     </div>


<div class="form-check">



	  <div class="col-12">
		  <div class="d-grid">
             <button type="submit" class="btn btn-primary">Save Product</button>
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