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

                              {!! Form::open(['style' => 'display:inline-block;','method' => 'PUT', 'route' => ['admin.property.restore', $property->id]]) !!}
                                
                                 <button title="Restore" class="btn btn-outline-info w-30" type="submit" >
                                    
                                    <i class="fa fa-refresh"></i>

                                  </button>

                                {!! Form::close() !!}
                                
                                    
                                {!! Form::open(['style' => 'display:inline-block;', 'method' => 'DELETE', 'route' => ['admin.property.force-destroy', $property->id]]) !!}
                                 <button title="Delete Permanent" onclick="return confirm('You are about to delete a post permanently. Are you sure?')" type="submit" type="submit" class="btn btn-outline-danger w-30">
                                   {{--<i class="ti ti-trash"></i>--}}
                                    <i class="fa fa-times"></i>
                                 </button>
                              

                                {!! Form::close() !!}


                            </td>
                            <td class="sort-city">{{ $property->title }}</td>
                            <td class="sort-type">{{ $property->owner->user_name }}</td>
                            <td class="sort-score">{{ $property->category->title }}</td>
                            <td class="sort-date"  width="190" data-date="1628071164">
                                <abbr title="{{ $property->dateFormatted(true) }}">{{ $property->dateFormatted() }}</abbr> 
                            </td>
                        </tr>
                        @endforeach
                  
                </tbody>


          </table>

        </div>