<!-- Featured Properties -->
<div class="terms_condition_widget">
	<h4 class="title">Featured Properties</h4>
	<div class="sidebar_feature_property_slider">

		@foreach($featuredProperties  as $property)
			<div class="item">
				<div class="feat_property home7 agent">
					<div class="thumb">

						@if($property->propertyImages->count() > 0)

							<img class="img-whp"  height="200px" width="200px" 
							src="/img/{{$property->propertyImages[0]->image}}" 
							alt="{{$property->title}}">

						@else 

							<img class="img-whp" height="200px" width="200px"   
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

							<a class="fp_price" 
								href="{{ route('property.detail', $property->slug)}}">
								<span style="font-size: 15px;">
								Tsh {{$property->price}}
								</span>
								@if($property->type == 'Rent')
								    <small>/mo</small>
								@endif 
							</a>

							<h4 class="posr color-white" style="color: #ffffff !important;">
								<a href="{{ route('property.detail', $property->slug)}}">
									{{$property->short_title}}
								</a>	
							</h4>

							
						</div>
					</div>
				</div>
			</div>
		@endforeach	
		
	</div>
</div>	
