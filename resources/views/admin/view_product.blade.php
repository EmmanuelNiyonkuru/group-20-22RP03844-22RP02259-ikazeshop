<!DOCTYPE html>
<html>
  <head> 
   @include ('admin.css')
  </head>
  <body>
    <!-- headrer ssection -->
     @include ('admin.header')
    <div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->
      @include ('admin.sidebar')
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
        <div>
        <table border="1">
        <tr>
            <th>Product Id</th>
            <th>Product Title</th>
            <th>Category Name</th>
            <th>Description</th>
            <!-- <th>Category</th> -->
            <th>Price</th>
            <th>Quantity</th>
            <th>Image</th>
            <th colspan="2">Option</th>
            @foreach($products as $pro)
            @foreach($categories as $cat)
            <tr>
                <td>{{$pro->id}}</td>
                <td>{{$pro->title}}</td>
                <td>{{ $cat->categoty_name}}" {{ $pro->category_id == $cat->id}}</td>
                <td>{{$pro->description}}</td>
              
                <td>{{$pro->price}}</td>
                <td>{{$pro->quantity}}</td>
                <td>{{$pro->image}}</td>
                <td><a href="{{url('delete_product',$pro->id)}}">Delete</a></td>
                <td><a href="{{url('edit_product',$pro->id)}}">Update</a></td>
            </tr>
            @endforeach
            @endforeach

        </tr>
    </table>

        </div>
</div>
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="{{asset('/admincss/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('/admincss/vendor/popper.js/umd/popper.min.js')}}"> </script>
    <script src="{{(asset('/admincss/vendor/bootstrap/js/bootstrap.min.js'))}}"></script>
    <script src="{{asset('/admincss/vendor/jquery.cookie/jquery.cookie.js')}}"> </script>
    <script src="{{asset('/admincss/vendor/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('/admincss/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('/admincss/js/charts-home.js')}}"></script>
    <script src="{{asset('/admincss/js/front.js')}}"></script>
  </body>
