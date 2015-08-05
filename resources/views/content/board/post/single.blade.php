<div class="post-content @if ($post->capcode_capcode > 0) capcode-{{{ $post->capcode_role }}} @endif">
	<a name="{!! $post->board_id !!}"></a>
	<a name="reply-{!! $post->board_id !!}"></a>
	
	@include($c->template('board.post.single.actions'))
	
	@if (isset($catalog) && $catalog === true)
		@include($c->template('board.post.single.attachments'))
		@include($c->template('board.post.single.details'))
		@include($c->template('board.post.single.post'))
	@else
		@include($c->template('board.post.single.details'))
		@include($c->template('board.post.single.attachments'))
		@include($c->template('board.post.single.post'))
	@endif
</div>