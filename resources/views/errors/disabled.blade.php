<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>User was disabled!</title>
	<style type="text/css" media="screen">
		.complete {
			font-family: 'Century Gothic', CenturyGothic, AppleGothic, sans-serif;
			text-align: center;
			margin-top: 220px;
		}

		h1, h2, h3 {
			font-weight: 200;
		}

		h1 {
			font-size: 60px;
		}

		h2 {
			font-size: 30px;
			margin-top: -20px;
		}
	</style>
	<script type="text/javascript">
		var count=7;
		var counter=setInterval(timer, 1000); //1000 will  run it every 1 second
		function timer()
		{
		  count=count-1;
		  if (count <= 0)
		  {
		     clearInterval(counter);
		     return;
		  }

		  document.getElementById("timer").innerHTML="This page will be redirected after "+ count + " secs"; 
		}
	</script>
</head>
<body>
<?php
header('refresh:7; url=http://localhost:8080/electronicstore/logout');
?>
	<div class="complete">
		
		<img src="{{ asset('public/images/logo.png') }}" alt="" width="125" height="auto">
		<h1>User {{ Auth::user()->name }} was disabled by our Administrator!</h1>
		<h2>This user was no longer our customer!</h2>
		<span id="timer"></span>
		<h3>We are sorry about that!</h3>
	</div>
</body>
</html>