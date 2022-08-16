<!-- Similar Properties-->
<div class="col-lg-12">
	<h4 class="mt30 mb30">Similar Properties</h4>
</div>

@foreach($similarProperties  as $property)
<div class="col-lg-6">
	<div class="feat_property">
		<div class="thumb">

			@if($property->propertyImages->count() > 0)

				<img class="img-whp"  height="240px" 
				src="/img/{{$property->propertyImages[0]->image}}" 
				alt="{{$property->title}}">

			@else 

				<img class="img-whp" height="240px" 
				src="{{ $property->default_img }}" 
				alt="{{$property->title}}">
			    		
			@endif

			

			<div class="thmb_cntnt">

				<ul class="tag mb0">
										
					<li class="list-inline-item type">
						<a
						   href="{{ route(strtolower($property->type)) }}
						   ">
						   For {{ $property->type}}

						</a>
					</li>

					@if($property->is_featured == 1)
						<li class="list-inline-item featured">
							<a href="">Featured</a>
						</li>
					@endif
					
				</ul>
				
				<ul class="icon mb0">
					<li class="list-inline-item"><a href="#"><span class="flaticon-heart"></span></a></li>
				</ul>

				<a class="fp_price" 
					href="{{ route('property.detail', $property->slug)}}">
					<span style="font-size: 15px;">
					Tsh {{$property->price}}
					</span>
					@if($property->type == 'Rent')
					    <small>/mo</small>
					@endif 
				</a>


				
			</div>
		</div>
		<div class="details">
			<div class="tc_content">

				<p class="text-thm">
									
					 <span style="color: green;">Category: </span>
					
					 <b> 
					 	<a href="{{ route('property.category', $property->category->slug)}}" style="color: orangered !important;">
					 	    {{$property->category->title}}
					 	</a>
					 </b>
				</p>
				
				<h4>
					<a href="{{ route('property.detail', $property->slug)}}">
						{{$property->medium_title}}
					</a>	
				</h4>

				<p>
					<span class="flaticon-placeholder"></span> 
					{{$property->medium_address}}
				</p>


				<ul class="prop_details mb0">

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

			<div class="fp_footer">
				

				<ul class="fp_meta float-left mb0">
										
					@if($property->profile_url)
						<li class="list-inline-item">					
							<a href="{{ route('property.owner', $property->owner->slug) }}">
								<img  style="max-height: 40px; max-width: 40px"
								src="{{$property->profile_url}}" 
								alt="{{$property->full_name}}
								">
							</a>
						</li>
					@else
						<li class="list-inline-item">					
							<a href="{{ route('property.owner', $property->owner->slug) }}">
								<img style="max-height: 40px; max-width: 40px"
								src="{{$property->default_profile}}" 
								alt="{{$property->full_name}}">
							</a>
						</li>

					@endif

					<li class="list-inline-item">
						<a href="{{ route('property.owner', $property->owner->slug) }}">
							{{$property->full_name}}
						</a>
					</li>
				</ul>
				<div class="fp_pdate float-right">
					{{$property->date}}
				</div>
			</div>
		</div>
	</div>
</div>
@endforeach