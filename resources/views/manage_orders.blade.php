@extends('layouts.app')

@section('content')
@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div> 
@endif
<h1 class="text-center">{{ __('Dashboard') }}</h1>
<div class="container">    
@foreach($orders as $index => $order)       
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Counter</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone Number</th>
        <th>Address</th>
        <th>City</th>
        <th>Postal Code</th>
        <th>Total Qty</th>
        <th>Total Price</th>
        <th>Order Completed</th>
      </tr>
    </thead>
    <tbody>
        
        <tr>
            <input type="hidden" class="del_val" value="{{$order->id}}">
            <td>{{$index+1}}</td>
            <td>{{$order->name}}</td>
            <td>{{$order->email}}</td>
            <td>{{$order->phone}}</td>
            <td>{{$order->address}}</td>
            <td>{{$order->city}}</td>
            <td>{{$order->postal_code}}</td>
            <td>{{$order->total_qty}}</td>
            <td>{{$order->total_Price}}</td>
            <td><button type="button" class="btn btn-danger delete">Delete</td>
        </tr>
    </tbody>
  </table>
  <table class="table table-striped">
    <thead>
      <tr class="bg-dark text-white">
        <th>Counter</th>
        <th>Product id</th>
        <th>Product name</th>
        <th>Qty</th>
        <th>Created at</th>
      </tr>
    </thead>
    <tbody>
       

            	<?php
            		$counter = 1;
				for($i = 1;$i<=1000;$i++)
                {
                    //dd(gettype($order->cart->items[9]));
                   if (isset($order->cart->items[$i])) {
                    	echo '<tr><td>'.$counter.'</td>';
                    	$counter++;
                		echo '<td>'.$order->cart->items[$i]["item"]['id'].'</td>';
            			echo '<td>'.$order->cart->items[$i]["item"]['name'].'</td>';
            			echo '<td>'.$order->cart->items[$i]["qty"].'</td>';
            			echo '<td>'.$order->cart->items[$i]["item"]['created_at'].'</td></tr>';
                    }
                    else
                    {
                        
                    }
                }
            	?>
    </tbody>
  </table>
  				
				
  @endforeach
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    $('.delete').click(function(e){
        e.preventDefault();
        var delete_id = $(this).closest("tr").find('.del_val').val();

        swal
        ({
          title: "Are you sure?",
          text: "Once deleted, you will not be able to recover this order!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            var data = {
                "_token": $('input[name=_token]').val(),
                "id": delete_id,
            };
            $.ajax({
                type: "DELETE",
                url: '/delete1/'+delete_id,
                data: data,
                success: function(response) 
                {
                    swal("Your product has been deleted!", {
                      icon: "success",
                    })
                    .then((result)=> {
                        location.reload();
                    });
                    }
            
          });
        }
    });
});
    });
</script>
@endsection
