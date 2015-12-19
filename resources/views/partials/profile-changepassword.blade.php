<div class="row changepassword">
	<div class="col-sm-5 col-sm-offset-4">
		<form action="" method="POST" role="form">
			<legend>Change password</legend>
			@if(count($errors))
			<div class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong>Whoops!</strong>
				<ul>
					@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
			@endif
			<input type="hidden" name="_method" value="PUT">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="form-group">
				<label for="">Insert your new password now!</label>
				<input type="password" name="password" class="form-control" id="" placeholder="Your new password">
			</div>
			<div class="form-group">
				<label for="">Please confirm</label>
				<input type="password" name="password_confirmation" class="form-control" id="" placeholder="Your new password">
			</div>
			<button type="submit" class="btn btn-primary">Save!</button>
		</form>
	</div>
</div>