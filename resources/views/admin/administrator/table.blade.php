 <div id="table-default">

          <table class="table">
            <thead>
              <tr>
                <th><button class="table-sort" data-sort="sort-name">Action</button></th>
                <th><button class="table-sort" data-sort="sort-city">Name</button></th>
                <th><button class="table-sort" data-sort="sort-type">Role</button></th>
                <th><button class="table-sort" data-sort="sort-type">Permissions</button></th>
                <th><button class="table-sort" data-sort="sort-type">Post Count</button></th>
                
              </tr>
            </thead>


      
                <tbody class="table-tbody">

                 <?php $currentUser = auth()->user(); ?>


                        @foreach($admins as $admin)
                        <tr>
                            <td class="sort-name"  width="140">
                            
                                
                                <a href="{{ route('admin.administrator.edit', $admin->id) }}" class="btn btn-outline-info w-30">

                                     <i class="fa fa-pencil"></i>
                                     {{--<i class="ti ti-pencil"></i>--}}

                                </a>

                    

                                 @if($admin->id == config('cms.default_admin_id'|| $admin->id == $currentUser->id))
                                
                                        <button onclick="return false"type="submit" class="btn btn-outline-danger disabled w-30"> 
                                              <i class="fa fa-times"></i>
                                              {{--<i class="ti ti-trash"></i>--}}
                                        </button>

                                   @else

                                        <a href="{{ route('admin.administrator.confirm', $admin->id)}}" class="btn btn-outline-danger w-30"> 
                                          <i class="fa fa-times"></i>
                                          {{--<i class="ti ti-trash"></i>--}}
                                        </a>

                                     @endif    
                                     



                            </td>
                            <td class="sort-city">
                              {{ $admin->full_name }}
                            </td>
                            

                            <td class="sort-city">
                               @if ($admin->roles->isNotEmpty())
                                  @foreach ($admin->roles as $role)
                                      <span class="badge badge-secondary">
                                          {{ $role->name }}
                                      </span>
                                  @endforeach
                               @endif
                            </td>

                            <td class="sort-city">
                              
                              @if ($admin->permissions->isNotEmpty())
                                        
                                  @foreach ($admin->permissions as $permission)
                                      <span class="badge badge-secondary">
                                          {{ $permission->name }}                                    
                                      </span>
                                  @endforeach
                              @else   
                              
                                   <span class="badge badge-primary">
                                          No permission assigned            
                                    </span> 
                              
                              @endif

                            </td>


                            <td class="sort-type">{{ $admin->blogs->count() }}</td>
                          
                            
                        </tr>
                        @endforeach
                  
                </tbody>


          </table>

        </div>