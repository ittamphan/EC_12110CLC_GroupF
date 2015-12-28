<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Reset password!</title>
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
        <form method="post" action="{{ route('postResetPassword') }}" role="login">
          <img src="{{ asset('public/images/logo.png') }}" class="img-responsive" alt="" />
          <input type="email" name="email" placeholder="Email" required class="form-control input-lg" value="{{ old('email') }}" />
          <input type="password" class="form-control input-lg" id="password" placeholder="Password" required="" />
          <div class="pwstrength_viewport_progress"></div>
          <div class="form-group">
            <input type="password" name="password_confirmation" id="input" class="form-control" required="required" title="">
          </div>
          <button type="submit" name="go" class="btn btn-lg btn-primary btn-block">Sign in</button>
          <div>
            <a href="#">Create account</a> or <a href="#">reset password</a>
          </div>          
        </form>
        <div class="form-links">
          <a href="#">www.website.com</a>
        </div>
      </section>  
      </div>
      <div class="col-md-4"></div>
  </div>
</body>
</html>