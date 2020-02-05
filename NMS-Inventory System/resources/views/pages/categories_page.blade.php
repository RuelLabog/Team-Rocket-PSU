  @extends('includes/admin_template')



@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">

            <h1 class="m-0 text-dark"><i class="nav-icon fas fa-box"></i> Categories</h1>
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
                  <i class="fas fa-plus mr-2"></i>Add Category
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
                      <td>Category ID</td>
                      <td>Name</td>
                      <td>Description</td>
                      <td>Date Created</td>
                      <td>Date Updated</td>
                    </tr>

                    @foreach($data as $value)
                    <tr>
                      <td>{{$value->catid}}</td>
                      <td>{{$value->catname}}</td>
                      <td>{{$value->catdesc}}</td>
                      <td>{{$value->createdat}}</td>
                      <td>{{$value->updatedat}}</td>
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
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add New Category</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label>Category:</label>
                <input type="text" class="form-control" name="" placeholder="Category Name">
              </div>
              <div class="form-group">
                <label>Description:</label>
                <textarea class="form-control" placeholder="Category Description"></textarea>
              </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
              <button type="button" class="btn btn-success">Save changes</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.add items modal -->



 @endsection
