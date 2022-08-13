 <div id="table-default">

          <table class="table">
            <thead>
              <tr>
                <th><button class="table-sort" data-sort="sort-name">Action</button></th>
                <th><button class="table-sort" data-sort="sort-city">Title</button></th>
                <th><button class="table-sort" data-sort="sort-type">Owner</button></th>
                <th><button class="table-sort" data-sort="sort-score">Category</button></th>
                <th><button class="table-sort" data-sort="sort-date">Date</button>
              </tr>
            </thead>


      
                <tbody class="table-tbody">

                   <?php $request = request(); ?>


                        @foreach($properties as $property)
                        <tr>
                            <td class="sort-name"  width="140">
                              {!! Form::open(['method' => 'DELETE', 'route' => ['admin.property.destroy', $property->id]]) !!}
                                
                                <a href="{{ route('admin.property.edit', $property->id) }}" class="btn btn-outline-info w-30">

                                     <i class="fa fa-pencil"></i>
                                     {{--<i class="ti ti-pencil"></i>--}}

                                </a>
                                
                                <button type="submit" class="btn btn-outline-danger w-30">
                                  <a href="{{ route('admin.property.destroy', $property->id) }}" >
                                      <i class="fa fa-trash"></i>
                                      {{--<i class="ti ti-trash"></i>--}}

                                  </a>
                                </button>

                                 {!! Form::close() !!}


                            </td>
                            <td class="sort-city">{{ $property->title }}</td>
                            <td class="sort-type">{{ $property->owner->user_name }}</td>
                            <td class="sort-score">{{ $property->category->title }}</td>
                            <td class="sort-date"  width="190" data-date="1628071164">
                                <abbr title="{{ $property->dateFormatted(true) }}">{{ $property->dateFormatted() }}</abbr> |
                                {!! $property->publicationLabel() !!}
                            </td>
                        </tr>
                        @endforeach
                  
                </tbody>


          </table>

        </div>