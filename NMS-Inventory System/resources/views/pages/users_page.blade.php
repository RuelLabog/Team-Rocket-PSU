  @extends('includes/admin_template')



@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">

            <h1 class="m-0 text-dark"><i class="nav-icon fas fa-user"></i> Users</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Users Page</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->





      <div class="card">
        <div class="card-header">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
            <i class="fas fa-plus mr-2"></i>Add User
          </button>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="users_table" class="table table-bordered table-striped">
            <thead>
             <tr>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Name</th>
                  <th>Date Added</th>
                  <th></th>
                </tr>
            </thead>
            <tbody>
            <!-- @foreach($data as $value)
              <tr>
                <td>{{$value->username}}</td>
                <td>{{$value->email}}</td>
                <td>{{$value->fname.' '.$value->lname}}</td>
                <td class="text-center">
                  <span class="table-button cursor-pointer mr-3"
                  data-id="{{$value->id}}"
                  data-username="{{$value->username}}"
                  data-email="{{$value->email}}"
                  data-fname="{{$value->fname}}"
                  data-lname="{{$value->lname}}"
                  data-password="{{$value->password}}"

                  data-toggle="modal" data-target="#modal-edit-user">
                    <a>
                      <i class="fas fa-edit text-danger"></i>
                    </a>
                  </span>

                   <span class="table-button cursor-pointer"
                    data-id="{{$value->id}}"
                    data-fname="{{$value->fname}}"
                    data-lname="{{$value->lname}}"
                    data-toggle="modal" data-target="#modal-delete-user">
                    <a>
                      <i class="fas fa-trash text-danger"></i>
                    </a>
                  </span>

                </td>
              </tr>
            @endforeach -->

          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->





<!-- add items modal -->
      <div class="modal fade" id="modal-default">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header btn-danger ">
              <h4 class="modal-title">Add New User</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <div class="row">
                    <input type="hidden" class="form-control" id="id" name="userid" placeholder="Username">
                    <div class="col-6">
                      <label>Username:</label>
                      <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                    </div>
                    <div class="col-6">
                      <label>Email:</label>
                      <input type="email" class="form-control" id="username" name="username" placeholder="user@example.com">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="row">
                    <div class="col-6">
                      <label>First Name:</label>
                      <input type="text" class="form-control" id="username" name="username" placeholder="Given Name">
                    </div>
                    <div class="col-6">
                      <label>Last Name:</label>
                      <input type="text" class="form-control" id="username" name="username" placeholder="Familiy Name">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="row">
                    <div class="col-6">
                      <label>Password:</label>
                      <input type="password" class="form-control" id="username" name="username" placeholder="Password">
                    </div>
                    <div class="col-6">
                      <label>Confirm Password:</label>
                      <input type="password" class="form-control" id="username" name="username" placeholder="Confirm Password">
                    </div>
                  </div>
                </div>





                <div class="form-group">
                  <label>Account Type:</label>
                  <select class="form-control select2" data-dropdown-css-class="select2-danger" style="width: 100%;">
                    <option selected="selected">Admin</option>
                    <option>User</option>
                  </select>
                </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
              <button type="button" class="btn btn-success">Save</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.add items modal -->







      <!-- edit item modal -->
      <div class="modal fade" id="modal-edit-user">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header btn-danger">
              <h4 class="modal-title">Edit User</h4>
            </div>
            <form action="{{route('users_page.update', 'test')}}" method="POST">
                {{ csrf_field() }}
                {{method_field('PATCH')}}
            <div class="modal-body">
                <div class="form-group">
                  <div class="row">
                    <input type="hidden" class="form-control"  id="eID" name="eID" value="" placeholder="Username">
                    <div class="col-6">
                      <label>Username:</label>
                      <input type="text" class="form-control"  id="eUsername" name="eUsername" placeholder="Username">
                    </div>
                    <div class="col-6">
                      <label>Email:</label>
                      <input type="email" class="form-control" id="eEmail" name="eEmail" placeholder="user@example.com">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="row">
                    <div class="col-6">
                      <label>First Name:</label>
                      <input type="text" class="form-control" id="eFirstName" name="eFirstName" placeholder="Given Name">
                    </div>
                    <div class="col-6">
                      <label>Last Name:</label>
                      <input type="text" class="form-control" id="eLastName" name="eLastName" placeholder="Familiy Name">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="row">
                    <div class="col-6">
                      <label>Password:</label>
                      <input type="password" class="form-control" id="ePassword" name="ePassword" placeholder="Password">
                    </div>
                    <div class="col-6">
                      <label>Confirm Password:</label>
                      <input type="password" class="form-control" id="ePassword" name="ePassword" placeholder="Confirm Password">
                    </div>
                  </div>
                </div>





                <div class="form-group">
                  <label>Account Type:</label>
                  <select class="form-control select2" data-dropdown-css-class="select2-danger" style="width: 100%;">
                    <option selected="selected">Admin</option>
                    <option>User</option>
                  </select>
                </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-success">Save Changes</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.edit item modal -->



            <!-- delete item modal -->
      <div class="modal fade" id="modal-delete-user">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-danger">
              <h5 class="modal-title">Delete User</h5>
            </div>
            <form action="{{route('userSoftDelete')}}" method="POST">
                {{ csrf_field() }}

            <div class="modal-body">
                <input type="hidden" id="dID" name="dID" value="" class="form-control">
              <h6 style="text-align:center">Are you sure you want to delete <label id='dFullName' name="dFullName"></label>?</h6>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-danger">Delete</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.delete item modal -->


 @endsection


