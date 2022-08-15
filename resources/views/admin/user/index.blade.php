@extends('layouts.back_end.admin_layout')

@section('title', 'Madalali4u | All Users')

@section('admin_content')

<div class="container-xl"> 
    
    <div class="row g-2 align-items-center">

        
              <div class="col">


                  <h2 class="page-title">
                    Display All Users
                  </h2>
                  <div class="text-muted mt-1"><a href="{{ url('/admin/dashboard') }}"> Dashboard</a> > Users
                  </div>

               
              </div>


                <!-- Page title actions -->
              <div class="col-12 col-md-auto ms-auto d-print-none">
                <div class="btn-list">
                  <a href="{{ route('admin.user.create')}}" class="btn btn-primary d-none d-sm-inline-block" >
                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                   Create User
                  </a>
                  
                </div>

                
         
        </div>
    </div>

</div>

      
<!-- Page body actions -->

<div class="page-body">

      <div class="container-xl">
         
            <div class="card">

                <div class="card-body">

                      @include('admin.user.message')

                      @if (! $users->count())
                          <div class="alert alert-danger">
                              <strong>No record found</strong>
                          </div>
                      @else
                          @include('admin.user.table')
                      @endif

                </div>

                <div class="card-footer d-flex align-items-center">
                        <p class="m-0 text-muted">Showing 
                          <span>{{ $users->firstItem() }}</span> to <span>{{ $users->lastItem() }} </span> of <span> {{$users->total()}} entries</span>
                        </p>

                        {{ $users->appends( Request::query() )->links('vendor.pagination.admin') }}
                  </div>

             </div>

       </div>

</div>



@include('layouts.back_end.footer')

@endsection