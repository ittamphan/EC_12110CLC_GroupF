<table class="table table-hover">
<caption><h3><u>Managing your products!</u></h3></caption>
	<thead>
		<tr>
			<th>ID</th>
			<th style="text-align: center">Image</th>
			<th>Name</th>
			<th>Brand</th>
			<th>Type</th>
			<th>Price</th>
			<th>Quantity</th>
			<th>Feature product</th>
			<th>Is disable</th>
			<th style="text-align: center">Actions</th>
		</tr>
	</thead>
	<tbody>
	<?php $i = 0 ?>
	@foreach($products as $product)
		<tr>
			<td>{{ $product->id }}</td>
			<td><img src="{{ asset('public/images/product_images/' .$product->image1) }}" alt="Product Image"
			 title="{{ $product->product_name }}" width="135" height="auto"></td>
			<td>{{ str_limit($product->product_name, 15) }}</td>
			<td>{{ $product->brand_id }}</td>
			<td>{{ $product->type_id }}</td>
			<td>{{ number_format($product->price, 0, ',', ',') }} &#8363;</td>
			<td>{{ $product->quantity }}</td>
			<td style="text-align: center">
			@if($product->is_feature == 0)
				<a href="{{ route('admin.is_feature', $product->id) }}"><i class="fa fa-ellipsis-h"></i></a>
			@else
				<a href="{{ route('admin.is_feature', $product->id) }}"><i class="fa fa-star feature-color"></i></a>
			@endif
			</td>
			<td>
			@if($product->is_disabled == 0)
				<a href="{{ route('admin.is_disabled', $product->id) }}"><i class="fa fa-times-circle-o"></i> Not disabled</a>
			@else
				<a href="{{ route('admin.is_disabled', $product->id) }}"><i class="fa fa-check disabled-color"></i> <font color="#ef233c">Disabled</font></a>
			@endif
			</td>
			<td>
	            <a href="{{ route('admin.productEdit', $product->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
			</td>
		</tr>
	@endforeach
	</tbody>
</table>
<div class="col-sm-8 col-sm-offset-4">
	<div>{!! $products->render() !!}</div>
</div>