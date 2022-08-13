@extends('layouts.back_end.admin_layout')

@section('title', 'Madalali4u | All Property')

@section('admin_content')

<div class="container-xl"> 
    <!-- Page title -->
    <div class="page-header d-print-none">
        <div class="row g-2 align-items-center">
              <div class="col">


                <h2 class="page-title">
                  Display All properties
                </h2>
                <div class="text-muted mt-1"><a href="{{ url('/admin/dashboard') }}"> Dashboard</a> > Property
                </div>

               
              </div>
             
          </div>
      </div>

      <div class="row g-2 align-items-center" style="margin-top: 10px;">

              <div class="col" >
                    <?php $links = [] ?>
                    @foreach($statusList as $key => $value)
                        @if($value)
                            <?php $selected = Request::get('status') == $key ? 'selected-status' : '' ?>
                            <?php $links[] = "<a class=\"{$selected}\" href=\"?status={$key}\">" . ucwords($key) . "({$value})</a>" ?>
                        @endif
                    @endforeach
                    {!! implode(' | ', $links) !!}
                      

                </div>
            
                <!-- Page title actions -->
              <div class="col-12 col-md-auto ms-auto d-print-none">
                <div class="btn-list">
                  <a href="{{ route('admin.property.create')}}" class="btn btn-primary d-none d-sm-inline-block" >
                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                   Create Property
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


          @include('admin.property.message')

          @if (! $properties->count())
              <div class="alert alert-danger">
                  <strong>No record found</strong>
              </div>
          @else

              @if($onlyTrashed)
                  @include('admin.property.table-trash')
              @else
                  @include('admin.property.table')
              @endif

          @endif

       


      </div>

       <div class="card-footer d-flex align-items-center">
              <p class="m-0 text-muted">Showing 
                <span>{{ $properties->firstItem() }}</span> to <span>{{ $properties->lastItem() }} </span> of <span> {{$properties->total()}} entries</span>
              </p>

             

              {{ $properties->appends( Request::query() )->links('vendor.pagination.admin') }}

              {{--<ul class="pagination m-0 ms-auto">
                <li class="page-item disabled">
                  <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                    
                    prev
                    <i class="ti ti-chevron-left"></i>
                  </a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item active"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">4</a></li>
                <li class="page-item"><a class="page-link" href="#">5</a></li>
                <li class="page-item">
                  <a class="page-link" href="#">
                    next 
                    <i class="ti ti-chevron-right"></i>
                    
                  </a>


                </li>
             </ul> --}}


         </div>





    </div>
  </div>
</div>



@include('layouts.back_end.footer')

@endsection