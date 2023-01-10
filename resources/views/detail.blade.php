@extends('layouts.layout')

@section('content')
<div class="container clear-top">
  <a class="mb-2" href="/">Go Back to home page</a>
  <div class="row">
    <div class="col-sm-6 text-sm-center text-md-left ">
      <img src="{{ asset('storage/images/products/'.$products->image) }}" />
    </div>
    <div class="col-sm-6" align="center">
      
      <h2>{{$products-> name}}</h2>
      <h4>Price : {{$products-> price}}</h4>
      <h5>Details : {{$products-> description}}</h5>
      <h5>
        Catagory:
      </h5>
       @if ($products->catagory =='1')
          <h5>Internal</h5>
       @endif
      @if ($products->catagory =='2')
          <h5>External</h5>
       @endif
       @if ($products->catagory =='3')
          <h6>Accessories</h6>
       @endif
       
        <button type="button" class="btn btn-primary mt-2"><a href="/checkout/{{$products->id}}" class="text-white text-decoration-none"><i class="fa fa-cart-plus mr-2 "></i> Add to cart</a></button>
       <button type="button" class="btn btn-primary mt-2"><a href="/cart/{{$products->id}}" class="text-white text-decoration-none">Buy Now</a></button>
    </div>
  </div>
  <br>
</div>
@endsection