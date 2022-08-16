<div class="product_single_content mb30" id="post-comment">
	<div class="mbp_pagination_comments">
		<div class="total_review">
			<h4>{{ $blog->commentsNumber('COMMENT') }}</h4>	
		</div>
		@foreach($blogComments as $comment)
		<div class="mbp_first media">

			@if($blog->profile_url)
										
					<a href="#">
						<img class="mr-3" style="max-height: 70px; max-width: 70px"
						src="{{$comment->blog->profile_url}}" 
						alt="{{$comment->blog->full_name}}
						">
					</a>
				
				@else
									
					<a href="#">
						<img class="mr-3" style="max-height: 70px; max-width: 70px"
						src="{{$comment->blog->default_profile}}" 
						alt="{{$comment->blog->full_name}}">
					</a>
				

			@endif
			
			<div class="media-body">
		    	<h4 class="sub_title mt-0">{{ $comment->author_name }}
		    	</h4>
		    	<a class="sspd_postdate fz14" href="#">{{$comment->dateDisplay()}}</a>
		    	<p class="fz14 mt10">{!! $comment->body_html !!}</p>
			</div>
		</div>
		<div class="custom_hr"></div>
		@endforeach

		
	</div>

	{!! $blogComments->links() !!}
		


</div>

<div class="bsp_reveiw_wrt">
	<h4>Write a Comment</h4>
	
{!! Form::open(['route' => ['blog.comment', $blog->slug], 'class'=>'comment-form']) !!}
		<div class="form-group {{ $errors->has('author_name') ? 'has-error' : '' }}">
    
            {!! Form::text('author_name', null, ['class' => 'form-control','placeholder' => 'Name*', 'aria-describedby'=>"textHelp"]) !!}
            @if($errors->has('author_name'))
                <span class="help-block">
                    <strong>{{ $errors->first('author_name') }}</strong>
                </span>
            @endif
        </div>


		<div class="form-group {{ $errors->has('author_email') ? 'has-error' : '' }}">
    
            {!! Form::text('author_email', null, ['class' => 'form-control','placeholder' => 'Email*', 'aria-describedby'=>"textHelp"]) !!}
            @if($errors->has('author_email'))
                <span class="help-block">
                    <strong>{{ $errors->first('author_email') }}</strong>
                </span>
            @endif
        </div>

	    <div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
           
                {!! Form::textarea('body', null, ['row' => 6, 'class' => 'form-control','placeholder' => 'Your comment*', 'id'=>"exampleFormControlTextarea1"]) !!}
                @if($errors->has('body'))
                    <span class="help-block">
                        <strong>{{ $errors->first('body') }}</strong>
                    </span>
                @endif
        </div>

		<button type="submit" class="btn btn-thm">Submit Comment</button>
 {!! Form::close() !!} 
</div>
