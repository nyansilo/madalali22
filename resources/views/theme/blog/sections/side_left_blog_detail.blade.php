<div class="col-lg-8">

	<div class="main_blog_post_content">  

		<div class="mbp_thumb_post">
			<div class="blog_sp_tag">
				<a href="#">{{$blog->category->title}}</a>
			</div>
			<h3 class="blog_sp_title">{{$blog->title}}</h3>

			<ul class="blog_sp_post_meta">


				@if($blog->profile_url)
					<li class="list-inline-item">					
						<a href="#">
							<img  style="max-height: 40px; max-width: 40px"
							src="{{$blog->profile_url}}" 
							alt="{{$blog->full_name}}
							">
						</a>
					</li>
				@else
					<li class="list-inline-item">					
						<a href="#">
							<img style="max-height: 40px; max-width: 40px"
							src="{{$blog->default_profile}}" 
							alt="{{$blog->full_name}}">
						</a>
					</li>

				@endif

			
				<li class="list-inline-item">
					<a href="{{ route('blog.author', $blog->author->slug) }}">{{$blog->full_name}}</a>
				</li>

				<li class="list-inline-item">
					<span class="flaticon-calendar"></span>
				</li>
				<li class="list-inline-item">
					<a href="#">{{$blog->dateDisplay()}}</a>
				</li>
				<li class="list-inline-item">
					<span class="flaticon-view"></span>
				</li>
				<li class="list-inline-item">
					<a href="#"> {{ $blog->blogsView('View') }} </a>
				</li>
				<li class="list-inline-item">
					<span class="flaticon-chat"></span>
				</li>
				<li class="list-inline-item">
					<a href="#post-comment"> {{ $blog->commentsNumber('Comment') }}</a>
				</li>
			</ul>
			<div class="thumb">

				@if($blog->image)
				   
					<img class="img-fluid"
						height="380px" width="690" 
						src="{{$blog->image_url }}" 
						alt="{{$blog->title }}">
				@else
				    <img cclass="img-fluid"

				      height="380px"  width="690" 
					  src="{{$blog->default_img }}"
					  alt="{{ $blog->title }}">	

				@endif

				
			</div>
			<div class="details">
				<p class="mb30">

				{{ $blog->body }}

				</p>
			</div>
			<ul class="blog_post_share">
				<li>
					<p>Share</p>
				</li>
				<li>
					<a href="#"><i class="fa fa-facebook"></i></a>
				</li>
				<li>
					<a href="#"><i class="fa fa-twitter"></i></a>
				</li>
				<li>
					<a href="#"><i class="fa fa-linkedin"></i></a>
				</li>
				<li>
					<a href="#"><i class="fa fa-google"></i></a>
				</li>
				<li>
					<a href="#"><i class="fa fa-pinterest"></i></a>
				</li>
			</ul>
		</div>
		<div class="mbp_pagination_tab">
			<div class="row">
				<div class="col-sm-6 col-lg-6">
					<div class="pag_prev">
						<a href="#"><span class="flaticon-back"></span></a>
						<div class="detls"><h5>Previous Post</h5> <p> Housing Markets That</p></div>
					</div>
				</div>
				<div class="col-sm-6 col-lg-6">
					<div class="pag_next text-right">
						<a href="#"><span class="flaticon-next"></span></a>
						<div class="detls"><h5>Next Post</h5> <p> Most This Decade</p></div>
					</div>
				</div>
			</div>
		</div>

		@include('theme.blog.sections.blog_comment')


	</div>
					
	@include('theme.blog.sections.blog_related')

</div>