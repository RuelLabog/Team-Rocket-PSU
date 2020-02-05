  @extends('includes/admin_template')



@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">

            <h1 class="m-0 text-dark"><i class="nav-icon fas fa-box"></i> Items</h1>
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
                  <i class="fas fa-plus mr-2"></i>Add Item
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
                      <td>Item ID</td>
                      <td>Name</td>
                      <td>Description</td>
                      <td>Price</td>
                      <td>Quantity</td>
                    </tr>

                    @foreach($data as $value)
                    <tr>
                      <td>{{$value->itemid}}</td>
                      <td>{{$value->itemname}}</td>
                      <td>{{$value->itemdesc}}</td>
                      <td>{{$value->price}}</td>
                      <td>{{$value->quantity}}</td>
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
              <h4 class="modal-title">Add New Item</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <label>Item:</label>
                  <input type="text" class="form-control" name="" placeholder="Item Name">
                </div>

                <div class="form-group">
                <label>Description:</label>
                <textarea class="form-control" placeholder="Item Description"></textarea>
                </div>

                <div class="form-group">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text">₱</span>
                    </div>
                    <input type="text" class="form-control" aria-label="Amount">
                    <div class="input-group-append">
                      <span class="input-group-text">.00</span>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label>Quantity:</label>
                  <input type="number" class="form-control" name="" placeholder="Item Quantity">
                </div>


                <div class="form-group">
                  <label>Category:</label>
                  <select class="form-control select2" data-dropdown-css-class="select2-danger" style="width: 100%;">
                    <option selected="selected">Test Category 1</option>
                    <option>Test Category 2</option>
                    <option>Test Category 3</option>
                    <option>Test Category 4</option>
                    <option>Test Category 5</option>
                    <option>Test Category 6</option>
                    <option>Test Category 7</option>
                  </select>
                </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-success">Save changes</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.add items modal -->


 @endsection


