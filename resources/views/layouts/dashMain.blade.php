<!DOCTYPE html>
<html lang="en">
  <head>
    @include('dashIncludes.head')
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="{{route('dashboard.users')}}" class="site_title"><i class="fa fa-graduation-cap"></i></i> <span>Beverages Admin</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            @include('dashIncludes.menuprofile')
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            @include('dashIncludes.sidebarmenu')
			<!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            @include('dashIncludes.menufooter')
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        @include('dashIncludes.topnavigation')
        <!-- /top navigation -->

        @yield('content')
        
        <!-- footer content -->
        @include('dashIncludes.footercontent')
        <!-- /footer content -->
      </div>
    </div>
    @include('dashIncludes.js')

    

  </body>
</html>