  @extends('includes/admin_template')



@section('content')
    <!-- Content Header (Page header) -->
    @php
    $today = date("Y-m-d");
    @endphp
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">

            <h1 class="m-0 text-dark"><i class="nav-icon fas fa-receipt"></i> Receipts</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Receipt Page</li>
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
                  <th width="23%">Ornum</th>
                  <th width="23%">Purchase Date</th>
                  <th width="35%">Supplier</th>
                  <th width="7%"></th>
                </tr>
            </thead>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

<!-- add receipts modal -->
      <div class="modal fade" id="modal-add-receipt" data-backdrop="static">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-danger">
              <h4 class="modal-title"><i class="fas fa-receipt mr-2"></i>Add New Receipt</h4>
            </div>
            <form action="" method="POST" id="add-form">
            <div class="modal-body">
              <div class="form-group mt-3">
                {{ csrf_field() }}
                <label>OR Number: <span class="required">*</span></label>
                <input type="text" class="form-control" name="ornum" id="ornum" placeholder="Official Receipt Number" required>
              </div>
              <div class="form-group mt-3">
                <label>Supplier: <span class="required">*</span></label>
                <input type="text" class="form-control" name="supplier" id="supplier" placeholder="Enter Supplier Name" required>
              </div>
              <div class="form-group mt-3">
                <label>Date of Purchase: <span class="required">*</span></label>
                <input type="date" class="form-control" name="pdate" id="pdate" max="{{$today}}" required>
              </div>
            </div>

          
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="resetBoxes()">Cancel</button>
              <button type="button" class="btn btn-success" name="submit" id='receiptAddBtn' onclick="receiptAdd()">Save</button>
            </div>
          </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.add receipt modal -->


       <!-- edit receipt modal -->
       <div class="modal fade" id="modal-edit-receipt" data-backdrop="static">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header btn-danger">
              <h4 class="modal-title"><i class="fas fa-receipt mr-2"></i> Edit Receipt</h4>
            </div>
            <form action="" method="POST">
                {{ csrf_field() }}
                {{method_field('PATCH')}}
            <div class="modal-body">
                <input type="hidden" class="form-control" id="eRecID" name="eRecID" value="" required>
                <div class="form-group mt-3">
                <label>OR Number: <span class="required">*</span></label>
                <input type="text" class="form-control" name="eOrnum" id="eOrnum" placeholder="Official Receipt Number" required>
              </div>
              <div class="form-group mt-3">
                <label>Supplier: <span class="required">*</span></label>
                <input type="text" class="form-control" name="eSupplier" id="eSupplier" placeholder="Enter Supplier Name." required>
              </div>
              <div class="form-group mt-3">
                <label>Date of Purchase: <span class="required">*</span></label>
                <input type="date" class="form-control" name="ePdate"  id="ePdate" max="{{$today}}" required>
              </div>
              <!-- /.form group -->
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="resetBoxes()">Cancel</button>
              <button type="button" class="btn btn-success" id="receiptEditBtn" onclick="receiptEdit()">Save</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.edit receipt modal -->

            <!-- delete receipt modal -->
      <div class="modal fade" id="modal-delete-receipt" data-backdrop="static">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-danger">
              <h4 class="modal-title">Delete Receipt</h4>
            </div>
            <form action="{{route('recSoftDelete')}}" method="POST">
             {{ csrf_field() }}
            <div class="modal-body">
            <input type="hidden" id="dRecID" name="dRecID" class="form-control">
            <h6 style="text-align:center">Are you sure you want to delete receipt <label id="dOrnum"></label>?</h6>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              <button type="button" class="btn btn-danger" id='receiptDelBtn' onclick='receiptDel()'>Delete</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.delete receipt modal -->

    <script type="text/javascript">

       function resetBoxes(){
        $('#ornum, #supplier, #pdate, #eOrnum, #eSupplier, #ePdate').css({
              'border': '1px solid grey'
                    });
                    $('#add-form')[0].reset();
                    $('#receiptAddBtn').attr('disabled', false);
                    $('#receiptAddBtn').text('Save');
                    $('#receiptDelBtn').attr('disabled', false);
                    $('#receiptDelBtn').text('Delete');
                    $('#receiptEditBtn').attr('disabled', false);
                    $('#receiptEditBtn').text('Save Changes');
       }

       function receiptDel(){
            var id = $('#dRecID').val();
              $.ajax({
                type: 'POST',
                url: 'softDelRec',
                data: {'_token': $('input[name=_token').val(),
                        'dRecID': $('input[name=dRecID').val()},
                beforeSend:function(){
                    $('#receiptDelBtn').text('Deleting...');
                    $('#receiptDelBtn').attr('disabled', true);
                },
                success: function (response){
                  toastr.success('Successfully Deleted.');
                        $('#modal-delete-receipt').modal('hide');
                        $('#receipts_table').DataTable().ajax.reload();
                        $('#receiptDelBtn').attr('disabled', false);
                        $('#receiptDelBtn').text('Delete');
                }
            });
        }

        function receiptEdit(){
            var url =  "editRec";
            var eRecID = $('#eRecID').val();
            var eOrnum = $('#eOrnum').val();
            var eSupplier = $('#eSupplier').val();
            var ePdate = $('#ePdate').val();
            if(eRecID == "" || eOrnum == "" || eSupplier == "" || ePdate == ""){
                toastr.error('All fields are required!');

                if(eOrnum == ""){
                    $('#eOrnum').css({
                        'border': '1px solid red'
                    });
                }else{
                    $('#eOrnum').css({
                        'border': '1px solid grey'
                    });
                }

                if(eSupplier == ""){
                    $('#eSupplier').css({
                        'border': '1px solid red'
                    });
                }else{
                    $('#eSupplier').css({
                        'border': '1px solid grey'
                    });
                }

                if(ePdate == ""){
                    $('#ePdate').css({
                        'border': '1px solid red'
                    });
                }else{
                    $('#ePdate').css({
                        'border': '1px solid grey'
                    });
                }
            }
            else{
              $.ajax({
                type: 'POST',
                url: url,
                data: {'_token': $('input[name=_token').val(),
                        'eRecID': eRecID,
                        'eOrnum':eOrnum,
                        'eSupplier':eSupplier,
                        'ePdate': ePdate
                        },
                beforeSend:function(){
                    $('#receiptEditBtn').text('Updating...');
                    $('#receiptEditBtn').attr('disabled', true);
                },
                success: function (response){
                    if(response.success){
                        toastr.success('Successfully Updated.');
                        $('#modal-edit-receipt').modal('hide');
                        $('#receipts_table').DataTable().ajax.reload();
                    }else{
                        toastr.error(response.err);
                    }
                        $('#receiptEditBtn').attr('disabled', false);
                        $('#receiptEditBtn').text('Save Changes');
                }
            });
        }
      }
      

        function receiptAdd(){
            var ornum = $('#ornum').val();
            var supplier = $('#supplier').val();
            var pdate = $('#pdate').val();
            if(ornum == "" || supplier == "" || pdate == ""){
                toastr.error('All fields are required!');

                if(ornum == ""){
                    $('#ornum').css({
                        'border': '1px solid red'
                    });
                }else{
                    $('#ornum').css({
                        'border': '1px solid grey'
                    });
                }

                if(supplier == ""){
                    $('#supplier').css({
                        'border': '1px solid red'
                    });
                }else{
                    $('#supplier').css({
                        'border': '1px solid grey'
                    });
                }

                if(pdate == ""){
                    $('#pdate').css({
                        'border': '1px solid red'
                    });
                }else{
                    $('#pdate').css({
                        'border': '1px solid grey'
                    });
                }
            }
            else{
        $.ajax({
                type: 'POST',
                url: "{{ route('receiptInsert') }}",
                data: {'_token': $('input[name=_token').val(),
                        'ornum':ornum,
                        'supplier':supplier,
                        'pdate':pdate
                        },
                beforeSend:function(){
                    $('#receiptAddBtn').text('Inserting...');
                    $('#receiptAddBtn').attr('disabled', true);
                },
                success: function (response){
                  toastr.success('Successfully Added.');
                  $('#add-form')[0].reset();
                        $('#modal-add-receipt').modal('hide');
                        $('#receipts_table').DataTable().ajax.reload();
                        $('#receiptAddBtn').attr('disabled', false);
                        $('#receiptAddBtn').text('Save');
                        resetBoxes();
                }
            });
          }
        }

        function restore(){
            var ornum = $('#restoreBtn').val();
            var url = "restoreRec";
            $.ajax({
                    type: 'POST',
                    url: url,
                    data: {
                        '_token': $('input[name=_token').val(),
                        'ornum':ornum
                        },
                    beforeSend:function(){

                        toastr.warning(ornum+' Restoring...');
                    },
                    success: function (response){
                        resetBoxes();
                        toastr.success('Successfully Restored.');
                        $('#modal-edit-receipt').modal('hide');
                        $('#receipts_table').DataTable().ajax.reload();
                    }
                });
        }

        function forceDel(){
            var ornum = $('#forcedDelBtn').val();
            var url = "forceDelRec";
            $.ajax({
                    type: 'POST',
                    url: url,
                    data: {
                        '_token': $('input[name=_token').val(),
                        'ornum':ornum
                        },
                    beforeSend:function(){
                        toastr.warning(ornum+' Deleting...');
                    },
                    success: function (response){
                        resetBoxes();
                        receiptEdit();
                        toastr.success('Successfully Deleted.');
                        $('#receipts_table').DataTable().ajax.reload();
                    }
                });
        }
    </script>

<style>
  .required{
      color: red;
  }
  </style>

 @endsection
