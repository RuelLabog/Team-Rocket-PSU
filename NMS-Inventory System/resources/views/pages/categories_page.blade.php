  @extends('includes/admin_template')



@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">

            <h1 class="m-0 text-dark"><i class="nav-icon fas fa-sitemap"></i> Categories</h1>
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





      <div class="card">
        <div class="card-header">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
            <i class="fas fa-plus mr-2"></i>Add Category
          </button>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="items_table" class="table table-bordered table-striped">
            <thead>
             <tr>
                  <th width="10%">#</th>
                  <th width="25%">Name</th>
                  <th width="55">Description</th>
                  <th width="10%"></th>
                </tr>
            </thead>
            <tbody>
            @foreach($data as $value)
                <tr>
                  <td width="10%">{{$value->catid}}</td>
                  <td width="25%">{{$value->catname}}</td>
                  <td width="55%">{{$value->catdesc}}</td>
                  <td width="10%" class="text-center">
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



<!-- add items modal -->
      <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-danger">
              <h4 class="modal-title">Add New Category</h4>
            </div>
            <form action="" method="POST">
            <div class="modal-body">
              <div class="form-group">
                {{ csrf_field() }}
                <label>Category:</label>
                <input type="text" class="form-control" name="catname" placeholder="Category Name">
              </div>
              <div class="form-group">
                <label>Description:</label>
                <textarea class="form-control" name="catdesc" placeholder="Category Description"></textarea>
              </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-success" name="submit">Save changes</button>
            </div>
          </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.add items modal -->


       <!-- edit item modal -->
      <div class="modal fade" id="modal-edit-items">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header btn-danger">
              <h4 class="modal-title">Edit Category</h4>
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
      <!-- /.edit item modal -->






            <!-- delete item modal -->
      <div class="modal fade" id="modal-delete-items">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-danger">
              <h4 class="modal-title">Delete Category</h4>
            </div>
            <div class="modal-body">
                
              <h4>Are you sure you want to delete this category?</h4>

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
