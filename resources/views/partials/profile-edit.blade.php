<div class="edit-profile-form">
	<form action="{{ route('update.profile', Auth::user()->id) }}" method="POST" role="form">
	<legend>User information</legend>
	<input type="hidden" name="_method" value="PUT">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	@if(count($errors))
	<div class="alert alert-danger">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<strong>Whoopes!</strong>
		<ul>
			@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
	@endif
	<div class="col-md-4">
		<div class="form-group">
			<label for="">User's name</label>
			<input type="text" name="name" class="form-control" id="name" value="{{Auth::user()->name }}">
		</div>
		<div class="form-group">
			<label for="">Gender</label>
			<select name="gender" id="gender" class="form-control" required="required">
				<option value="{{ Auth::user()->gender }}">
				@if(Auth::user()->gender == 1)
				Male
				@else
				Female
				@endif
				</option>
				<option value="1">Male</option>
				<option value="0">Female</option>
			</select>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
	        <label for="">Date of Birth</label>
	        <input type="text" name="dob" id="datepicker" class="form-control" placeholder="YYYY-MM-DD" value="{{ Auth::user()->dob }}">
        </div>
		<div class="form-group">
			<label for="">Phone</label>
			<input type="number" name="phone" class="form-control" id="" placeholder="Your phone number" value="{{ Auth::user()->phone }}">
		</div>
	</div>
	<div class="col-md-4" style="margin-top: 30px;">
		<div class="col-md-12">
			<a href="{{ route('changepassword', Auth::user()->id) }}" style="float: right"><i class="fa fa-exclamation color"></i> Change password</a>
		</div>		
		<div class="col-ms-12 button-right">
		<br>
		<br>
		<br>
			<button type="submit" class="btn btn-primary">Save</button>
			<a href="{{ route('show.profile', Auth::user()->id) }}" class="btn btn-danger">Discard</a>
		</div>
	</div>
	</form>
</div>