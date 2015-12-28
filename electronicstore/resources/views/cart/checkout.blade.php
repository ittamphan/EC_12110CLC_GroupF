<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Order!</title>
	<!-- Latest compiled and minified CSS & JS -->
	<link rel="stylesheet" media="screen" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<script src="//code.jquery.com/jquery.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="{{ asset('public/css/bootstrap-datepicker.css') }}">
    <script type="text/javascript" src="{{ asset('public/js/bootstrap-datepicker.js') }}"></script>
    <script>
      $(function() {
        $('#datepicker').datepicker({format: "yyyy-mm-dd"});
      });
    </script>
	<link rel="stylesheet" href="{{ asset('public/css/checkout.css') }}">
</head>
<body>
	<div class="container wrapper">
            <div class="row cart-head">
                <div class="container">
                <div class="row">
                    <p></p>
                </div>
                <div class="row">
                    <div style="display: table; margin: auto;">
                        <span class="step step_complete"> <a href="#" class="check-bc">Cart</a> <span class="step_line step_complete"> </span> <span class="step_line backline"> </span> </span>
                        <span class="step step_complete"> <a href="#" class="check-bc">Checkout</a> <span class="step_line "> </span> <span class="step_line step_complete"> </span> </span>
                        <span class="step_thankyou check-bc step_complete">Thank you</span>
                    </div>
                </div>
                <div class="row">
                    <p></p>
                </div>
                </div>
            </div>    
            <div class="row cart-body">
                <form class="form-horizontal" method="post" action="{{ route('order', Auth::user()->id) }}">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-md-push-6 col-sm-push-6">
                    <!--REVIEW ORDER-->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Review Order <div class="pull-right"><small><a class="afix-1" href="{{ route('mycart') }}">Edit Cart</a></small></div>
                        </div>
                        <div class="panel-body">
                        @foreach($items as $item)
                            <div class="form-group">
                                <div class="col-sm-3 col-xs-3">
                                    <img class="img-responsive" src="{{ asset('public/images/product_images/'.$item->options['image']) }}" />
                                </div>
                                <div class="col-sm-6 col-xs-6">
                                    <div class="col-xs-12">{{ $item->name }}</div>
                                    <div class="col-xs-12"><small>Quantity: <span>{{ $item->qty }}</span></small></div>
                                </div>
                                <div class="col-sm-3 col-xs-3 text-right">
                                    <h6>{{ number_format($item->price, 0, ',',',') }}<span>&#8363</span></h6>
                                </div>
                            </div>
                            @endforeach
                            <div class="form-group"><hr /></div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <strong>Order Total</strong>
                                    <div class="pull-right"><span>{!! number_format($total,0,',',',') !!}</span><span>&#8363</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--REVIEW ORDER END-->
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-md-pull-6 col-sm-pull-6">
                    <!--SHIPPING METHOD-->
                    <div class="panel panel-primary">
                        <div class="panel-heading">Address</div>
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <h4>Shipping Address</h4>
                                </div>
                            </div>
                            @if(count($errors))
                                <div class="alert alert-danger">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <strong>Whoops!</strong>
                                    <ul>
                                        @foreach($errors->all() as $error)
                                        <li><strong>-</strong> {{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="start_date" value="{{ $start_date }}">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <strong>Receiver Name:</strong>
                                    <input type="text" name="receiver_name" class="form-control" value="" />
                                </div>
                                <div class="span1"></div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Address:</strong></div>
                                <div class="col-md-12">
                                    <textarea name="address" class="form-control" style="resize: vertical">@if(count($user_address)){{ $user_address->address }}@endif</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Received date:</strong></div>
                                <div class="col-md-12">
                                    <input type="text" name="received_date" id="datepicker" class="form-control" placeholder="Please choose before todate" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Phone Number:</strong></div>
                                <div class="col-md-12"><input type="text" name="phone" class="form-control" value="" /></div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Email Address:</strong></div>
                                <div class="col-md-12"><input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}" /></div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <button type="submit" class="btn btn-primary btn-submit-fix">Place Order</button>
                                    <a href="{{ route('mycart') }}" class="btn btn-danger">Cancel order!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--SHIPPING METHOD END-->
                 </div>  
                </form>
            </div>
            <div class="row cart-footer">
        
            </div>
    </div>
</body>
</html>