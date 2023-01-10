@extends('layouts.layout')

@section('content')

<h1 class="text-center">Search Results</h1>
<div class="container d-flex justify-content-center mt-50 mb-50">
          <div>
              <?php if($products->isEmpty())
         {?><p>No products</p>
         <?php }
         else{
          $countP = 0;
         }?>
          </div>  
        <div class="row">
				@foreach($products as $index => $products)
				<div class="col-6 col-md-3 mt-2 mb-2">
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
                                            <a href="#" class="text-muted" data-abc="true">
                                            <?php $catagory = ""?>
                                             	@if($products->catagory =='1')         
									                  Internal         
									            @elseif($products->catagory =='2')
									                  External
									            @else
									                  Accessories;        
									            @endif
                                            </a>
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