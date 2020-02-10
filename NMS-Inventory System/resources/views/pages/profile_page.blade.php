  @extends('includes/admin_template')


@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">

            <h1 class="m-0 text-dark"><i class="nav-icon  fas fa-id-badge"></i> Profile</h1>
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

          <div class="card mb-6">
            <div class="card-header">
                <h5 class="m-0 text-dark"><i class="fas fa-user-edit"></i> </h5>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

              <form action="{{route('profile_page.update', 'test')}}" method="POST">
                {{method_field('patch')}}
                {{csrf_field()}}

                  <div class="avatar-wrapper mt-0">
                    <img class="profile-pic" src="https://cdn0.iconfinder.com/data/icons/man-user-human-profile-avatar-business-person/100/09B-1User-512.png" />
                    <div class="upload-button">
                      <i class="fa fa-arrow-circle-up" aria-hidden="true"></i>
                    </div>
                    <input class="file-upload" type="file" accept="image/*"/>
                  </div>



                

                @foreach($data as $value)

                <div class="form-group">
                  <div class="row">
                    <input type="hidden" class="form-control" id="id" name="userid" placeholder="Username" value="{{$value->id}}">
                    <div class="col-6">
                      <label>Username:</label>
                      <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="{{$value->username}}">
                    </div>
                    <div class="col-6">
                      <label>Email:</label>
                      <input type="email" class="form-control" id="email" name="email" placeholder="user@example.com" value="{{$value->email}}">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="row">
                    <div class="col-6">
                      <label>First Name:</label>
                      <input type="text" class="form-control" id="fname" name="fname" placeholder="Given Name" value="{{$value->fname}}">
                    </div>
                    <div class="col-6">
                      <label>Last Name:</label>
                      <input type="text" class="form-control" id="lname" name="lname" placeholder="Familiy Name" value="{{$value->lname}}">
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
                      <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Confirm Password">
                    </div>
                  </div>
                </div>

                @endforeach

                <button type="submit" class="btn btn-success float-sm-right">Save Changes</button>
              </form>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->




 @endsection

