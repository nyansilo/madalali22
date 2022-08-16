<div class="sidebar_feature_listing">
		<h4 class="title">Popular Blog</h4>

		@foreach ($popularBlogs as $blog)
			<div class="media">

				@if($blog->image)
				   
					<img class="align-self-start mr-3"
						height="70px" width="80px" 
						src="{{$blog->image_url }}" 
						alt="{{$blog->title }}">
				@else
				    <img class="align-self-start mr-3"

				      height="70px" width="80px" 
					  src="{{$blog->default_img }}"
					  alt="{{ $blog->title }}">	

				@endif

				<div class="media-body">
			    	<h5 class="mt-0 post_title">{{$blog->medium_title}}</h5>
			    	
			    	<ul class="mb0">
			    		<li class="list-inline-item">{{$blog->dateDisplay()}}</li>
			    	</ul>
				</div>
			</div>
		@endforeach
		
</div>