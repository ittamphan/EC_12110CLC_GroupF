<table class="table table-hover">
<caption><h3><u>Order details</u></h3></caption>
	<thead>
		<tr>
			<th>No</th>
			<th>ID</th>
			<th>Ordered id</th>
			<th>User ID</th>
			<th>Price</th>
			<th>Quantity</th>
		</tr>
	</thead>
	<tbody>
	<?php $i = 0 ?>
	@foreach($orderdetails as $orderdetail)
		<tr>
			<td>{{ $i+=1 }}</td>
			<td>{{ $orderdetail->id }}</td>
			<td>{{ $orderdetail->ordered_id }}</td>
			<td>{{ $orderdetail->user_id }}</td>
			<td>{{ number_format($orderdetail->price, 0, ',', ',') }} &#8363;</td>
			<td>{{ $orderdetail->quantity }} item(s)</td>
		</tr>
	@endforeach
	</tbody>
</table>
<div class="col-sm-8 col-sm-offset-4">
	<div>{!! $orderdetails->render() !!}</div>
</div>