<div class="col-sm-12">
<a href="{{ route('show.profile', Auth::user()->id) }}"><i class="fa fa-arrow-left"></i>   Back to Profile!</a>
	<div class="table-responsive">
		<table class="table table-hover table-color">
			<thead>
				<tr>
					<th>Order's ID</th>
					<th>User's ID</th>
					<th>Receiver's name</th>
					<th>Phone number</th>
					<th>Address</th>
					<th>Created at</th>
					<th>Received Date</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
			@if(count($orders))
			@foreach($orders as $order)
				<tr>
					<td>{{ $order->id }}</td>
					<td>{{ $order->user_id }}</td>
					<td>{{ $order->receiver_name }}</td>
					<td>{{ $order->phone }}</td>
					<td>{{ $order->address }}</td>
					<td>{{ $order->created_at }}</td>
					<td>{{ $order->received_date }}</td>
					<td>
					@if($order->status == 0)
						<i class="fa fa-times-circle pending-color"></i> Pending
					@else
						<i class="fa fa-check-circle-o completed-color"></i> Completed
					@endif
					</td>
				</tr>
			@endforeach
			@endif
			</tbody>
		</table>
	</div>
</div>