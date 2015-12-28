<div class="edit-profile-form">
	<form action="" method="POST" role="form" enctype="multipart/form-data">
	<br>
	<br>
	<legend>User information</legend>
	<div class="col-md-4">
		<div class="form-group">
			<label for="">User's name</label>
			<input type="text" name="name" class="form-control" id="name" value="{{Auth::user()->name }}" disabled="true">
		</div>
		<div class="form-group">
			<label for="">Gender</label>
			<select name="gender" id="gender" class="form-control" required="required" disabled="true">
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
	        <input type="text" name="dob" id="datepicker" class="form-control" placeholder="YYYY-MM-DD" value="{{ Auth::user()->dob }}" disabled="true">
        </div>
		<div class="form-group">
			<label for="">Phone</label>
			<input type="number" name="phone" class="form-control" id="" placeholder="Your phone number" value="{{ Auth::user()->phone }}" disabled="true">
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<label for="">Email</label>
			<input type="email" name="phone" class="form-control" id="" value="{{ Auth::user()->email }}" disabled="true">
		</div>
	</div>
	</form>
	<div class="button-right edit-profile">
		<a href="{{ route('edit.profile', Auth::user()->id) }}" class="btn btn-danger">Edit</a>
		<a href="{{ route('homepage') }}" class="btn btn-danger">Back</a>
	</div>
</div>