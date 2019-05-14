<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">


   <ul class="sidebar-menu" data-widget="tree">
    <li class="header">Tin tức</li>
  {{-- Bài viết --}}
    <li class=" treeview ">
      <a href="#">
        <i class="fa fa-dashboard"></i> <span>Quản lý bài viết</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li class="active"><a href="{{ url('admin/category_news')}}"><i class="fa fa-circle-o"></i> Danh mục bài viết</a></li>
        <li><a href="{{ url('admin/news')}}"><i class="fa fa-circle-o"></i>Bài viết</a></li>
        <li><a href="{{ url('admin/pagecontent')}}"><i class="fa fa-circle-o"></i>Bài nội dung</a></li>
      </ul>
    </li>

    {{-- Sản phẩm --}}
    <li class="header">Sản phẩm</li>
    <li class=" treeview ">
      <a href="#">
        <i class="fa fa-dashboard"></i> <span>Quản lý sản phẩm</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li class="active"><a href="{{ url('admin/category_product')}}"><i class="fa fa-circle-o"></i> Danh mục sản phẩm</a></li>
        <li><a href="{{ url('admin/product')}}"><i class="fa fa-circle-o"></i> Sản phẩm</a></li>
         <li><a href="{{ url('admin/manufacturer')}}"><i class="fa fa-circle-o"></i> Hãng sản xuất</a></li>
      </ul>
    </li>

    {{-- banner --}}
    <li class="header">Banner</li>
    <li class=" treeview ">
      <a href="#">
        <i class="fa fa-dashboard"></i> <span>Quản lý banner</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li class="active"><a href="{{ url('admin/category_banner')}}"><i class="fa fa-circle-o"></i> Danh mục Banner</a></li>
        <li><a href="{{ url('admin/banner')}}"><i class="fa fa-circle-o"></i> Banner</a></li>
      </ul>
    </li>
  
  <!-- Website -->
    <li class="header">Cấu hình</li>
     <li class=" treeview ">
      <a href="#">
        <i class="fa fa-dashboard"></i> <span>Quản lý website</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
          <li> <a href="{{ url('admin/setting')}}"> <i class="fa fa-dashboard"></i> Quản lý web</a></li>
          <li><a href="{{ url('admin/introduce')}}"><i class="fa fa-circle-o"></i> Trang giới thiệu</a></li> 
          <li><a href="{{ url('admin/support')}}"> <i class="fa fa-dashboard"></i> Quản lý support</a></li>
          <li class="  "><a href="{{ url('admin/html')}}"> <i class="fa fa-dashboard"></i> Quản lý html</a></li>
        </ul>
      </li>
    
    <li class="  ">
      <a href="{{ url('admin/menu')}}"> <i class="fa fa-dashboard"></i> Quản lý menu
      </a>
    </li>
     <li class="  ">
      <a href="{{ url('admin/widget')}}"> <i class="fa fa-dashboard"></i> Quản lý widget
      </a>
    </li>
   
  </ul>
  <!-- sidebar menu: : style can be found in sidebar.less -->

</section>

</aside>