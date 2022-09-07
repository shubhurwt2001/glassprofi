<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
      <img src="{{asset('storage/staticpic/logo.png')}}" alt="Glass logo" class="brand-image img-circle elevation-3" style="width:20%">
      <span class="brand-text font-weight-light"></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('storage/staticpic/logo.png')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{route('admin')}}" class="d-block">{{ Auth::guard('webadmin')->user()->f_name }}</a>
        </div>
      </div>

      
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         <!--
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.html" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v1</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index2.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v2</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index3.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v3</p>
                </a>
              </li>
            </ul>
          </li>  -->


          <li class="nav-item">
            <a href="{{route('admin.productlist.index')}}" class="nav-link @yield('products_select')">
              <i class="nav-icon far fa-circle text-warning"></i>
              <p>Products</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('admin.sampleproduct.index')}}" class="nav-link @yield('sampleproducts_select')">
              <i class="nav-icon far fa-circle text-warning"></i>
              <p>Sample Products</p>
            </a>
          </li>


          <li class="nav-item">
            <a href="{{route('admin.navbar')}}" class="nav-link @yield('navbar_select')">
              <i class="nav-icon far fa-circle text-warning"></i>
              <p>Navbar</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('admin.slider')}}" class="nav-link @yield('slider_select')">
              <i class="nav-icon far fa-circle text-warning"></i>
              <p>Slider</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('admin.registeruser')}}" class="nav-link @yield('register_user')">
              <i class="nav-icon far fa-circle text-warning"></i>
              <p>User</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('admin.banner.index')}}" class="nav-link @yield('banner_select')">
              <i class="nav-icon far fa-circle text-warning"></i>
              <p>Banner</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('admin.imagegallery.index')}}" class="nav-link @yield('imagegallery_select')">
              <i class="nav-icon far fa-circle text-warning"></i>
              <p>Image Gallery</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('admin.clientsays.index')}}" class="nav-link @yield('clientsays_select')">
              <i class="nav-icon far fa-circle text-warning"></i>
              <p>What Client Says</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('admin.order')}}" class="nav-link @yield('orders_select')">
              <i class="nav-icon far fa-circle text-warning"></i>
              <p>Orders</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('admin.seo')}}" class="nav-link @yield('seo_select')">
              <i class="nav-icon far fa-circle text-warning"></i>
              <p>Seo Section</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('admin.contactus')}}" class="nav-link @yield('contactus_select')">
              <i class="nav-icon far fa-circle text-warning"></i>
              <p>Contact Us</p>
            </a>
          </li>

          <li class="nav-item menu-open">
            <a href="javascript:void(0)" class="nav-link @yield('shipping_charge')" >
              <i class="nav-icon far fa-circle text-warning"></i>
              <p>
                Add Shipping Charge
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.country.index') }}" class="nav-link @yield('country') ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Country</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.shippingcharge.index') }}" class="nav-link @yield('add_shipping_charge')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Shipping Charge</p>
                </a>
              </li>
              
              
            </ul>
          </li>

         
          <li class="nav-item">
            <a href="{{route('admin.logout')}}" class="nav-link @yield('adminlogout_select')">
              <i class="nav-icon far fa-circle text-warning"></i>
              <p>Logout</p>
            </a>
          </li>
          
        

          

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>


  