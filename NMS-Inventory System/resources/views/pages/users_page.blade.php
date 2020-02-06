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
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Starter Page</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

<!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                  <i class="fas fa-plus mr-2"></i>Add User
                </button>


                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                </div>
              </div>



              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">

                <table class="table table-hover text-nowrap">
                    <tr>
                      <th width="30%">Username</th>
                      <th width="30%">Email</th>
                      <th width="30%">Name</th>
                      <th width="10%"></th>
                    </tr>

                    @foreach($data as $value)
                    <tr>
                      <td>{{$value->username}}</td>
                      <td>{{$value->email}}</td>
                      <td>{{$value->fname.' '.$value->lname}}</td>
                      <td>
                        <span class="table-button cursor-pointer mr-3" data-toggle="modal" data-target="#modal-edit-items">
                          <a>
                            <i class="fas fa-edit text-danger"></i>
                          </a>
                        </span>

                         <span class="table-button cursor-pointer" data-toggle="modal" data-target="#modal-delete-items">
                          <a>
                            <i class="fas fa-trash text-danger"></i>
                          </a>
                        </span>

                      </td>
                    </tr>
                    @endforeach
                  </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->






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
                    <div class="col-6">
                      <label>Username:</label>
                      <input type="text" class="form-control" name="" placeholder="Username">
                    </div>
                    <div class="col-6">
                      <label>Email:</label>
                      <input type="email" class="form-control" name="" placeholder="user@example.com">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="row">
                    <div class="col-6">
                      <label>First Name:</label>
                      <input type="text" class="form-control" name="" placeholder="Given Name">
                    </div>
                    <div class="col-6">
                      <label>Last Name:</label>
                      <input type="text" class="form-control" name="" placeholder="Familiy Name">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="row">
                    <div class="col-6">
                      <label>Password:</label>
                      <input type="password" class="form-control" name="" placeholder="Password">
                    </div>
                    <div class="col-6">
                      <label>Confirm Password:</label>
                      <input type="password" class="form-control" name="" placeholder="Confirm Password">
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
      <div class="modal fade" id="modal-edit-items">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header btn-danger">
              <h4 class="modal-title">Edit User</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <div class="row">
                    <div class="col-6">
                      <label>Username:</label>
                      <input type="text" class="form-control" name="" placeholder="Username">
                    </div>
                    <div class="col-6">
                      <label>Email:</label>
                      <input type="email" class="form-control" name="" placeholder="user@example.com">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="row">
                    <div class="col-6">
                      <label>First Name:</label>
                      <input type="text" class="form-control" name="" placeholder="Given Name">
                    </div>
                    <div class="col-6">
                      <label>Last Name:</label>
                      <input type="text" class="form-control" name="" placeholder="Familiy Name">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="row">
                    <div class="col-6">
                      <label>Password:</label>
                      <input type="password" class="form-control" name="" placeholder="Password">
                    </div>
                    <div class="col-6">
                      <label>Confirm Password:</label>
                      <input type="password" class="form-control" name="" placeholder="Confirm Password">
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
      <!-- /.edit item modal -->






            <!-- delete item modal -->
      <div class="modal fade" id="modal-delete-items">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-danger">
              <h5 class="modal-title">Delete User</h5>
            </div>
            <div class="modal-body">
                
              <h4>Are you sure you want to delete this user?</h4>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              <button type="button" class="btn btn-danger">Delete</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.delete item modal -->


 @endsection


