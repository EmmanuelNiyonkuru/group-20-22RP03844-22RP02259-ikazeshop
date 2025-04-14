<nav id="sidebar">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center">
          <!-- <div class="avatar"><img src="{{asset('/admincss/img/avatar-6.jpg')}}" alt="..." class="img-fluid rounded-circle"></div> -->
          <div class="title">
            <h1 class="h5">Admin Dash</h1>
            <p>Welcome</p>
          </div>
        </div>
        <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
        <ul class="list-unstyled">
                <li class="active"><a href="#"> <i class="icon-home"></i>Home </a></li>
                <li>
                  <a href="{{url('view_category')}}"> <i class="icon-grid"></i>Categorie </a>
                </li>
             
                <!-- <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i>Products</a>
                  <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                    <li><a href="#">Add products</a></li>
                    <li><a href="#">View Products</a></li>
                    <li><a href="#">Client </a></li>
                  </ul>
                </li> -->
                <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> 
    <i class="icon-windows"></i>Products</a>
    <ul id="exampledropdownDropdown" class="collapse list-unstyled">
        <li><a href="{{ url('view_product') }}">View Products</a></li>
        <li><a href="{{ url('add_product') }}" data-bs-toggle="modal" data-bs-target="#addProductModal">Add Product</a></li>
       
      </ul>
</li>
                
      </nav>