<table class="table table-hover">
<caption><h3><u>Managing your Orders!</u></h3></caption>
	<thead>
		<tr>
			<th>No</th>
			<th>Order</th>
			<th>User name</th>
			<th>Received date</th>
			<th>Address</th>
			<th>Receiver's name</th>
			<th>Phone</th>
			<th style="text-align:center">Status</th>
			<th>Update</th>
		</tr>
	</thead>
	<tbody>
	<?php $i = 0 ?>
	@foreach($orders as $order)
		<tr>
			<td>{{ $i+=1 }}</td>
			<td>{{ $order->id }}</td>
			<td>{{ $order->user_id }}</td>
			<td>{{ $order->received_date }}</td>
			<td>
				<textarea name="address" id="input" class="form-control" rows="3" required="required" disabled="true">{{ $order->address }}</textarea>
			</td>
			<td>{{ $order->receiver_name }}</td>
			<td>{{ $order->phone }}</td>
			<td style="text-align:center">
			@if($order->status == 0)
				<a href="{{ route('admin.updateStatus', $order->id) }}"><i class="fa fa-times-circle pending-color"></i> Pending</a>
			@else
				<a href="{{ route('admin.updateStatus', $order->id) }}"><i class="fa fa-check-circle-o completed-color"></i> Completed</a>
			@endif
			</td>
			<td>
				<a href="{{ route('admin.editOrder', $order->id) }}" class="btn btn-danger btn-xs glyphicon glyphicon-pencil"></a>
			</td>
		</tr>
	@endforeach
	</tbody>
</table>
<div class="col-sm-8 col-sm-offset-4">
	<div>{!! $orders->render() !!}</div>
</div>