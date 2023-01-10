@extends('layouts.app')

@section('content')
@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div> 
@endif
<h1 class="text-center"> Product Details </h1>
<div class="container">
  <form action="{{ route('store_products') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="d-flex justify-content-center">
      <div class="form-group">
           <label for="product_catagory">Product catagory:</label>
          <div>
          <select class="form-select form-select-lg p-2 @error('product_catagory') is-invalid @enderror" id="product_catagory" name="product_catagory" aria-label=".form-select-lg example">
          <option value="" selected>Open this select menu</option>
          <option value="1">Internal</option>
          <option value="2">Exterrnal</option>
          <option value="3">Accessories</option>
        </select>
           </div>
           @error('product_catagory')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
      
      <div class="row">
      <div class='col-sm-0 col-md-2'>
      </div>
      <div class='col-sm-6 col-md-4'>
        <div class="form-group">
          <label for="product_weight">Product weight*:</label>
          <div class="input-group">
            <input type="text" class="form-control @error('product_weight') is-invalid @enderror" id="product_weight" placeholder="Enter product weight" name="product_weight">
           </div>
           @error('product_weight')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
      </div>
      <div class="col-sm-6 col-md-4">
        <div class="form-group">
          <label for="product_code">Product code*:</label>
          <div class="input-group">
            <input type="text" class="form-control @error('product_code') is-invalid @enderror" id="product_code" placeholder="Enter product code" name="product_code">
           </div>
            @error('product_code')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
      </div>
    </div>

<div class="row">
      <div class='col-sm-0 col-md-2'>
      </div>
      <div class='col-sm-6 col-md-4'>
       <div class="form-group">
          <label for="product_name">Product name*:</label>
          <div class="input-group">
            <input type="text" class="form-control @error('product_name') is-invalid @enderror" id="product_name" placeholder="Enter product name" name="product_name">
           </div>
           @error('product_name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
      </div>
      <div class="col-sm-6 col-md-4">
        <div class="form-group">
          <label for="product_quantity">Product quantity*:</label>
          <div class="input-group">
            <input type="number" class="form-control @error('product_quantity') is-invalid @enderror" id="product_quantity" placeholder="Enter product quantity" name="product_quantity">
           </div>
            @error('product_quantity')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
      </div>
    </div>
    
    <div class="row">
      <div class='col-sm-0 col-md-2'>
      </div>
      <div class='col-sm-6 col-md-4'>
       <div class="form-group">
          <label for="product_price">Product price*:</label>
          <div class="input-group">
            <input type="text" class="form-control @error('product_price') is-invalid @enderror" id="product_price" placeholder="Enter product price" name="product_price">
           </div>
           @error('product_price')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
      </div>
      <div class="col-sm-6 col-md-4">
        <div class="form-group">
          <label for="dimension">Product dimension:</label>
          <div class="input-group">
            <input type="text" class="form-control" id="dimension" placeholder="Enter product dimension" name="dimension">
           </div>
        </div>
      </div>
    </div>

<div class="row">
      <div class='col-sm-0 col-md-2'>
      </div>
      <div class='col-sm-6 col-md-8'>
        <div class="form-group">
          <label for="product_description">Product description*:</label>
          <div class="input-group">
            <textarea class="form-control @error('product_description') is-invalid @enderror" rows="5" name="product_description" id="product_description" placeholder="Enter product description"></textarea>
           </div>
           @error('product_description')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
      </div>
    </div>

    
      <div class="row">
      <div class='col-sm-0 col-md-2'>
      </div>
      <div class='col-sm-6 col-md-8'>
        <label for="customFile">Upload product image</label>
    <div class="custom-file mb-3">
      <input type="file" class="custom-file-input @error('customFile') is-invalid @enderror" id="customFile" name="filename">
      <label class="custom-file-label" for="customFile">Choose file</label>
    </div> 
    @error('filename')
                <span class="text-danger">{{ $message }}</span>
            @enderror
  </div></div>

    <div class="d-flex justify-content-center">
       <button type="submit" value="submit" id="button" class="btn btn-primary d-flex justify-content-center">Submit</button>
    </div>
    
  </form>
</div>
<script>
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>
@endsection