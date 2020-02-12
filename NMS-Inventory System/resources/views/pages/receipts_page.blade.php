  @extends('includes/admin_template')



@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">

            <h1 class="m-0 text-dark"><i class="nav-icon fas fa-receipt"></i> Receipts</h1>
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
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add-receipt">
            <i class="fas fa-plus mr-2"></i>Add Receipt
          </button>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="receipts_table" class="table table-bordered table-striped">
            <thead>
             <tr>
                  <th width="5%">#</th>
                  <th width="15%">Ornum</th>
                  <th width="25%">pdate</th>
                  <th width="20%">supplier</th>
                  <th width="10">Total</th>
                  <th width="15%"></th>
                </tr>
            </thead>
            <tbody>


          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->



<!-- add items modal -->
      <div class="modal fade" id="modal-add-receipt">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-danger">
              <h4 class="modal-title"><i class="fas fa-receipt mr-2"></i>Add New Receipt</h4>
            </div>
            <form action="" method="POST">
            <div class="modal-body">
              <div class="form-group">
                {{ csrf_field() }}
                <label>OR Number:</label>
                <input type="text" class="form-control" name="" placeholder="Official Reciept Number" required>
              </div>
              <div class="form-group">
                <label>Supplier:</label>
                <input type="text" class="form-control" name="" placeholder="Enter Supplier Name." required>
              </div>
              <div class="form-group">
                <label>Date of Purchase:</label>
                <input type="date" class="form-control" name=""  required>
              </div>
              <!-- /.form group -->
              
              <div class="form-group">
                <label>Total:</label>
                <input type="text" class="form-control" name="" placeholder="Total Amount" required>
              </div>


            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-success" name="submit">Save</button>
            </div>
          </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.add items modal -->


       <!-- edit item modal -->
       <div class="modal fade" id="modal-edit-receipt">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header btn-danger">
              <h4 class="modal-title"><i class="fas fa-receipt mr-2"></i> Edit Receipt</h4>
            </div>
            <form action="{{route('categories_page.update', 'test')}}" method="POST">
                {{ csrf_field() }}
                {{method_field('PATCH')}}
            <div class="modal-body">
                <input type="hidden" class="form-control" id="eCatID" name="catid" value="" placeholder="Category Name" required>
                <div class="form-group">
                <label>OR Number:</label>
                <input type="text" class="form-control" name="" placeholder="Official Reciept Number" required>
              </div>
              <div class="form-group">
                <label>Supplier:</label>
                <input type="text" class="form-control" name="" placeholder="Enter Supplier Name." required>
              </div>
              <div class="form-group">
                <label>Date of Purchase:</label>
                <input type="date" class="form-control" name=""  required>
              </div>
              <!-- /.form group -->
              
              <div class="form-group">
                <label>Total:</label>
                <input type="text" class="form-control" name="" placeholder="Total Amount" required>
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
      <!-- /.edit item modal -->






            <!-- delete categories modal -->
      <div class="modal fade" id="modal-delete-category">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-danger">
              <h4 class="modal-title">Delete Category</h4>
            </div>
            <form action="{{route('catSoftDelete')}}" method="POST">
             {{ csrf_field() }}
            <div class="modal-body">
            <input type="hidden" id="dCatID" name="dCatID" class="form-control">
            <h6 style="text-align:center">Are you sure you want to delete category <label id="dCatName"></label>?</h6>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              <button type="button" class="btn btn-danger" id='categoryDelBtn' onclick='categoryDel()'>Delete</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.delete item modal -->

    <script type="text/javascript">
        function categoryDel(){
            var id = $('#dCatID').val();
              $.ajax({
                type: 'POST',
                url: 'softDelCat',
                data: {'_token': $('input[name=_token').val(),
                        'dCatID': $('input[name=dCatID').val()},
                beforeSend:function(){
                    $('#categoryDelBtn').text('Deleting...');
                },
                success: function (response){
                    setTimeout(function(){
                        $('#modal-delete-category').modal('hide');
                        $('#categories_table').DataTable().ajax.reload();
                        $('#categoryDelBtn').text('Delete');
                    }, 2000);
                }
            });
        }
    </script>





 @endsection
