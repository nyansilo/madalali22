<!-- Recently Viewed --> 
<div class="sidebar_feature_listing">
	<h4 class="title">Recently Viewed</h4>

	@foreach ($recentViewedProperties as $property)
		<div class="media">

			@if($property->propertyImages->count() > 0)

				<img class="align-self-start mr-3" height="70px" width="80px" 
				src="/img/{{$property->propertyImages[0]->image}}" 
				alt="{{$property->title}}">

			@else 

				<img class="align-self-start mr-3" height="70px" width="80px" 
				src="{{ $property->default_img }}"  
				alt="{{$property->title}}">
			    		
			@endif

		
			<div class="media-body">
		    	<h5 class="mt-0 post_title">{{ $property->short_title }}</h5>

		    	<a href="{{ route('property.detail', $property->slug)}}">
					
					Tsh {{$property->price}}
				
					@if($property->type == 'Rent')
					    <small>/mo</small>
					@endif 
				</a>




		    	<ul class="mb0">

					@if($property->category->title == 'Lands')
					
						<li class="list-inline-item">
							Sq Mt: {{$property->area}}
					    </li>
					
					@elseif($property->category->title== 'Vehicles')
						
						<li class="list-inline-item">
						    {{$property->brand}} | {{$property->coverage}} km | {{$property->engine_capacity}} cc |
					   		{{$property->driving_type}}
						</li>
					
					@elseif($property->category->title== 'Commercials')

						<li class="list-inline-item">
							Sq Mt: {{$property->area}}
					   </li>

					@else
					
						<li class="list-inline-item">
							Beds: {{$property->bed}}
						</li>
						<li class="list-inline-item">
							Baths: {{$property->bath}}
						</li>
						<li class="list-inline-item">
							Sq Mt: {{$property->area}}	
						</li>
							
					@endif
					
				</ul>			



			</div>
		</div>
	@endforeach
	
</div>