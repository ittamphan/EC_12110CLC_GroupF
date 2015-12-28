<div class="col-sm-12">
<a href="{{ route('show.profile', Auth::user()->id) }}"><i class="fa fa-arrow-left"></i>   Back to Profile!</a>
	<div class="table-responsive">
		<table class="table table-hover table-color">
			<thead>
				<tr>
					<th>No</th>
					<th>Image</th>
					<th>Product's ID</th>
					<th>Product's name</th>
					<th>Brand</th>
					<th>Type</th>
					<th>Created at</th>
					<th>Remove</th>
				</tr>
			</thead>
			<tbody>
			@if(count($items))
			@foreach($items as $item)
				<tr>
					<td>{{ $item->id }}</td>
					<td>
						@foreach($products as $product)
						@if($product->id == $item->product_id)
						<a href="{{ route('detail', $item->product_id) }}"><img src="{{ asset('public/images/product_images/'.$product->thumbnail1) }}" alt=""></a>
						@endif
						@endforeach
					</td>
					<td>{{ $item->product_id }}</td>
					<td>
						@foreach($products as $product)
						@if($product->id == $item->product_id)
						<a href="{{ route('detail', $item->product_id) }}">{{ $product->product_name }}</a>
						@endif
						@endforeach
					</td>
					<td>
						@foreach($brands as $brand)
						@if($brand->id == $item->brand_id)
						{{ $brand->brand_name }}
						@endif
						@endforeach
					</td>
					<td>
						@foreach($types as $type)
						@if($type->id == $item->type_id)
						{{ $type->type_name }}
						@endif
						@endforeach
					</td>
					<td>{{ $item->created_at }}</td>
					<td>
						<form action="{{ route('deleteWishlistItem', $item->id) }}" method="POST">
							<input type="hidden" name="_method" value="DELETE">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<button type="submit" class="btn btn-xs btn-danger fa fa-trash-o"></button>
						</form>
					</td>
				</tr>
			@endforeach
			@endif
			</tbody>
		</table>
	</div>
</div>