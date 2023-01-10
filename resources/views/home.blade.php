@extends('layouts.app')

@section('content')
@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div> 
@endif
<h1 class="text-center">{{ __('Dashboard') }}</h1>
<div class="container">           
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Counter</th>
        <th>Product Name</th>
        <th>Product Code</th>
        <th>Product Quantity</th>
        <th>Product Price</th>
        <th>Product Catagory</th>
        <th>Product Description</th>
        <th>Product Weight</th>
        <th>Product Dimension</th>
        <th>Product Image</th>
        <th>Delete</th>
        <th>Update</th>
      </tr>
    </thead>
    <tbody>
        @foreach($products as $index => $products)
        <tr>
            <input type="hidden" class="del_val" value="{{$products->id}}">
            <td>{{$index+1}}</td>
            <td>{{$products->name}}</td>
            <td>{{$products->code}}</td>
            <td>{{$products->qty}}</td>
            <td>{{$products->price}}</td>
            @if($products->catagory =='1')         
                  <td>Internal</td>         
            @elseif($products->catagory =='2')
                  <td>External</td>
            @else
                  <td>Accessories</td>        
            @endif
            <td>{{$products->description}}</td>
            <td>{{$products->weight}}</td>
            <td>{{$products->dimension}}</td>
            <td>{{$products->image}}</td>
            <td><button type="button" class="btn btn-danger delete">Delete</td>
            <td><button type="button" class="btn btn-success update"><a class="text-white text-decoration-none" href="{{route('update', ['id' => $products->id ])}}">
                Update
            </a></button></td>
        </tr>
        @endforeach
    </tbody>
  </table>
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
          text: "Once deleted, you will not be able to recover this product details!",
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
                url: '/delete/'+delete_id,
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
