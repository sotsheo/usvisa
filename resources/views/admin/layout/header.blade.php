<header class="main-header">
  <!-- logo -->
  <a href="" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->

    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>{{ (auth()->user()->authorities==1)?'Admin':(auth()->user()->name) }}</b></span>
  </a>
  <!-- header navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">toggle navigation</span>
    </a>
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- messages: style can be found in dropdown.less-->

        <!-- notifications: style can be found in dropdown.less -->
        <li class="dropdown notifications-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-bell-o"></i>
            <span class="label label-warning">{{ (isset($data) && count($data)>0)? count($data):''}}</span>
          </a>
          <ul class="dropdown-menu">
            
              <ul class="menu">
                <li>
                  <a href="#">
                    <i class="fa fa-users text-aqua"></i> 5 new members joined today
                  </a>
                </li>
                
              </ul>
            </li>
            <li class="footer"><a href="#">view all</a></li>
          </ul>
        </li>
        <!-- tasks: style can be found in dropdown.less -->
        <!-- user account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu ">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
           <i class="fa fa-user"></i>
            <span class="hidden-xs">{{ (auth()->user()->authorities==1)?'Admin':(auth()->user()->name) }}</span>
          </a>
          <ul class="dropdown-menu">
           
            <li class="user-footer">
              
              <div class="pull-right">
                <a href="{{route("logout")}}" class="btn btn-default btn-flat">sign out</a>
              </div>
            </li>
          </ul>
        </li>
        <!-- control sidebar toggle button -->
        <li>
          <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
        </li>
      </ul>
    </div>

  </nav>
</header>