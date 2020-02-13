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
              <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Items Page</li>
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
                <tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

      <!-- add items modal -->
      <div class="modal fade" id="modal-default" data-backdrop="static">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header btn-danger ">
              <h4 class="modal-title"><i class="fas fa-box mr-2"></i>Add New Item</h4>
            </div>
            <form action="" method="POST" id="item-form">
            <div class="modal-body">
                <div class="form-group">
                {{csrf_field()}}
                  <label>Item: <span class="required">*</span></label>
                  <input type="text" class="form-control" id="itemname" name="itemname" placeholder="Item Name" required>
                </div>

                <div class="form-group">
                <label>Description: <span class="required">*</span></label>
                <textarea class="form-control" placeholder="Item Description" id="itemdesc" name="itemdesc" maxlength="200" required></textarea>
                </div>

                <div class="form-group">
                  <label>Quantity: <span class="required">*</span></label>
                  <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Item Quantity" required>
                </div>

                <div class="form-group">
                  <label>Category: <span class="required">*</span></label>
                  <select class="form-control select2" data-dropdown-css-class="select2-danger" style="width: 100%;" id="catid" name="catid" required>

                    @foreach($category as $data)
                  <option value="{{$data->id}}"> {{$data->catname}}</option>
                    @endforeach
                  </select>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="resetBoxes()">Cancel</button>
                <button type="button" class="btn btn-success" name="submit" id='itemAddBtn' onclick="itemAdd()">Save changes</button>
              </div>
          </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.add items modal -->

      <!-- edit item modal -->
      <div class="modal fade" id="modal-edit-items" data-backdrop="static">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header btn-danger">
              <h4 class="modal-title"><i class="fas fa-box mr-2"></i>Edit Item</h4>
            </div>
            <form action="{{route('items_page.update', 'test')}}" method="POST">
                {{method_field('patch')}}
                {{ csrf_field() }}
            <div class="modal-body">
            <input type="hidden" class="form-control"  id="eItemID" name="eItemID" value="" placeholder="Item ID">

                <div class="form-group">
                  <label>Item: <span class="required">*</span></label>
                  <input type="text" class="form-control" id="eItemname" name="eItemname" placeholder="Item Name" required>
                </div>

                <div class="form-group">
                <label>Description: <span class="required">*</span></label>
                <textarea class="form-control" placeholder="Item Description" id="eItemDesc" name="eItemDesc" required></textarea>
                </div>

                <div class="form-group">
                  <label>Quantity: <span class="required">*</span></label>
                  <input type="number" class="form-control" id="eQuantity" name="eQuantity" placeholder="Item Quantity" required>
                </div>

                <div class="form-group">
                  <label>Category: <span class="required">*</span></label>

                  <select class="form-control select2" data-dropdown-css-class="select2-danger" style="width: 100%;" name="catid" id="eCatName" required>
                    @foreach($category as $data)
                    <option value="{{$data->id}}" > {{$data->catname}}</option>
                    @endforeach
                  </select>
                </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="resetBoxes()">Cancel</button>
              <button type="button" class="btn btn-success" id='itemEditBtn' onclick='itemEdit()'>Save changes</button>
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
              <button type="button" class="btn btn-danger" id="itemDelBtn" onclick="itemDelete()">Delete</button>
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
                <label>Quantity:<span class="required"> *</span> </label>
                <input type="number" name="add_quantity" class="form-control" min="1">
              </div>
              <div class="form-group">
                <label>Receipt:<span class="required"> *</span></label>
                <select class="form-control">
                  <option value=""></option>
                  <option value=""></option>
                  <option value=""></option>
                  <option value=""></option>
                  <option value=""></option>
                </select>
              </div>
              <div class="form-group">
                <label>Department:<span class="required"> *</span></label>
                <select class="form-control">
                  <option value="Admin and Finance Department">Admin and Finance Department</option>
                  <option value="Corporate Image & Branding">Corporate Image & Branding</option>
                  <option value="Digital Content">Digital Content</option>
                  <option value="Disney Productions Department">Disney Productions Department</option>
                  <option value="Employee Engagement and Retention">Employee Engagement and Retention</option>
                  <option value="External Affairs and Production Department">External Affairs and Production Department</option>
                  <option value="FL Production Department Management">FL Production Department Management</option>
                  <option value="Human Resources and Development">Human Resources and Development</option>
                  <option value="Information Technology & Development">Information Technology & Development</option>
                  <option value="Jeemo PJ">Jeemo PJ</option>
                  <option value="Live Services Department">Live Services Department</option>
                  <option value="Messaging">Messaging</option>
                  <option value="Messaging Support Team">Messaging Support Team</option>
                  <option value="NMS Cares">NMS Cares</option>
                  <option value="Offline Services Department">Offline Services Department</option>
                  <option value="Online Management Personnel">Online Management Personnel</option>
                  <option value="Online Support">Online Support</option>
                  <option value="OSD Billing">OSD Billing</option>
                  <option value="OSD Management Team">OSD Management Team</option>
                  <option value="OSD Moderation">OSD Moderation</option>
                  <option value="OSD SEO">OSD SEO</option>
                  <option value="OSD SEO Beta">OSD SEO Beta</option>
                  <option value="OSD Support">OSD Support</option>
                  <option value="Outbound Support">Outbound Support</option>
                  <option value="Product Development Department">Product Development Department</option>
                  <option value="Production Department Support">Production Department Support</option>
                  <option value="Production Recruitment Department">Production Recruitment Department</option>
                  <option value="Sales and Marketing">Sales and Marketing</option>
                  <option value="Training & Quality Assurance Department">Training & Quality Assurance Department</option>
                </select>
                
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

      <!-- reduce quantity modal -->
      <div class="modal fade" id="modal-reduce-quantity" data-backdrop="static">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-danger">
              <h4 class="modal-title">Reduce Quantity</h4>
            </div>
            <form action="" method="get">
            {{ csrf_field() }}
            <div class="modal-body">
              <div class="form-group mt-3">
                <input type="hidden" name="rItemID" id="rItemID" class="form-control">
                <label>Quantity: </label>
              <input type="number" name="rQuantity" id="rQuantity" max="" class="form-control" min="" value="">
              </div>
              <div class="form-group mt-3">
                <label>Status Report: </label>
                <textarea class="form-control" minlength="255" name="statReport" id="statReport" placeholder="Please enter reason for reducing quantity."></textarea>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="resetBoxes()">Cancel</button>
              <button type="button" class="btn btn-success" id="itemRedBtn" onclick="itemReduce()">Save</button>
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

        function resetBoxes(){
            $('#itemname, #itemdesc, #quantity, #eItemname, #eItemDesc, #eQuantity, #statReport').css({
                'border': '1px solid grey'
            });
        }

        function itemEdit(){
            var url =  "editItem";
            var eItemDesc = $('#eItemDesc').val();
            var catid = $('#eCatName').val();
            var eItemname = $('#eItemname').val();
            var eQuantity = $('#eQuantity').val();
            if(eItemDesc == "" || eQuantity == "" || eItemname == ""){
                toastr.error('All fields are required!');
                if(eItemDesc == ""){
                    $('#eItemDesc').css({
                        'border': '1px solid red'
                    });
                }else{
                    $('#eItemDesc').css({
                        'border': '1px solid grey'
                    });
                }

                if(eQuantity == ""){
                    $('#eQuantity').css({
                        'border': '1px solid red'
                    });
                }else{
                    $('#eQuantity').css({
                        'border': '1px solid grey'
                    });
                }

                if(eItemname == ""){
                    $('#eItemname').css({
                        'border': '1px solid red'
                    });
                }else{
                    $('#eItemname').css({
                        'border': '1px solid grey'
                    });
                }
            }
            else{
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {
                            '_token': $('input[name=_token').val(),
                            'eItemID':$('input[name=eItemID').val(),
                            'eItemname':$('input[name=eItemname').val(),
                            'eItemDesc': eItemDesc,
                            'eQuantity':$('input[name=eQuantity').val(),
                            'catid':catid
                            },
                    beforeSend:function(){
                        $('#itemEditBtn').text('Updating...');
                    },
                    success: function (response){
                        toastr.success('Successfully Updated.');
                        $('#modal-edit-items').modal('hide');
                        $('#items_table').DataTable().ajax.reload();
                        $('#itemEditBtn').text('Save Changes');

                    }
                });
            }
        }


        function itemAdd(){
            var url =  "addItem";
            var itemdesc = $('#itemdesc').val();
            var catid=$('#catid').val();
            var quantity =$('#quantity').val();
            var itemname =$('#itemname').val();
            if(itemdesc == "" || quantity == "" || itemname == ""){
                toastr.error('All fields are required!');
                if(itemdesc == ""){
                    $('#itemdesc').css({
                        'border': '1px solid red'
                    });
                }else{
                    $('#itemdesc').css({
                        'border': '1px solid grey'
                    });
                }

                if(quantity == ""){
                    $('#quantity').css({
                        'border': '1px solid red'
                    });
                }else{
                    $('#quantity').css({
                        'border': '1px solid grey'
                    });
                }

                if(itemname == ""){
                    $('#itemname').css({
                        'border': '1px solid red'
                    });
                }else{
                    $('#itemname').css({
                        'border': '1px solid grey'
                    });
                }
            }
            else{
                $.ajax({
                type: 'POST',
                url: url,
                data: {
                        '_token': $('input[name=_token').val(),
                        'itemname':$('input[name=itemname').val(),
                        'quantity':$('input[name=quantity').val(),
                        'catid':catid,
                        'itemdesc': itemdesc
                        },
                beforeSend:function(){
                    $('#itemAddBtn').text('Inserting...');
                },
                success: function (response){
                    toastr.success('Successfully Added.');
                    $('#item-form')[0].reset();
                    $('#modal-default').modal('hide');
                    $('#items_table').DataTable().ajax.reload();
                    $('#itemAddBtn').text('Save Changes');
                    resetBoxes();
                    }
                });
            }

        }


        function itemDelete(){
            var id = $('#dItemID').val();
            var dItemname = $('#dItemName').html();
              $.ajax({
                type: 'POST',
                url: 'softdelitem',
                data: {'_token': $('input[name=_token').val(),
                        'dItemID': id
                    },
                beforeSend:function(){
                    $('#itemDelBtn').text('Deleting...');
                },
                success: function (response){
                    toastr.success('Successfully '+ dItemname + ' Deleted.');
                    $('#modal-delete-items').modal('hide');
                    $('#items_table').DataTable().ajax.reload();
                    $('#itemDelBtn').text('Delete');
                }
            });
        }

        function itemReduce(){
            var url =  "reduceItem";
            var statReport = $('#statReport').val();
            var rItemID = $('#rItemID').val();
            var rQuantity = $('#rQuantity').val();
            if(rQuantity == "" || statReport == ""){
                toastr.error('All fields are required!');
                if(rQuantity == ""){
                    $('#rQuantity').css({
                        'border': '1px solid red'
                    });
                }else{
                    $('#rQuantity').css({
                        'border': '1px solid grey'
                    });
                }

                if(statReport == ""){
                    $('#statReport').css({
                        'border': '1px solid red'
                    });
                }else{
                    $('#statReport').css({
                        'border': '1px solid grey'
                    });
                }
            }
            else{
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {
                            '_token': $('input[name=_token').val(),
                            'rItemID':rItemID,
                            'statReport':statReport,
                            'rQuantity': rQuantity
                            },
                    beforeSend:function(){
                        $('#itemRedBtn').text('Updating...');
                    },
                    success: function (response){
                        toastr.success('Successfully Updated.');
                        $('#modal-reduce-quantity').modal('hide');
                        $('#items_table').DataTable().ajax.reload();
                        $('#itemRedBtn').text('Save Changes');

                    }
                });
            }
        }

        </script>
{{-- panget si jerry --}}


<style>
.required{
    color: red;
}
</style>

 @endsection


