@extends('layouts.layout')

@section('content')
<div class="container">
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100 h-100" src="/storage/images/products/sample 1.jpg" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="/storage/images/products/sample2.jpg" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="/storage/images/products/sample 3.jpg" alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</div>

<h1 class="text-center">{{ __('All Products') }}</h1>
<div class="container d-flex justify-content-center mt-50 mb-50">
            
        <div class="row">
           <div class="col-6">
           		<div class="dropdown">
				  <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    Sort By:
				  </button>
				  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
				    <a href="{{URL :: current() }}" class="sort-font dropdown-item">All</a>
	           		<a href="{{ URL :: current(). "?sort=price_asc"}}" class="sort-font dropdown-item">Price - Low to High</a>
	           		<a href="{{ URL :: current(). "?sort=price_desc"}}" class="sort-font dropdown-item">Price- High to Low</a>
	           		<a href="{{ URL :: current(). "?sort=newest"}}" class="sort-font dropdown-item">Newest</a>
	           		
				  </div>
				</div>
           </div>
           <div class="col-6 ">
           	<div class="d-flex justify-content-end ">
           		<div class="dropdown align-self-end">
				  <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    Filters:
				  </button>
				  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
				    <a href="{{ URL :: current(). "?filter=catagory_1"}}" class="sort-font dropdown-item">Internal</a>
	           		<a href="{{ URL :: current(). "?filter=catagory_2"}}" class="sort-font dropdown-item">External</a>
	           		<a href="{{ URL :: current(). "?filter=catagory_3"}}" class="sort-font dropdown-item">Accessories</a>
	           	</div>
	           </div>
           	</div>
           		
	       </div>
         <?php if($products->isEmpty())
         {?>
          No products
         <?php }else{
          $countP = 0;
         }?>
				@foreach($products as $products)
				<div class="col-6 col-md-4 col-lg-3  mt-2 mb-2">
                <div class="card">
                  <input type="hidden" id="pro_id<?php echo $countP;?>" value="{{$products->id}}">
                                    <div class="card-body">
                                        <div class="card-img-actions">
                                        	<a href= "details/{{$products->id}}">
                                        		<img src="{{ asset('storage/images/products/'.$products->image) }}" class="card-img " width="96" height="350" alt="">
                                        	</a>
                                        </div>
                                    </div>
                                    <div class="card-body bg-light text-center">
                                        <div class="mb-2">
                                            <h6 class="font-weight-semibold mb-2">
                                                <a href="details/{{$products->id}}" class="text-default mb-2" data-abc="true">{{$products->name}}</a>
                                            </h6>
                                            
                                        </div>
                                        <h3 class="mb-0 font-weight-semibold ">{{$products->price}}Rs</h3>
                                        <div class="d-flex d-grid gap-2 d-md-flex">
                                        <button class="btn btn-primary add-to-cart mb-2" id="addCart<?php echo $countP;?>">
                                          Add to Cart
                                        </button>
                                        <button type="button" class="btn btn-primary mb-2 text-right"><a href="/cart/{{$products->id}}" class="text-white text-decoration-none">Buy Now</a></button> 
                                      </div>
                                    </div>
                </div> 
            </div>
            <?php $countP++;?>
                @endforeach       
        </div>
</div>
<script type="text/javascript">
    $(document).ready(function()
  { 
   <?php $maxP =  count((array)$products); 
    for($i=0; $i<$maxP; $i++){?>
      $('#addCart<?php echo $i; ?>').click(function(){
        var pro_id<?php echo $i; ?> = $('#pro_id<?php echo $i; ?>').val();
        $.ajax({
          type: 'get', 
          url: '<?php echo url('/checkout');?>/'+pro_id<?php echo $i;?>,
          success:function(){
            //alert('done');
          }
        });
      });
    <?php }?>
  });
</script>
@endsection