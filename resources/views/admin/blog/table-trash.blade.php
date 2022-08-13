 <div id="table-default">

          <table class="table">
            <thead>
              <tr>
                <th><button class="table-sort" data-sort="sort-name">Action</button></th>
                <th><button class="table-sort" data-sort="sort-city">Title</button></th>
                <th><button class="table-sort" data-sort="sort-type">Author</button></th>
                <th><button class="table-sort" data-sort="sort-score">Category</button></th>
                <th><button class="table-sort" data-sort="sort-date">Date</button>
              </tr>
            </thead>


      
                <tbody class="table-tbody">

                   <?php $request = request(); ?>


                        @foreach($blogs as $blog)
                        <tr>
                            <td class="sort-name"  width="140">

                              {!! Form::open(['style' => 'display:inline-block;','method' => 'PUT', 'route' => ['admin.blog.restore', $blog->id]]) !!}
                                
                                 <button title="Restore" class="btn btn-outline-info w-30" type="submit" >
                                    
                                    <i class="fa fa-refresh"></i>

                                  </button>

                                {!! Form::close() !!}
                                
                                    
                                {!! Form::open(['style' => 'display:inline-block;', 'method' => 'DELETE', 'route' => ['admin.blog.force-destroy', $blog->id]]) !!}
                                 <button title="Delete Permanent" onclick="return confirm('You are about to delete a post permanently. Are you sure?')" type="submit" type="submit" class="btn btn-outline-danger w-30">
                                   {{--<i class="ti ti-trash"></i>--}}
                                    <i class="fa fa-times"></i>
                                 </button>
                              

                                {!! Form::close() !!}


                            </td>
                            <td class="sort-city">{{ $blog->title }}</td>
                            <td class="sort-type">{{ $blog->author->user_name }}</td>
                            <td class="sort-score">{{ $blog->category->title }}</td>
                            <td class="sort-date"  width="190" data-date="1628071164">
                                <abbr title="{{ $blog->dateFormatted(true) }}">{{ $blog->dateFormatted() }}</abbr> 
                            </td>
                        </tr>
                        @endforeach
                  
                </tbody>


          </table>

        </div>