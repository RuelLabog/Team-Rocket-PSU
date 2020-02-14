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
                  <th width="20%">Username</th>
                  <th width="20%">Email</th>
                  <th width="25%">Name</th>
                  <th width="25%">Date Registered</th>
                  <th width="7%"></th>
                </tr>
            </thead>
            <tbody>


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
            <form id="itemsAdd_form">
            <div class="modal-body">
                <div class="form-group">
                  <div class="row">
                    <div class="col-6">
                      <label>Username:</label>
                      <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                    </div>
                    <div class="col-6">
                      <label>Email:</label>
                      <input type="email" class="form-control" id="email" name="email" placeholder="user@example.com">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="row">
                    <div class="col-6">
                      <label>First Name:</label>
                      <input type="text" class="form-control" id="fname" name="fname" placeholder="Given Name">
                    </div>
                    <div class="col-6">
                      <label>Last Name:</label>
                      <input type="text" class="form-control" id="lname" name="lname" placeholder="Family Name">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="row">
                    <div class="col-6">
                      <label>Password:</label>
                      <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                    <div class="col-6">
                      <label>Confirm Password:</label>
                      <input type="password" class="form-control" id="confPassword" name="confPassword" placeholder="Confirm Password">
                    </div>
                  </div>
                </div>

                <!-- <div class="form-group">
                  <label>Account Type:</label>
                  <select class="form-control select2" data-dropdown-css-class="select2-danger" style="width: 100%;">
                    <option selected="selected">Admin</option>
                    <option>User</option>
                  </select>
                </div> -->

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
              <button type="button" class="btn btn-success" id="userAddBtn" onclick="userAdd()">Save</button>
            </div>
            </form>
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
            <form action="" method="POST">
                {{ csrf_field() }}
                {{method_field('PATCH')}}
            <div class="modal-body">
                <div class="form-group">
                  <div class="row">
                    <input type="hidden" class="form-control"  id="eID" name="eID" placeholder="Username">
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
                      <input type="password" class="form-control" id="eConfPassword" name="eConfPassword" placeholder="Confirm Password">
                    </div>
                  </div>
                </div>

                <!-- <div class="form-group">
                  <label>Account Type:</label>
                  <select class="form-control select2" data-dropdown-css-class="select2-danger" style="width: 100%;">
                    <option selected="selected">Admin</option>
                    <option>User</option>
                  </select>
                </div> -->

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
              <button type="button" class="btn btn-success" id="userEditBtn" onclick="userEdit()">Save Changes</button>
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
              <h6 style="text-align:center">Are you sure you want to delete user <label id='dFullName' name="dFullName"></label>?</h6>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              <button type="button" class="btn btn-danger" onclick="userDel()" id="userDelBtn">Delete</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.delete item modal -->

      <script type="text/javascript">
        function userDel(){
              $.ajax({
                type: 'POST',
                url: 'softDelUser',
                data: {'_token': $('input[name=_token').val(),
                        'dID': $('input[name=dID').val()},
                beforeSend:function(){
                    $('#userDelBtn').text('Deleting...');
                    $('#userDelBtn').attr('disabled', true);
                },
                success: function (response){

                        toastr.success('Successfully Deleted.');
                        // $('#delete-form')[0].reset();
                        $('#modal-delete-user').modal('hide');
                        $('#users_table').DataTable().ajax.reload();
                        $('#userDelBtn').attr('disabled', false);
                        $('#userDelBtn').text('Delete');
                }
            });
        }


        function userEdit(){
              $.ajax({
                type: 'POST',
                url: "{{ route('userUpdate')}}",
                data: {'_token': $('input[name=_token').val(),
                        'eID': $('input[name=eID').val(),
                        'eUsername': $('input[name=eUsername').val(),
                        'eEmail': $('input[name=eEmail').val(),
                        'eFirstName': $('input[name=eFirstName').val(),
                        'eLastName': $('input[name=eLastName').val(),
                        'ePassword': $('input[name=ePassword').val(),
                        'eConfPassword': $('input[name=eConfPassword').val(),
                    },
                beforeSend:function(){
                    $('#userEditBtn').text('Updating...');
                    $('#userEditBtn').attr('disabled', true);
                },
                success: function (response){
                    $('#userEditBtn').attr('disabled', false);
                    $('#userEditBtn').text('Save Changes');

                    if(response.success){
                        toastr.success('Successfully Updated.');
                        // $('#delete-form')[0].reset();
                        $('#modal-edit-user').modal('hide');
                        $('#users_table').DataTable().ajax.reload();
                    }else{
                        if(response.errEmail){
                            toastr.error(response.errEmail);
                            $('#eEmail').css({'border':'1px solid red'});
                            $('#eEmail').focus();
                        }

                        if(response.errPass){
                            toastr.error(response.errPass);
                            $('#eConfPassword').css({'border':'1px solid red'});
                            $('#eConfPassword').val();
                            $('#eConfPassword').focus();
                        }

                        if(response.errPassWeak){
                            toastr.error(response.errPassWeak);
                            $('#eConfPassword').css({'border': 'red 2px solid'});
                            $('#ePassword').css({'border': 'red 2px solid'});
                            $('#eConfPassword').val("");
                            $('#ePassword').focus();
                        }else{
                            $('#eConfPassword').css({'border': 'red 2px grey'});
                            $('#ePassword').css({'border': 'red 2px grey'});
                        }
                    }


                }
            });
        }

        function userAdd(){
            var username=$('#username').val();
            var fname=$('#fname').val();
            var lname=$('#lname').val();
            var email=$('#email').val();
            var password=$('#password').val();
            var confPassword=$('#confPassword').val();
            if(username == "" || fname == "" || lname == "" || email == "" || password == "" || confPassword == ""){
                toastr.error('All fields are required!');
                if(username == ""){
                    $('#username').css({'border': '1px solid red'});
                }else{
                    $('#username').css({'border': '1px solid grey'});
                }

                if(fname == ""){
                    $('#fname').css({'border': '1px solid red'});
                }else{
                    $('#fname').css({'border': '1px solid grey'});
                }

                if(lname == ""){
                    $('#lname').css({'border': '1px solid red'});
                }else{
                    $('#lname').css({'border': '1px solid grey'});
                }

                if(email == ""){
                    $('#email').css({'border': '1px solid red'});
                }else{
                    $('#email').css({'border': '1px solid grey'});
                }

                if(password == ""){
                    $('#password').css({'border': '1px solid red'});
                }else{
                    $('#password').css({'border': '1px solid grey'});
                }

                if(confPassword == ""){
                    $('#confPassword').css({'border': '1px solid red'});
                }else{
                    $('#confPassword').css({'border': '1px solid grey'});
                }
            }else{
                $('input').css({'border': '1px solid grey'});
              $.ajax({
                type: 'POST',
                url: "{{ route('userAdd')}}",
                data: {'_token': $('input[name=_token').val(),
                        'username': $('input[name=username').val(),
                        'email': $('input[name=email').val(),
                        'fname': $('input[name=fname').val(),
                        'lname': $('input[name=lname').val(),
                        'password': $('input[name=password').val(),
                        'confPassword': $('input[name=confPassword').val(),
                    },
                beforeSend:function(){
                    $('#userAddBtn').text('Inserting...');
                    $('#userAddBtn').attr('disabled', true);
                },
                success: function (response){
                    $('#userAddBtn').attr('disabled', false);
                    $('#userAddBtn').text('Save');
                    if(response.success){
                        toastr.success('Successfully Inserted.');
                        $('#itemsAdd_form')[0].reset();
                        $('#modal-default').modal('hide');
                        $('#users_table').DataTable().ajax.reload();
                    }else{

                        if(response.errEmail){
                            toastr.error(response.errEmail);
                            $('#email').css({'border': 'red 2px solid'});
                            $('#email').focus();
                        }else{
                            $('#email').css({'border': 'red 2px grey'});
                        }

                        if(response.errPass){
                            toastr.error(response.errPass);
                            $('#confPassword').css({'border': 'red 2px solid'});
                            $('#confPassword').val("");
                            $('#confPassword').focus();
                        }else{
                            $('#confPassword').css({'border': 'red 2px grey'});
                        }

                        if(response.errPassWeak){
                            toastr.error(response.errPassWeak);
                            $('#confPassword').css({'border': 'red 2px solid'});
                            $('#password').css({'border': 'red 2px solid'});
                            $('#confPassword').val("");
                            $('#password').focus();
                        }else{
                            $('#confPassword').css({'border': 'red 2px grey'});
                            $('#password').css({'border': 'red 2px grey'});
                        }
                    }

                }
            });
        }

    }
    </script>


 @endsection


