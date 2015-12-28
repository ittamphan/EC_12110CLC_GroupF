<div class="panel panel-info">
	<div class="panel panel-heading">
		<h3>Editing order number {{ $order->id }}</h3>
	</div>
	<div class="panel-body">
	   @if(count($errors))
	<div class="alert alert-danger">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<strong>Errors!</strong> Please check your input again!
		<ul>
			@foreach($errors->all() as $error)
			<li>* {{ $error }}</li>
			@endforeach
		</ul>
	</div>
	@endif
	<div class="col-sm-12">
	   <form action="{{ route('admin.changeOrder', $order->id) }}" method="POST" role="form" class="">
	   		<input type="hidden" name="_method" value="PUT">
	   		<input type="hidden" name="_token" value="{{ csrf_token() }}">
	   		<input type="hidden" name="start_date" value="{{ $start_date }}">
	   	<div class="form-group">
	   		<label for="">Order id</label>
	   		<input type="text" name="order_id" class="form-control" id="orderid" value="{{ $order->id }}" disabled="true">
	   	</div>
	   	<div class="form-group">
	   		<label for="">User id</label>
	   		<input type="text" name="user_id" class="form-control" id="userid" value="{{ $order->user_id }}" disabled="true">
	   	</div>
	   	<div class="form-group">
	   		<label for="">Received date</label>
	   		<input type="text" name="received_date" class="form-control" id="datepicker" value="{{ $order->received_date }}" placeholder="YYYY-MM-DD">
	   	</div>
	   	<div class="form-group">
	   		<label for="">Address</label>
	   		<textarea name="address" id="input" class="form-control" rows="3" required="required">{{ $order->address }}</textarea>
	   	</div>
	   	<div class="form-group">
	   		<label for="">Receiver's name</label>
	   		<input type="text" name="receiver_name" class="form-control" id="receiver_name" value="{{ $order->receiver_name }}">
	   	</div>
	   <div class="form-group">
	   		<label for="">Receiver's phone number</label>
	   		<input type="text" name="phone" class="form-control" id="phone" value="{{ $order->phone }}">
	   	</div>

	   	<button type="submit" class="btn btn-primary">Update</button>
	   	<button type="button" class="btn btn-danger" onclick="history.back()">Back</button>
	   </form>
	  </div>
	</div>
</div>