<div class="row">
	<div class="col-lg-12 mb20">
		<h4>Related Posts</h4>
	</div>

	@foreach ($relatedBlogs as $blog)
		<div class="col-md-6 col-lg-6">
			<div class="for_blog feat_property">
				<div class="thumb">

					@if($blog->image)
   
						<img class="img-whp"
							height="230px"  
							src="{{$blog->image_url }}" 
							alt="{{$blog->title }}">
					@else
					    <img class="img-whp"

					      height="230px" 
						  src="{{$blog->default_img }}"
						  alt="{{ $blog->title }}">	

					@endif

					
					<div class="blog_tag">{{$blog->category->title}}</div>

				</div>

				<div class="details">
				<div class="tc_content">

	
					<h4>{{$blog->short_title}}</h4>
					<ul class="bpg_meta">
						<li class="list-inline-item"><a href="#"><i class="flaticon-calendar"></i></a></li>
						<li class="list-inline-item"><a href="#">{{$blog->dateDisplay()}}</a></li>
					</ul>
					<p>{{$blog->small_body}}</p>
				</div>
				<div class="fp_footer">
		
					<ul class="fp_meta float-left mb0">

						@if($blog->profile_url)
							<li class="list-inline-item">					
								<a href="{{ route('blog.author', $blog->author->slug) }}">
									<img  style="max-height: 40px; max-width: 40px"
									src="{{$blog->profile_url}}" 
									alt="{{$blog->full_name}}
									">
								</a>
							</li>
						@else
							<li class="list-inline-item">					
								<a href="{{ route('blog.author', $blog->author->slug) }}">
									<img style="max-height: 40px; max-width: 40px"
									src="{{$blog->default_profile}}" 
									alt="{{$blog->full_name}}">
								</a>
							</li>

						@endif

						<li class="list-inline-item">
							<a href="#">{{$blog->full_name}}</a>
						</li>
						
					</ul>
					<a class="fp_pdate float-right text-thm" 
					    href="{{ route('blog.detail', $blog->slug)}}">
						Read More 
						<span class="flaticon-next"></span>
					</a>
				</div>
			</div>
				
			</div>
		</div>
	@endforeach	
	
</div>