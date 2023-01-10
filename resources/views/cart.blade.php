@extends('layouts.layout')

@section('content')
<div class="container ">
    <h1 class="text-center">Check Out</h1>
    @if (Session::has('cart'))
            <div class="row">
                <div class="col-sm-6">
                    <!--SHIPPING METHOD-->
                    <div class="panel panel-info">
                        <div class="panel-heading bg-dark text-white mb-3 ">
                            &nbsp Address</div>
                        <div class="panel-body">
                        <form action="/checkout" method="POST" >
                            @csrf
                            <div class="form-group">
                                <div class="col-md-12">
                                    <h4>Shipping Address</h4>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <strong>Full Name:</strong>
                                    <input type="text" name="full_name" class="form-control @error('full_name') is-invalid @enderror" value="" />
                                </div>
                                @error('full_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Address:</strong></div>
                                <div class="col-md-12">
                                    <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="" />
                                </div>
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>City:</strong></div>
                                <div class="col-md-12">
                                    <input type="text" name="city" class="form-control @error('city') is-invalid @enderror" value="" />
                                </div>
                                @error('city')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Zip / Postal Code:</strong></div>
                                <div class="col-md-12">
                                    <input type="text" name="zip_code" class="form-control @error('zip_code') is-invalid @enderror" value="" />
                                </div>
                                 @error('zip_code')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Phone Number:</strong></div>
                                <div class="col-md-12">
                                    <input type="text" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" />
                                 @error('phone_number')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Payment Method:</strong></div>
                                <input type="radio" name="COD" value="Cash on Delivery" checked="checked">
                                <label for="COD">Cash on Delivery</label>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Email Address:</strong></div>
                                <div class="col-md-12"><input type="text" name="email_address" class="form-control @error('email_address') is-invalid @enderror" value="" />
                                @error('email_address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            </div>
                            <div class="form-group mt-3 mb-3">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <button type="submit" class="btn btn-primary btn-submit-fix">Place Order</button>
                                </div>
                            </div>
                        </form>
                            
                        </div>
                    </div>
            </div>
                <div class="ml-5 col-sm-6">
                    <div class="panel panel-info">
                        
                            <div class="panel-heading bg-dark text-white mb-3 ">
                                &nbsp Review Order 
                            </div>
                            <div class="panel-body cart-panel">
                                <div><a href="/delete_product" class="text-dark float-right">Clear Cart</a></div>
                                    @foreach($products as $product)
                                    <div class="form-group row">
                                        <div class="col-md-6 col-xs-6">
                                          <img class="cart_image" src="{{ asset('storage/images/products/'.$product['item']['image']) }}" />
                                        </div>
                                        <div class="col-sm-6 col-xs-6">
                                            <div>{{$product['item']['name']}}</div>
                                            <div>Quantity:
                                                {{$product['qty']}}</div>
                                            <h6><span>$</span>{{$product['price']}}</h6>
                                        </div>
                                    </div>
                                <div class="form-group"><hr /></div>
                                    @endforeach
                                
                                
                                <div class="form-group">
                                    <div class="row">
                                    <div class="col-sm-6 col-xs-6">
                                        <b>Subtotal</b><br>
                                        <b>Shipping</b>
                                    </div>
                                    <div class="col-sm-6 col-xs-6">
                                        <div class="pull-right"><span>$</span><span>{{$totalPrice}}</span></div>
                                        <div class="pull-right"><span>-</span>Free</div>
                                    </div>
                                    </div>

                                </div>
                                <div class="form-group"><hr /></div>
                                <div class="form-group row">
                                    <div class="col-sm-6 col-xs-6">
                                        <strong>Order Total</strong>
                                    </div>
                                    <div class="col-sm-6 col-xs-6">
                                        <div class="pull-right mb-5"><span>$</span><span>{{$totalPrice}}</span></div>
                                    </div>
                                </div>
                            </div>
                    </div>

                </div>
            </div>
             @else
                    <div class="text-center">
                        No item found in the cart
                    </div>
                @endif
</div>

    @endsection