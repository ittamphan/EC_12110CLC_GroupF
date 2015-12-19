<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Get email</title>
	<link rel="stylesheet" href="{{ asset('public/css/bootstrap.min.css') }}">
	<script src="{{ asset('public/js/bootstrap.min.js') }}" type="text/javascript" charset="utf-8" async defer></script>
	<script src="{{ asset('public/js/jquery-1.7.2.min.js') }}" type="text/javascript" charset="utf-8" async defer></script>
	<link rel="stylesheet" href="{{ asset('public/css/forgotpassword.css') }}">
	<script src="{{ asset('public/js/forgotpassword.js') }}" type="text/javascript" charset="utf-8" async defer></script>
</head>
<body>
	<div class="container">
	  <div class="row" id="pwd-container">
	    <div class="col-md-4"></div>
	    <div class="col-md-4">
	    @if(count($errors))
	    <div class="alert">
	    	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	    	<strong>Whoops!</strong>
	    	<ul>
	    		@foreach($errors->all() as $error)
	    		<li>{{ $error }}</li> 
	    		@endforeach
	    	</ul>
	    </div>
	    @endif
	      <section class="login-form">
	        <form method="post" action="{{ route('sendResetLink') }}" role="login">
			{!! csrf_field() !!}
	           <a href="{{ route('homepage') }}"><img src="{{ asset('public/images/logo.png') }}" class="img-responsive" alt="" /></a>
	          <input type="email" name="email" placeholder="Email" required class="form-control input-lg" value="{{ old('email') }}" />
	          <div class="pwstrength_viewport_progress"></div>
	          <button type="submit" name="go" class="btn btn-lg btn-primary btn-block">Send password reset link!</button>
	          <div>
	            <a href="{{ route('register') }}">Create account</a>
	          </div>
	        </form>
	        <div class="form-links">
	          <a href="{{ route('homepage') }}">www.NhomF-EC.com</a>
	        </div>
	      </section>  
	      </div>
	      <div class="col-md-4"></div>
	  </div>
</body>
</html>