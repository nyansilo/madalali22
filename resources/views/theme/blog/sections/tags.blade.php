<div class="blog_tag_widget">
	<h4 class="title">Tags</h4>
	<ul class="tag_list">

		@foreach($tags as $tag)
			<li class="list-inline-item">
				<a href="{{ route('blog.tag', $tag->slug) }}">
					{{ $tag->name }}
				</a>			
			</li>                
        @endforeach
		
	</ul>
	 
</div>