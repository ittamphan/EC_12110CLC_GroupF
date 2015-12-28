<div class="row mtbox">
	<div class="col-md-2 col-sm-2 col-md-offset-1 box0">
		<div class="box1">
			<span class="li_user"></span>
			<h3>{{ $user_count }}</h3>
		</div>
			<p>Ok! There are <b>{{ $user_count }}</b> user(s) in your database.</p>
	</div>
	<div class="col-md-2 col-sm-2 box0">
		<div class="box1">
			<span><i class="fa fa-cubes fa-1x"></i></li></span>
			<h3>{{ $product_count }}</h3>
		</div>
			<p>There are <b>{{ $product_count }}</b> products in your database. AWESOME!</p>
	</div>
	<div class="col-md-2 col-sm-2 box0">
		<div class="box1">
			<span><i class="fa fa-book fa-1x"></i></span>
			<h3>{{ $brand_count }}</h3>
		</div>
			<p>You have <b>{{ $brand_count }}</b> brands in your database.</p>
	</div>
	<div class="col-md-2 col-sm-2 box0">
		<div class="box1">
			<span><i class="fa fa-circle-o fa-1x"></i></span>
			<h3>{{ $type_count }}</h3>
		</div>
			<p>And about <b>{{ $type_count }}</b> types are in your database too. Cool!</p>
	</div>
	<div class="col-md-2 col-sm-2 box0">
		<div class="box1">
			<span><i class="fa fa-file-text-o fa-1x"></i></span>
			<h3>{{ $order_count }}</h3>
		</div>
			<p>There are {{ $order_count }} orders in your database. AWESOME!</p>
	</div>
</div><!-- /row mt -->	
<div class="row mt">
	  <div class="col-md-12">
	      <div class="content-panel">
	          <table class="table table-striped table-advance table-hover">
	      	  	  <h4><font color="#ff9f1c"><i class="fa fa-warning fa-2x">Warning!</font></i> There are {{ count($low_quantity)}} products with low quantity</h4>
	      	  	  <hr>
	              <thead>
	              <tr>
	                  <th><i class="fa fa-bullhorn"></i> ID</th>
	                  <th class="hidden-phone"><i class="fa fa-question-circle"></i> Product name</th>
	                  <th><i class="fa fa-bookmark"></i> Quantity</th>
	                  <th><i class=" fa fa-edit"></i> Status</th>
	                  <th></th>
	              </tr>
	              </thead>
	              <tbody>
	              @foreach($low_quantity as $low)
	              <tr>
	                  <td><a href="basic_table.html#">{{ $low->id }}</a></td>
	                  <td class="hidden-phone">{{ $low->product_name }}</td>
	                  <td><span class="label label-danger label-mini">{{ $low->quantity }}</span></td>
	                  <td><span class="label label-warning label-mini">Low</span></td>
	                  <td>
	                      <a href="{{ route('admin.productEdit', $low->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
	                  </td>
	              </tr>
	              @endforeach
	              </tbody>
	          </table>
	      </div><!-- /content-panel -->
	  </div><!-- /col-md-12 -->
	</div><!-- /row -->