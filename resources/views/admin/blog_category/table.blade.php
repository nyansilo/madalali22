 <div id="table-default">

          <table class="table">
            <thead>
              <tr>
                <th><button class="table-sort" data-sort="sort-name">Action</button></th>
                <th><button class="table-sort" data-sort="sort-city">Category Title</button></th>
                <th><button class="table-sort" data-sort="sort-type">Post Count</button></th>
                
              </tr>
            </thead>


      
                <tbody class="table-tbody">

             


                        @foreach($categories as $category)
                        <tr>
                            <td class="sort-name"  width="140">
                              {!! Form::open(['method' => 'DELETE', 'route' => ['admin.blog_category.destroy', $category->id]]) !!}
                                
                                <a href="{{ route('admin.blog_category.edit', $category->id) }}" class="btn btn-outline-info w-30">

                                     <i class="fa fa-pencil"></i>
                                     {{--<i class="ti ti-pencil"></i>--}}

                                </a>

                                 @if($category->id == config('cms.default_category_id'))
                                
                                        <button onclick="return false"type="submit" class="btn btn-outline-danger w-30"> 
                                              <i class="fa fa-times"></i>
                                              {{--<i class="ti ti-trash"></i>--}}
                                        </button>

                                   @else

                                        <button onclick="return confirm('Are you sure?');" type="submit" class="btn btn-outline-danger w-30"> 
                                          <i class="fa fa-times"></i>
                                          {{--<i class="ti ti-trash"></i>--}}
                                        </button>

                                     @endif    
                                     

                                 {!! Form::close() !!}


                            </td>
                            <td class="sort-city">{{ $category->title }}</td>
                            <td class="sort-type">{{ $category->blogs->count() }}</td>
                          
                            
                        </tr>
                        @endforeach
                  
                </tbody>


          </table>

        </div>