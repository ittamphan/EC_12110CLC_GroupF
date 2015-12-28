<div class="row mt chart">
@foreach($top_users as $top_user)
	<div class="col-md-4 mb">
		<!-- WHITE PANEL - TOP USER -->
		<div class="white-panel pn">
			<div class="white-header">
				<h5>TOP 3 USERs</h5>
			</div>
			<p><img src="{{ asset('public/assets-admin/img/'.$top_user->profile_pic) }}" class="img-circle" width="80"></p>
			<p><b>{{ $top_user->name }}</b></p>
			<div class="row">
				<div class="col-md-6">
					<p class="small mt">MEMBER SINCE</p>
					<p>{{ $top_user->created_at }}</p>
				</div>
				<div class="col-md-6">
					<p class="small mt">TOTAL SPEND</p>
					<p>{{ number_format($top_user->total_price, 0, ',', ',') }} &#8363;</p>
				</div>
			</div>
		</div>
	</div><!-- /col-md-4 -->
@endforeach
</div>