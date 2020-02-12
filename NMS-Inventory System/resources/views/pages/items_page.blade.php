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

          <div class="card">
            <div class="card-header">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default" id="add_data" name="add_data">
                  <i class="fas fa-plus mr-2"></i>Add Item
                </button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="items_table" class="table table-bordered table-striped">
                <thead>
                 <tr>
                    <th width="8%">Item ID</th>
                    <th width="20%">Name</th>
                    <th width="30%">Description</th>
                    <th width="17%">Category</th>
                    <th width="15%">Quantity</th>
                    <th width="10%">Actions</th>
                  </tr>
                </thead>
              </table>

            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

<!-- add items modal -->
      <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header btn-danger ">
              <h4 class="modal-title"><i class="fas fa-box mr-2"></i>Add New Item</h4>
            </div>
            <form action="" method="POST" id="item_form">
            <div class="modal-body">
                <div class="form-group">
              {{csrf_field()}}
                  <label>Item:</label>
                  <input type="text" class="form-control" name="itemname" placeholder="Item Name" required>
                </div>

                <div class="form-group">
                <label>Description:</label>
                <textarea class="form-control" placeholder="Item Description" name="itemdesc" maxlength="200" required></textarea>
                </div>

                <div class="form-group">
                  <label>Quantity:</label>
                  <input type="number" class="form-control" name="quantity" placeholder="Item Quantity" required>
                </div>

                <div class="form-group">
                  <label>Category:</label>
                  <select class="form-control select2" data-dropdown-css-class="select2-danger" style="width: 100%;" name="catid" required>
                    @foreach($category as $data)
                  <option value="{{$data->id}}"> {{$data->catname}}</option>
                    @endforeach
                  </select>
                </div>

            </div>
            <div class="modal-footer">
              <input type="hidden" name="button_action" id="button_action" value="insert" />
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-success" name="submit" id="action" onclick="insert()">Save changes</button>
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
              <h4 class="modal-title"><i class="fas fa-box mr-2"></i>Edit Item</h4>
            </div>
            <form action="{{route('items_page.update', 'test')}}" method="POST">
                {{method_field('patch')}}
                {{ csrf_field() }}
            <div class="modal-body">
            <input type="hidden" class="form-control"  id="eItemID" name="editid" value="" placeholder="Item ID">

                <div class="form-group">
                  <label>Item:</label>
                  <input type="text" class="form-control" id="eItemname" name="eItemname" placeholder="Item Name" required>
                </div>

                <div class="form-group">
                <label>Description:</label>
                <textarea class="form-control" placeholder="Item Description" id="eItemDesc" name="eItemDesc" required></textarea>
                </div>

                <div class="form-group">
                  <label>Quantity:</label>
                  <input type="number" class="form-control" id="eQuantity" name="eQuantity" placeholder="Item Quantity" required>
                </div>

                <div class="form-group">
                  <label>Category:</label>

                  <select class="form-control select2" data-dropdown-css-class="select2-danger" style="width: 100%;" name="catid" id="eCatName" required>
                    @foreach($category as $data)
                    <option value="{{$data->id}}" > {{$data->catname}}</option>
                      @endforeach
                  </select>
                </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-success">Save changes</button>
            </div>
            </form>
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
              <h4 class="modal-title"><i class="fas fa-box mr-2"></i>Delete Item</h4>
            </div>
            <form action="{{route('itemSoftDelete')}}" method="get">
            {{ csrf_field() }}
            <div class="modal-body">
                <input type="hidden" id="dItemID" name="dItemID"/>
                <h6 style="text-align:center">Are you sure you want to delete item <label id='dItemName'></label> ?</h6>

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

      <!-- add quantity modal -->
      <div class="modal fade" id="modal-add-quantity">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-danger">
              <h4 class="modal-title">Add Quantity</h4>
            </div>
            <form action="" method="get">
            {{ csrf_field() }}
            <div class="modal-body">

              <div class="form-group mt-3">
                <label>Quantity: </label>
                <input type="number" name="add_quantity" class="form-control" min="1">
              </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-success">Save</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.add quantity modal -->

            <!-- add quantity modal -->
      <div class="modal fade" id="modal-reduce-quantity">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-danger">
              <h4 class="modal-title">Reduce Quantity</h4>
            </div>
            <form action="" method="get">
            {{ csrf_field() }}
            <div class="modal-body">

              <div class="form-group mt-3">
                <label>Quantity: </label>
                <input type="number" name="add_quantity" class="form-control" min="1" value="1">
              </div>
              <div class="form-group mt-3">
                <label>Status Report: </label>
                <textarea class="form-control" minlength="255" placeholder="Please enter reason for reducing quantity."></textarea>
              </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-success">Save</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.add quantity modal -->

 <!-- /.ajax -->
      <script type="text/javascript">
$(document).ready(function() {
            $('#add_data').click(function(){
                $('#modal-default').modal('show');
                $('#item_form')[0].reset();
                $('#button_action').val('insert');
                $('#action').val('Add');
            });
        
            function insert(){
        event.preventDefault();
        var form_data = $(this).serialize();
        $.ajax({
                type: 'POST',
                url:"{{ route('items.insert') }}",
                data: form_data,
                dataType:"json",
                success: function (response){
                        $('#modal-default').modal('hide');
                        $('#items_table').DataTable().ajax.reload();
                }
            });
    });
          });

        </script>


 @endsection


