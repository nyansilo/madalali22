@extends('layouts.user_dashboard.main_layout')

@section('title', 'Madalali4u | Create User Property')

@section('content')



<!-- Our Dashbord -->
  <section class="our-dashbord dashbord bgc-f7 pb50">
    <div class="container-fluid ovh">
      <div class="row">
        <div class="col-lg-3 col-xl-2 dn-992 pl0"></div>
        <div class="col-lg-9 col-xl-10 maxw100flex-992">
          <div class="row">
            <div class="col-lg-12">
              <div class="dashboard_navigationbar dn db-992">
                <div class="dropdown">
                  <button onclick="myFunction()" class="dropbtn"><i class="fa fa-bars pr10"></i> Dashboard Navigation</button>
                  <ul id="myDropdown" class="dropdown-content">
                    <li><a href="page-dashboard.html"><span class="flaticon-layers"></span> Dashboard</a></li>
                    <li><a href="page-message.html"><span class="flaticon-envelope"></span> Message</a></li>
                    <li><a href="page-my-properties.html"><span class="flaticon-home"></span> My Properties</a></li>
                    <li><a href="page-my-favorites.html"><span class="flaticon-heart"></span> My Favorites</a></li>
                    <li><a href="page-my-savesearch.html"><span class="flaticon-magnifying-glass"></span> Saved Search</a></li>
                    <li><a href="page-my-review.html"><span class="flaticon-chat"></span> My Reviews</a></li>
                    <li><a href="page-my-packages.html"><span class="flaticon-box"></span> My Package</a></li>
                    <li><a href="page-my-profile.html"><span class="flaticon-user"></span> My Profile</a></li>
                    <li class="active"><a href="page-add-new-property.html"><span class="flaticon-filter-results-button"></span> Add New Listing</a></li>
                    <li><a href="page-login.html"><span class="flaticon-logout"></span> Logout</a></li>
                  </ul>
                </div>
              </div>
            </div>




            <div class="col-lg-12 mb10">
              <div class="breadcrumb_content style2">
                <h2 class="breadcrumb_title">Add New Property</h2>
                <p>We are glad to see you again!</p>
              </div>
            </div>

         

          
          
            

                   @include('user.property.form_vehicle')




         


          </div>

          
            @include('layouts.user_dashboard.footer')
         

        </div>
      </div>
    </div>
  </section>


@endsection


 
@section('script')
    
    @include('user.property.script')
    
@endsection

