@extends('layouts.back_end.admin_layout')

@section('title', 'Madalali4u | Edit Admin Role')

@section('admin_content')

<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
        <div class="row g-2 align-items-center">
              <div class="col">

                <h2 class="page-title">
                  Edit Admin Role
                </h2>
                <div class="text-muted mt-1"><a href="{{ url('/admin/dashboard') }}"> Dashboard</a> > Edit Admin Role</div>


              </div>
                <!-- Page title actions -->
              <div class="col-12 col-md-auto ms-auto d-print-none">
                <div class="btn-list">
                  <a href="{{ route('admin.admin_role.index')}}" class="btn btn-primary d-none d-sm-inline-block">
                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                    <i class="ti ti-eye"></i>
                    All Roles
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

               {!! Form::model($role, [

                            'method' => 'PUT',
                            'route'  => ['admin.admin_role.update', $role->id],
                            'files'  => TRUE,
                            'id' => 'role-form'
                        ]) 

               !!}

              @include('admin.admin_role.form')

              {!! Form::close() !!}
              
            </div>

      </div>
          
 </div>   


@include('layouts.back_end.footer')

@endsection

@section('script')
    
    @include('admin.admin_role.script')
    
@endsection