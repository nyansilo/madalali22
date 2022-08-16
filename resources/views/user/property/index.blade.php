@extends('layouts.user_dashboard.main_layout')

@section('title', 'Madalali4u | All User Property')

@section('content')) 

    <!-- Our Dashbord -->
  <section class="our-dashbord dashbord bgc-f7 pb50">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-xl-2 dn-992 pl0"></div>
        <div class="col-sm-12 col-lg-8 col-xl-10 maxw100flex-992">
          <div class="row">
            <div class="col-lg-12">
              <div class="dashboard_navigationbar dn db-992">
                <div class="dropdown">
                  <button onclick="myFunction()" class="dropbtn"><i class="fa fa-bars pr10"></i>  Dashboard Navigation
                  </button>

                  <ul id="myDropdown" class="dropdown-content">
                    <li>
                        <a href="page-dashboard.html">
                            <span class="flaticon-layers"></span> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="page-message.html">
                            <span class="flaticon-envelope"></span> Message
                        </a>
                    </li>
                    <li class="active">
                        <a href="page-my-properties.html">
                            <span class="flaticon-home"></span> My Properties
                        </a>
                    </li>
                    <li>
                      <a href="page-my-favorites.html">
                        <span class="flaticon-heart"></span> My Favorites
                      </a>
                    </li>
                    <li>
                      <a href="page-my-savesearch.html">
                        <span class="flaticon-magnifying-glass"></span> Saved Search
                      </a>
                    </li>
                    <li>
                      <a href="page-my-review.html">
                        <span class="flaticon-chat"></span> My Reviews
                      </a>
                    </li>
                    <li>
                      <a href="page-my-packages.html">
                        <span class="flaticon-box"></span> My Package
                      </a>
                    </li>
                    <li>
                      <a href="page-my-profile.html">
                        <span class="flaticon-user"></span> My Profile
                    </a>
                    </li>
                    <li>
                      <a href="page-add-new-property.html">
                        <span class="flaticon-filter-results-button"></span> Add New Listing
                      </a>
                    </li>
                    <li><a href="page-login.html"><span class="flaticon-logout"></span> Logout</a></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-xl-4 mt0">
              <div class="breadcrumb_content style2 mb20-991">
                <h2 class="breadcrumb_title">My Properties</h2>
                <p>We are glad to see you again!</p>
              </div>
            </div>
            <div class="col-lg-8 col-xl-8">
              <div class="candidate_revew_select style2 text-right mb20-991">
                <ul class="mb0">
                  <li class="list-inline-item">
                    <div class="candidate_revew_search_box course fn-520">
                      <form class="form-inline my-2">
                          <input class="form-control mr-sm-2" type="search" placeholder="Search Courses" aria-label="Search">
                          <button class="btn my-2 my-sm-0" type="submit"><span class="flaticon-magnifying-glass"></span></button>
                        </form>
                    </div>
                  </li>
                  <li class="list-inline-item">
                    <select class="selectpicker show-tick">
                      <option>Featured First</option>
                      <option>Recent</option>
                      <option>Old Review</option>
                    </select>
                  </li>
                </ul>
              </div>
            </div>

              @include('user.property.message')

              @if (!$properties->count())
                <div class="col-lg-12 col-xl-12">
                  <div class="ui_kit_message_box">
                    <div class="alert alart_style_four alert-dismissible fade show" role="alert">
                        No record found 
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">×</span>
                      </button>
                    </div>
                  </div>
                </div>  
              @else

                  @include('user.property.table')

              @endif

          </div>

          @include('layouts.user_dashboard.footer')
         
        </div>
      </div>
    </div>
  </section>



@endsection