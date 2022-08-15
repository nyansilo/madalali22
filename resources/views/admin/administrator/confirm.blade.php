@extends('layouts.back_end.admin_layout')

@section('title', 'Madalali4u | Delete Confirmation')

@section('admin_content')

<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
        <div class="row g-2 align-items-center">
              <div class="col">

                <h2 class="page-title">
                  Delete Confirmation
                </h2>
                <div class="text-muted mt-1"><a href="{{ url('/admin/dashboard') }}"> Dashboard</a> > Delete Confirmation</div>


              </div>
                <!-- Page title actions -->
              <div class="col-12 col-md-auto ms-auto d-print-none">
                <div class="btn-list">
                  <a href="{{ route('admin.administrator.index')}}" class="btn btn-primary d-none d-sm-inline-block">
                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                    <i class="ti ti-eye"></i>
                    All Admins
                  </a>
                  <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#modal-report" aria-label="Create new report">
                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                  </a>
                </div>
          </div>
        </div>
    </div>

</div>

      
<!-- Page body actions -->

<div class="page-body">

    <div class="container-xl">


        <div class="row row-cards">

               {!! Form::model($admin, [

                            'method' => 'DELETE',
                            'route'  => ['admin.administrator.destroy',$admin->id],
                            
                        ]) 

               !!}

              <div class="col-md-8">

                    <div class="card mb-3">

                        <div class="card-body">

                              <p>
                                  You have specified this user for deletion:
                              </p>
                              <p>
                                  ID #{{ $admin->id }}: {{ $admin->full_name }}
                              </p>
                              <p>
                                  What should be done with content own by this user?
                              </p>
                              <p>
                                  <input type="radio" name="delete_option" value="delete" checked> Delete All Content
                              </p>

                              <p>
                                  <input type="radio" name="delete_option" value="attribute"> Attribute content to:
                                  {!! Form::select('selected_admin', $admins, null) !!}
                              </p>
                                    

                              <div class="card-footer text-end">

                                    <div class="d-flex">

                                       <button type="submit"  class="btn btn-danger ">Confirm Deletion
                                       </button>

                                        <a href="{{ route('admin.administrator.index') }}"  class="btn btn-default ms-auto">Cancel
                                        </a>

                                    </div>

                              </div>

                        </div>

                   </div>

              </div> 

             

              {!! Form::close() !!}
              
        </div>

    </div>


    @include('layouts.back_end.footer')
          
 </div>   




@endsection

@section('script')
    
    @include('admin.administrator.script')
    
@endsection