 <div id="table-default">

          <table class="table">
            <thead>
              <tr>
                <th><button class="table-sort" data-sort="sort-name">Action</button></th>
                <th><button class="table-sort" data-sort="sort-city">Role Name</button></th>
                <th><button class="table-sort" data-sort="sort-city">Role Permissions</button></th>
                <th><button class="table-sort" data-sort="sort-type">Permissions Count</button></th>
                
              </tr>
            </thead>


      
                <tbody class="table-tbody">

             


                        @foreach($roles as $role)
                        <tr>
                            <td class="sort-name"  width="140">
                              {!! Form::open(['method' => 'DELETE', 'route' => ['admin.admin_role.destroy', $role->id]]) !!}
                                
                                <a href="{{ route('admin.admin_role.edit', $role->id) }}" class="btn btn-outline-info w-30">

                                     <i class="fa fa-pencil"></i>
                                     {{--<i class="ti ti-pencil"></i>--}}

                                </a>

                                 @if($role->id == config('cms.default_role_id'))
                                
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
                            <td class="sort-city">
                                @if($role->slug == 'admin')

                                    <span class="badge badge-sm bg-red text-uppercase ms-2">      {{ $role->name }}
                                    </span>
                                
                                @else
                                   <span class="badge badge-sm bg-gray text-uppercase ms-2">
                                       {{ $role->name }}
                                    </span>
                                @endif
                            </td>
                            <td class="sort-city">

                              <?php $links = [] ?>
                                @if ($role->permissions != null)
                                   @foreach($role->permissions as $permission)
                                       
                                            <?php 
                                            $links[] = 
                                            "<span class=\"badge badge-sm bg-blue text-uppercase ms-2\">"." {$permission->name}</span>"?>
                                      
                                    @endforeach
                                @endif 
                              {!! implode(' ', $links) !!}
                            </td>

                            <td class="sort-type">
                              <span class="badge badge-sm bg-green text-uppercase ms-2">
                                       {{ $role->permissions->count() }}
                              </span>
                              
                            </td>
                          
                            
                        </tr>
                        @endforeach
                  
                </tbody>


          </table>

        </div>