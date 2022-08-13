<!-- Feature Properties -->
	<section id="feature-property" class="feature-property-home6 pb20 pt40 bb1">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="main-title mb40">
						<h2>Featured Properties</h2>
						<p>Handpicked properties by our team. <a class="float-right" href="{{ route('featured') }}">View All <span class="flaticon-next"></span></a></p>
					</div>
				</div>

				@if(!$featuredProperties->count())


					<div class="col-lg-12">
					    <div class="alert alart_style_four alert-dismissible fade show" role="alert">
							Nothing Found for now, please try again later.
							{{--<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>--}}
					    </div>
					</div>


			    @else

						<div class="col-lg-12">
							<div class="feature_property_home6_slider">
								@foreach($featuredProperties as $property)

									<div class="item">
										<div class="properti_city home6">
											<div class="thumb">
												@if($property->propertyImages->count() > 0)
												{{--<img class="w100" src="/img/{{ $property->propertyImages[0]->image }}" height="300"alt="">
												--}}

												<img class="w100" src="{{ $property->image_url }}" height="300"alt="">
												@else
												<img src="{{ $property->default_img }}" height="300"alt="">	
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
															<li class="list-inline-item featured" >
																<a href="">Featured</a>
															</li>
														@endif	
													</ul>
												</div>
											</div>
											<div class="overlay">
												<div class="details">
													<a class="fp_price" 
													    href="{{ route('property.detail', $property->slug) }}">
														<span style="font-size: 17px !important;">Tsh {{ $property->price }}<span>
														@if($property->type == 'Rent')
														    <small>/mo</small>
														@endif    
													</a>

													<ul class="prop_details mb0" style="float: right; padding-right: 15px;">

													<li class="list-inline-item">
														<a href="#">
															<span class="flaticon-heart">
															</span>
														</a>
													</li>
												</ul>
													<h4><a style="color:white;" href="{{ route('property.detail', $property->slug) }}">{{ $property->short_title }}<span style="float: right; color: red; padding-right: 15px;"><b>more</b></span>
													   </a>
													</h4>

													@if($property->category->title == 'Land')
														<ul class="prop_details mb0">
															<li class="list-inline-item">
																<a href="#">
																	Sq Mt: {{$property->area}}
																</a>
															</li>
														</ul>
													@elseif($property->category->title== 'Vehicles')
													   <ul class="prop_details mb0">
															<li class="list-inline-item">
																
																	<a href="#">
																	   {{$property->brand}} | {{$property->coverage}} km | {{$property->engine_capacity}} cc ...
																    </a>
																			  		 
															  </li>
														</ul>
													@elseif($property->category->title== 'Commercials')
														<ul class="prop_details mb0">
															<li class="list-inline-item">
																<a href="#">
																	Sq Mt: {{$property->area}}
																</a>
															</li>
														</ul>	
													@else
														<ul class="prop_details mb0">
																<li class="list-inline-item">
																<a href="#">
																	Beds: {{$property->bed}}
																</a>
															</li>
															<li class="list-inline-item">
																<a href="#">
																	Baths: {{$property->bath}}
																</a>
															</li>
														</ul>
													@endif			


												</div>
											</div>
										</div>
									</div>

								@endforeach

							</div>
						</div>

					
			    @endif	

			</div>
		</div>
</section>