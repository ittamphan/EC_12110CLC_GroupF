<div class="col-sm-12">
<a href="{{ route('show.profile', Auth::user()->id) }}"><i class="fa fa-arrow-left"></i>   Back to Profile!</a>
	<div class="table-responsive">
		<table class="table table-hover table-color">
			<thead>
				<tr>
					<th>Comment's number</th>
					<th>Product's ID</th>
					<th>Nickname</th>
					<th>Title</th>
					<th>Content</th>
					<th>Created at</th>
				</tr>
			</thead>
			<tbody>
			@if(count($comments))
			@foreach($comments as $comment)
				<tr>
					<td>{{ $comment->id }}</td>
					<td>{{ $comment->product_id }}</td>
					<td>{{ $comment->nickname }}</td>
					<td>{{ $comment->heading }}</td>
					<td>{{ $comment->content }}</td>
					<td>{{ $comment->created_at }}</td>
				</tr>
			@endforeach
			@endif
			</tbody>
		</table>
	</div>
</div>