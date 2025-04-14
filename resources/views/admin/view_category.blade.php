<!DOCTYPE html>
<html>
  <head> 
   @include ('admin.css')
   <style>
    input[type="text"]{
        widht: 100%;
        height: 40px;
        border-radius: 5px;
    }
    .dv_deg{
        display: flex;
        justify-content: center;
        align-items: center;
        margin:30px
    }
    .table_deg{
        text-align: center;
        margin:auto;
        border: 1px solid yellowgreen;
        margin-top: 50px;

    }
   </style>
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
            <h2>Add Category</h2>
     <div class="dev_deg">
        <div>
      <form action="{{url('add_category')}}" method="POST">
        @csrf
        <input type="text" name="category">
        <button class="btn btn-primary">Add Category</button>
      </form>

        </div>


        <div>
            <table border=1 class="table_deg">
                    <tr>
                        <th>Category Id</th>
                        <th>Category Name</th>
                        <th>Edit</th>
                        <th>Delete</th>

                    </tr>
                    @foreach($data as $data)
                    <tr>
                    <td>{{$data->id}}</td>
                        <td>{{$data->categoty_name}}</td>
                        <td><a href="{{url('edit_category',$data->id)}}" class="btn btn-success">Edit</a></td>
                        <td><a href="{{url('delete_category',$data->id)}}" class="btn btn-danger">Delete</a></td>
                    </tr>
                    @endforeach
            </table>
        </div>
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
</html>