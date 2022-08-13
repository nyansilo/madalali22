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
                              {!! Form::open(['method' => 'DELETE', 'route' => ['admin.blog.destroy', $blog->id]]) !!}
                                
                                <a href="{{ route('admin.blog.edit', $blog->id) }}" class="btn btn-outline-info w-30">

                                     <i class="fa fa-pencil"></i>
                                     {{--<i class="ti ti-pencil"></i>--}}

                                </a>
                                
                                <button type="submit" class="btn btn-outline-danger w-30">
                                  <a href="{{ route('admin.blog.destroy', $blog->id) }}" >
                                      <i class="fa fa-trash"></i>
                                      {{--<i class="ti ti-trash"></i>--}}

                                  </a>
                                </button>

                                 {!! Form::close() !!}


                            </td>
                            <td class="sort-city">{{ $blog->title }}</td>
                            <td class="sort-type">{{ $blog->author->user_name }}</td>
                            <td class="sort-score">{{ $blog->category->title }}</td>
                            <td class="sort-date"  width="190" data-date="1628071164">
                                <abbr title="{{ $blog->dateFormatted(true) }}">{{ $blog->dateFormatted() }}</abbr> |
                                {!! $blog->publicationLabel() !!}
                            </td>
                        </tr>
                        @endforeach
                  
                </tbody>


          </table>

        </div>