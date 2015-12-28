<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<head>
<title>{{ $product->product_name }}</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="" rel="stylesheet" type="text/css" media="all"/>
{!! Html::style('public/css/style.css') !!}
{!! Html::script('public/js/jquery-1.7.2.min.js') !!}
{!! Html::script('public/js/move-top.js') !!}
{!! Html::script('public/js/easing.js') !!}
{!! Html::script('public/js/easyResponsiveTabs.js') !!}
{!! Html::style('public/css/easy-responsive-tabs.css') !!}
{!! Html::style('public/css/global.css') !!}
{!! Html::script('public/js/slides.min.jquery.js') !!}
<link rel="stylesheet" type="text/css" href="{{ asset('public/css/rating.css') }}">
<link rel="stylesheet" href="{{ asset('public/css/app.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/assets-admin/font-awesome/css/font-awesome.css') }}">
<script>
		$(function(){
			$('#products').slides({
				preload: true,
				preloadImage: 'img/loading.gif',
				effect: 'slide, fade',
				crossfade: true,
				slideSpeed: 350,
				fadeSpeed: 500,
				generateNextPrev: true,
				generatePagination: false
			});
		});
	</script>
</head>
<body>
  <div class="wrap">
	<div class="header">
		@include('partials.navbar')     	
   </div>
 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="back-links">
    		<p><a href="{{ route('homepage') }}">Home</a> >>>> <a href="#">Electronics</a></p>
    	    </div>
    		<div class="clear"></div>
    	</div>
    	<div class="section group">
				<div class="cont-desc span_1_of_2">
				  <div class="product-details">				
					<div class="grid images_3_of_2">
						<div id="container">
						   <div id="products_example">
							   <div id="products">
								<div class="slides_container">
									<a href="#" target="_blank">{!! Html::image('public/images/product_images/' .$product->image1) !!}</a>
									<a href="#" target="_blank">{!! Html::image('public/images/product_images/' .$product->image2) !!}</a>
									<a href="#" target="_blank">{!! Html::image('public/images/product_images/' .$product->image3) !!}</a>
								</div>
								<ul class="pagination">
									<li><a href="#">{!! Html::image('public/images/product_images/' .$product->thumbnail1) !!}</a></li>
									<li><a href="#">{!! Html::image('public/images/product_images/' .$product->thumbnail2) !!}</a></li>
									<li><a href="#">{!! Html::image('public/images/product_images/' .$product->thumbnail3) !!}</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="desc span_3_of_2">
				@if($product->sale_price != 0)
				<img src="{{ asset('public/images/sale.png') }}" alt="Sale" class="sale-image-2" width="60" height="60">
				@endif
					<h2>{{ $product->product_name }}</h2>
					@if($product->quantity <= 5)
						<font color="red" style="font-size: 30px; border: solid 1px; padding: 5px">Temporarily out of stock!</font>
					@endif
					<br>
					<br>
					@if($product->is_disabled == 1)
						<font color="red" style="font-size: 30px; border: solid 1px; padding: 5px">Temporarily be disabled!</font>
					@endif
					<p>{{ $product->short_description }}</p>
					<!-- Regular price -->
					<div class="price">
					@if($product->sale_price == 0)
						<p>Price: <span>{{ number_format($product->price, 0,',',',') }} &#8363;</span></p>
						</div>
						@else
						<p>Price: <span class="cross">{{ number_format($product->price, 0,',',',') }} &#8363;</span></p>
						</div>
						<!-- Sale price -->
						<div class="price">
						<p>Sale: <span>{{ number_format($product->sale_price, 0,',',',') }} &#8363;</span></p>
						<h2>Save: {{ number_format($product->price - $product->sale_price, 0, ',', ',') }} &#8363; to your budget</h2>
						</div>
					@endif
				<div class="share-desc">
					@if($product->quantity <= 5 || $product->is_disabled == 1)
					<button class="button" disabled="true"><span>Add to Cart</span></button>
					@else
					<div class="button">
						<span><a href="{{ route('addToCart', $product->id) }}">Add to Cart</a></span>
					</div>
					@endif
					<div class="clear"></div>
					<br>
					<!-- Checkout using paypal -->
					@if($product->quantity > 5 && $product->is_disabled == 0)
					<div class="paypal">
						<strong>Using Paypal</strong>
					<form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
							<!-- Identify your business so that you can collect the payments. -->
							<input type="hidden" name="business" value="huyleseller@gmail.com">
							<!-- Specify a PayPal Shopping Cart Add to Cart button. -->
							<input type="hidden" name="cmd" value="_cart">
							<input type="hidden" name="add" value="1">
							<!-- Specify details about the item that buyers will purchase. -->
							<input type="hidden" name="item_name" value="{{ $product->product_name }}">
							<input type="hidden" name="amount" value="{{ $price }}">
							<input type="hidden" name="quantity" value="1">
							<!-- Display the payment button. -->
							<input type="image" name="submit" border="0"
							src="https://www.paypalobjects.com/en_US/i/btn/btn_cart_LG.gif"
							alt="PayPal - The safer, easier way to pay online">
							<img alt="" border="0" width="1" height="1"
							src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >
						</form>
					</div>
					@endif
				</div>
				<div class="wish-list">
				 	<ul>
				 	@if(Auth::check())
				 		<li class="wish"><a href="{{ route('storeWishedProduct', [$product->id, Auth::user()->id]) }}">Add to Wishlist</a></li>
				 	@else
				 		<li class="wish"><a href="{{ route('login') }}">Login to add to Wishlist!</a></li>
				 	@endif
				 	</ul>
				 </div>
			</div>
			<div class="clear"></div>
		  </div>
		<div class="product_desc">	
			<div id="horizontalTab">
				<ul class="resp-tabs-list">
					<li>Product Details</li>
					<li>Degital info</li>
					<li>Product Reviews</li>
					<div class="clear"></div>
				</ul>
				<div class="resp-tabs-container">
					<div class="product-desc">
						<p>{{ $product->description }}</p>
						</div>

				 <div class="product-tags">
						 <p>{{ $product->product_info }}</p>
			    </div>	
				
				<div class="review">
					@if(count($feedbacks))
					@foreach($feedbacks as $feedback)
					<div class="row">
					<h4>Reviewed by <a style="cursor: pointer">{{ $feedback->nickname }}</a></h4>
					 <h3>{{ $feedback->heading }}</h3>
					 <p>{{ $feedback->content }}</p>
					 <br><br><hr>
					</div>
					@endforeach
					@endif
				  <div class="your-review">
					  <h3>Rate us here, please!</h3>
					  	 <div class="row div-rating">
					  	 @if(Auth::check())
					  	 <?php $user_id = Auth::user()->id ?>
					  	 @else
						<?php $user_id = 0 ?>
					  	 @endif
				  			<script>
			                    $(document).ready(function () {
			                        $("#star-rating .stars").click(function () {

			                        	$.post('/electronicstore/rate/' + '{{ $product->id }}' + '/' + '{{ $user_id }}' ,{rate:$(this).val()},function(d){
			                        		console.log(d);
		                                    if(d>0)
		                                    {
		                                        alert('You already rated');
		                                    }else{
		                                        alert('Thanks For Rating');
		                                    }
		                                });
			                            var label = $("label[for='" + $(this).attr('id') + "']");
			                            
			                            $("#feedback").text(label.attr('title'));
			                            $(this).attr("checked");

			                        });
			                    });
			                </script>
			                <fieldset id='star-rating' class="rating">
			                    <input class="stars" type="radio" id="star5" name="rating" value="5" />
		                        <label class = "full" for="star5" title="Awesome - 5 stars"></label>
		                        <input class="stars" type="radio" id="star4" name="rating" value="4" />
		                        <label class = "full" for="star4" title="Pretty good - 4 stars"></label>
		                        <input class="stars" type="radio" id="star3" name="rating" value="3" />
		                        <label class = "full" for="star3" title="Meh - 3 stars"></label>
		                        <input class="stars" type="radio" id="star2" name="rating" value="2" />
		                        <label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
		                        <input class="stars" type="radio" id="star1" name="rating" value="1" />
		                        <label class = "full" for="star1" title="Sucks big time - 1 star"></label>
			                </fieldset>
			                <div id='feedback'></div>
					 	 </div><!-- Rating Ends -->
					 	 <br>
					 	 <br>
					 	 <br>
					 	 <hr>
					 	 Total rate for {{ $product->product_name }}
					 	 <br>
					 	 <br>
					 	 <span>
						 	 <?php
						 	 for($i = 1; $i <= round($rate_stars); $i++)
						 	 {
						 	 ?>
						 	 	<i class="fa fa-star fa-star-color fa-2x"></i>
						 	 <?php
						 	 }
						 	 if($rate_stars < 5)
						 	 {
						 	 	for($j=1; $j <= (5-round($rate_stars)); $j++)
						 	 	{
							 	 	?>
							 	 	<i class="fa fa-star-o fa-star-color fa-2x"></i>
							 	 	<?php
						 	 	}
						 	 }
						 	 ?>
					 	 </span>
					 	 <hr>
				  	 <h3>How Do You Feel About This {{ $product->product_name }}?</h3>
				  	  <p>Write Your Own Review?</p>
				  	  <form action="{{ route('addfeedback') }}" method="POST" role="form">
				  	  @if(count($errors))
				  	  <div class="alert alert-warning">
				  	  	<strong>Uh Oh!</strong>
				  	  	<ul>
				  	  		@foreach($errors->all() as $error)
				  	  		<li>{{ $error }}</li>
				  	  		@endforeach
				  	  	</ul>
				  	  </div>
				  	  @endif
				  	  <input type="hidden" name="_token" value="{{ csrf_token() }}">
				  	  <input type="hidden" name="product_id" value="{{ $product->id }}">
				  	  <input type="hidden" name="user_id" value="@if(Auth::guest()){{'0'}}@else{{ Auth::user()->id }}@endif">
					    	<div>
						    	<span><label>Nickname<span class="red">*</span></label></span>
						    	<span><input type="text" name="nickname" value=""></span>
						    </div>
						    <div><span><label>Summary of Your Review<span class="red">*</span></label></span>
						    	<span><input type="text" name="heading" value=""></span>
						    </div>						
						    <div>
						    	<span><label>Review<span class="red">*</span></label></span>
						    	<span><textarea name="content"> </textarea></span>
						    </div>
						   <div>
						   		<span><input type="submit" value="SUBMIT REVIEW"></span>
						  </div>
					    </form>
				  	 </div>				
				</div>
			</div>
		 </div>
	 </div>
	    <script type="text/javascript">
    $(document).ready(function () {
        $('#horizontalTab').easyResponsiveTabs({
            type: 'default', //Types: default, vertical, accordion           
            width: 'auto', //auto or any width like 600px
            fit: true   // 100% fit in a container
        });
    });
   </script>		
   <div class="content_bottom">
    		<div class="heading">
    		<h3>Related Products</h3>
    		</div>
    		<div class="see">
    			<p><a href="{{ route('show.typeproducts', $product->type_id) }}">See all Products</a></p>
    		</div>
    		<div class="clear"></div>
    	</div>
   <div class="section group">
   	@foreach( $related_product as $rp)
				<div class="grid_1_of_4 images_1_of_4">
				@if($rp->sale_price != 0)
				<img src="{{ asset('public/images/sale.png') }}" class="sale-image" alt="" width="60" height="60">
				@endif
					 <a href="{{ route('detail', $rp->id) }}">{!! Html::image('public/images/product_images/'.$rp->image1) !!}</a>					
					<div class="price" style="border:none">
					       		<div class="add-cart" style="float:none">								
									<h4><a href="{{ route('detail', $rp->id) }}">Detail</a></h4>
							     </div>
							 <div class="clear"></div>
					</div>
				</div>
				@endforeach
			</div>
        </div>
				<div class="rightsidebar span_3_of_1">
					<h2>CATEGORIES</h2>
					<ul>
					@foreach( $type as $t )
				      <li><a href="{{ route('show.typeproducts', $t->id) }}">{{ $t->type_name }}</a></li>
				    @endforeach
    				</ul>
    				<div class="subscribe">
    					<h2>Newsletters Signup</h2>
    						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.......</p>
						    <div class="signup">
							    <form>
							    	<input type="text" value="E-mail address" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'E-mail address';"><input type="submit" value="Sign up">
							    </form>
						    </div>
      				</div>
      				 <div class="community-poll">
      				 	<h2>Community POll</h2>
      				 	<p>What is the main reason for you to purchase products online?</p>
      				 	<div class="poll">
      				 		<form>
      				 			<ul>
									<li>
									<input type="radio" name="vote" class="radio" value="1">
									<span class="label"><label>More convenient shipping and delivery </label></span>
									</li>
									<li>
									<input type="radio" name="vote" class="radio" value="2">
									<span class="label"><label for="vote_2">Lower price</label></span>
									</li>
									<li>
									<input type="radio" name="vote" class="radio" value="3">
									<span class="label"><label for="vote_3">Bigger choice</label></span>
									</li>
									<li>
									<input type="radio" name="vote" class="radio" value="5">
									<span class="label"><label for="vote_5">Payments security </label></span>
									</li>
									<li>
									<input type="radio" name="vote" class="radio" value="6">
									<span class="label"><label for="vote_6">30-day Money Back Guarantee </label></span>
									</li>
									<li>
									<input type="radio" name="vote" class="radio" value="7">
									<span class="label"><label for="vote_7">Other.</label></span>
									</li>
									</ul>
      				 		</form>
      				 	</div>
      				 </div>
 				</div>
 		</div>
 	</div>
    </div>
 </div>
   @include('partials.footer')
</body>
</html>
