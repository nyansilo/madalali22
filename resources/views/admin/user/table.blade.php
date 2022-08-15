 <div id="table-default">

          <table class="table">
            <thead>
              <tr>
                <th><button class="table-sort" data-sort="sort-name">Action</button></th>
                <th><button class="table-sort" data-sort="sort-city">Name</button></th>
                <th><button class="table-sort" data-sort="sort-city">Email</button></th>
                <th><button class="table-sort" data-sort="sort-type">Role</button></th>
                <th><button class="table-sort" data-sort="sort-type">Permissions</button></th>
                <th><button class="table-sort" data-sort="sort-type">Post Count</button></th>
                
              </tr>
            </thead>


      
                <tbody class="table-tbody">

                 <?php $currentUser = auth()->user(); ?>


                        @foreach($users as $user)
                        <tr>
                            <td class="sort-name"  width="140">
                            
                                
                                <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-outline-info w-30">

                                     <i class="fa fa-pencil"></i>
                                     {{--<i class="ti ti-pencil"></i>--}}

                                </a>

                    

                                 @if($user->id == config('cms.default_admin_id'|| $user->id == $currentUser->id))
                                
                                        <button onclick="return false"type="submit" class="btn btn-outline-danger disabled w-30"> 
                                              <i class="fa fa-times"></i>
                                              {{--<i class="ti ti-trash"></i>--}}
                                        </button>

                                   @else

                                        <a href="{{ route('admin.user.confirm', $user->id)}}" class="btn btn-outline-danger w-30"> 
                                          <i class="fa fa-times"></i>
                                          {{--<i class="ti ti-trash"></i>--}}
                                        </a>

                                     @endif    
                                     



                            </td>
                            <td class="sort-city">
                              {{ $user->full_name }}
                            </td>
                            <td class="sort-city">
                              {{ $user->email }}
                            </td>

                            <td class="sort-city">
                              role 
                            </td>

                            <td class="sort-city">
                              permissions 
                            </td>


                            <td class="sort-type">{{ $user->properties->count() }}</td>
                          
                            
                        </tr>
                        @endforeach
                  
                </tbody>


          </table>

        </div>