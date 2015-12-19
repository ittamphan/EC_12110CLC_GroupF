<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>{{ Auth::user()->name }}'s Profile</title>
	<link href="{{ asset('public/assets-admin/css/bootstrap.css') }}" rel="stylesheet">
  <link href="{{ asset('public/assets-admin/font-awesome/css/font-awesome.css') }}" rel="stylesheet" />
  <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="{{ asset('public/css/profile.css') }}">
  <script src="{{ asset('public/assets-admin/js/jquery.js') }}"></script>
  <link rel="stylesheet" href="{{ asset('public/css/popup.css') }}">
  <script type="text/javascript" src="{{ asset('public/js/popup.js') }}"></script>
  <!-- -->
  
</head>
<body>
<div class="container" style="margin-top: 20px; margin-bottom: 20px;">
	<div class="row panel">
		<div class="edit-button">
		</div>
		<div class="col-md-4 bg_blur "></div>
        <div class="col-md-8  col-xs-12">
        <div class="avatar">
            <img src="{{ asset('public/assets-admin/img/'.Auth::user()->profile_pic) }}" class="img-thumbnail picture hidden-xs" />
           <img src="{{ asset('public/assets-admin/img/'.Auth::user()->profile_pic) }}" class="img-thumbnail visible-xs picture_mob" />
           <button id="popup" onclick="div_show()" class="btn btn-danger btn-xs edit-avatar"><i class="fa fa-pencil"></i></button>
        </div>
           <div class="header">
                <h1>{{ Auth::user()->name }}</h1>
                <h4>
                  @if(Auth::user()->is_admin == 1)
                  Adminstrator
                  @else
                  Customer
                  @endif
                </h4>
                <h3>
                {{ Inspiring::quote() }}
                </h3>
           </div>
        </div>
    </div>   
    
	<div class="row nav">    
        <div class="col-md-4">
        	<a href="{{ route('homepage') }}"><img src="{{ asset('public/images/logo.png') }}" alt=""></a>
        </div>
        <div class="col-md-8 col-xs-12" style="margin: 0px;padding: 0px;">
            <div class="col-md-4 col-xs-4 well"><i class="fa fa-heart fa-lg"></i> 16</div>
            <div class="col-md-4 col-xs-4 well"><i class="fa fa-clock-o fa-lg"></i> History</div>
            <div class="col-md-4 col-xs-4 well"><i class="fa fa-thumbs-o-up fa-lg"></i> 26</div>
        </div>
    </div>
    <div id="edit-avatar">
    <!-- Popup Div Starts Here -->
    <div id="popupContact">
      <!-- Contact Us Form -->
      <form action="{{ route('changeAvatar', Auth::user()->id) }}" id="form" method="POST" enctype="multipart/form-data">
      <a id="close" onclick="div_hide()" class="btn btn-danger  glyphicon glyphicon-remove-circle"></a>
        <h3>Please choose your avatar</h3>
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="input-group form-group">
          <span class="input-group-btn">
              <span class="btn btn-primary btn-file">
                  Browse&hellip; <input name="profile_pic" id="image" type="file" multiple>
              </span>
          </span>
          <input type="text" class="form-control" placeholder="Please choose your best photo" readonly>
        </div>
        <div class="form-group button-right">
          <button type="submit" class="btn btn-primary">Change!</button>
        </div>
      </form>
      </div>
      <!-- Popup Div Ends Here -->
    </div>
  <div class="row content">
    @include($page)
  </div>
</div>
<script type="text/javascript" charset="utf-8" async defer>
    $(document).on('change', '.btn-file :file', function() {
        var input = $(this),
      numFiles = input.get(0).files ? input.get(0).files.length : 1,
      label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
  input.trigger('fileselect', [numFiles, label]);
});

$(document).ready( function() {
    $('.btn-file :file').on('fileselect', function(event, numFiles, label) {
        
        var input = $(this).parents('.input-group').find(':text'),
            log = numFiles > 1 ? numFiles + ' files selected' : label;
        
        if( input.length ) {
            input.val(log);
        } else {
            if( log ) alert(log);
        }
        
    });
});
</script>
</body>
</html>