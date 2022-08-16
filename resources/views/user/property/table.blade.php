  <div class="col-lg-12">


                   
                      

            
      <div class="my_dashboard_review mb40">


        <div class="mb10">

          <?php $links = [] ?>
          @foreach($statusList as $key => $value)
              @if($value)
                  <?php $selected = Request::get('status') == $key ? 'selected-status' : '' ?>
                  <?php $links[] = "<a class=\"{$selected}\" href=\"?status={$key}\">" . ucwords($key) . "({$value})</a>" ?>
              @endif
          @endforeach
          {!! implode(' | ', $links) !!}
          
        </div>
         

        <div class="property_table">
          <div class="table-responsive mt0">
            <table class="table">
              <thead class="thead-light">
                  <tr>
                    <th scope="col">Listing Title</th>
                    <th scope="col">Date Created</th>
                    <th scope="col">Status</th>
                    <th scope="col">View</th>
                    <th scope="col">Action</th>
                  </tr>
              </thead>
              <tbody>

                   <?php $request = request(); ?>


                   @foreach($properties as $property)
                      <tr>
                        <th scope="row">
                        <div class="feat_property list favorite_page style2">
                          <div class="thumb">



                            @if($property->propertyImages->count() > 0)

                              <img class="img-whp" height="150px" width="170px" 
                              src="/img/{{$property->propertyImages[0]->image}}" 
                              alt="{{$property->title}}">

                            @else 

                              <img class="img-whp" height="150px" width="170px" 
                              src="{{ $property->default_img }}"  
                              alt="{{$property->title}}">
                                    
                            @endif



                            <div class="thmb_cntnt">
                              <ul class="tag mb0">
                                <li class="list-inline-item dn"></li>
                                  <li class="list-inline-item type">
                                      <a href="{{ route(strtolower($property->type)) }}">For {{ $property->type}}
                                     </a>
                                  </li>
                              </ul>
                            </div>
                          </div>
                          <div class="details">
                            <div class="tc_content">
                              <h4>{{$property->short_title}}</h4>
                              <p><span class="flaticon-placeholder"></span>
                                  {{$property->short_address}}
                              </p>
                              <a class="fp_price text-thm" href="{{ route('property.detail', $property->slug)}}">
                                Tsh  {{$property->price}}
                                @if($property->type == 'Rent')
                                      <small>/mo</small>
                                @endif 
                           
                              </a>
                            </div>
                          </div>
                        </div>
                        </th>
                        <td>{{$property->dateDisplay()}}</td>
                        <td>{!! $property->publicationLabelUser() !!}</td>
                        <td>{{$property->view_count}}</td>
                        <td>
                          <ul class="view_edit_delete_list mb0">
                            <li class="list-inline-item" data-toggle="tooltip" data-placement="top" title="Edit"><a href="#"><span class="flaticon-edit"></span></a></li>
                            <li class="list-inline-item" data-toggle="tooltip" data-placement="top" title="Delete"><a href="#"><span class="flaticon-garbage"></span></a></li>
                          </ul>
                        </td>
                      </tr>
                   @endforeach   
                 
              </tbody>
            </table>
          </div>
          <div class="mbp_pagination">
            <ul class="page_navigation">
                <li class="page-item disabled">
                  <a class="page-link" href="#" tabindex="-1" aria-disabled="true"> <span class="flaticon-left-arrow"></span> Prev</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item active" aria-current="page">
                  <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                </li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">...</a></li>
                <li class="page-item"><a class="page-link" href="#">29</a></li>
                <li class="page-item">
                  <a class="page-link" href="#"><span class="flaticon-right-arrow"></span></a>
                </li>
            </ul>
          </div>
        </div>

        
      </div>
    </div>