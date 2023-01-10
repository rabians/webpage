<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-compatible" content="ie-edge">
<title>Order Confirmation</title>
</head>
<style>
table {
  font-family: arial, sans-serif;
  font-size: 50px;
  width: 100%;

}
</style>
<body>
		
		Hi {{ $contact_data['full_name']}}! <br> Your Order is confirmed.<br>
		<b>Ship to </b><br>{{$contact_data['address']}}, {{$contact_data['postal_code']}} <br>
		{{$contact_data['city']}}, Pakistan<br>
		{{$contact_data['phone_number']}}
	</p>
	</div>
	

	<table cellpadding="5px" cellspacing="5px" border="1" style="width:100%;text-rendering: center">
		<thead>
			<tr>
		        <th>Product name</th>
		        <th>Qty</th>
		        <th>Price</th>
			  </tr>
		</thead>
	  	<tbody>
	  		<?php
            		$counter = 1;
				for($i = 1;$i<=1000;$i++)
                {
                   if(array_key_exists($i, $contact_data['message']->items))

                    {
                    	echo '<tr style="text-align: center;">';
                    	$counter++;
                		echo '<td style="text-align: center;">'.$contact_data['message']->items[$i]["item"]['name'].'</td>';
                		$image = $contact_data['message']->items[$i]['item']['image'];
            			echo '<td style="text-align: center;">'.$contact_data['message']->items[$i]["qty"].'</td>';
            			echo '<td style="text-align: center;">'.$contact_data['message']->items[$i]["price"].'</td>';

                    }
                }
            	?>
	  	</tbody>
	</table>

	<p>
		<b>Total Price:</b> {{$contact_data['message']->totalPrice}}<br>
		

	</p>
</body>
</html>