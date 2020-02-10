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
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
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
                    <th width="12%">Category</th>
                    <th width="10%">Price</th>
                    <th width="12%">Quantity</th>
                    <th width="8%"></th>
                  </tr>
                </thead>
                <tbody>
                @foreach($data as $value)
                  <tr>
                    <td width="8%">{{$value->id}}</td>
                    <td width="20%">{{$value->itemname}}</td>
                    <td width="30%">{{$value->itemdesc}}</td>
                    <td width="12%">{{$value->catname}}</td>
                    <td width="10%">{{'₱'.$value->price}}</td>
                    <td width="12%">{{$value->quantity}}</td>
                    <td width="8%" class="text-center">

                      <span class="table-button cursor-pointer mr-3"
                      data-itemname="{{$value->itemname}}"
                      data-itemdesc="{{$value->itemdesc}}"
                      data-price="{{$value->price}}"
                      data-quantity="{{$value->quantity}}"
                      data-itemid="{{$value->id}}"
                      data-catid="{{$value->catid}}"
                      data-toggle="modal" data-target="#modal-edit-items">
                        <a>
                          <i class="fas fa-edit text-danger"></i>
                        </a>
                      </span>

                       <span class="table-button cursor-pointer"
                       data-itemname="{{$value->itemname}}"
                       data-itemid="{{$value->id}}"
                       data-toggle="modal" data-target="#modal-delete-items">
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
            <div class="modal-header btn-danger ">
              <h4 class="modal-title">Add New Item</h4>
            </div>
            <form action="" method="POST">
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
                  <label>Price:</label>
                  <input type="text" class="form-control" name="price" placeholder="Item Price" required>
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
              <h4 class="modal-title">Edit Item</h4>
            </div>
            <form action="{{route('items_page.update', 'test')}}" method="POST">
                {{method_field('patch')}}
                {{ csrf_field() }}
            <div class="modal-body">
            <input type="hidden" class="form-control"  id="eItemID" name="editid" value="" placeholder="Item Name">

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
                  <label>Price (₱):</label>
                  <input type="text" class="form-control" id="ePrice" name="ePrice" placeholder="Item Price" required>
                </div>


                <div class="form-group">
                  <label>Category:</label>

                  <select class="form-control select2" data-dropdown-css-class="select2-danger" style="width: 100%;" name="catid" required>

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
              <h4 class="modal-title">Delete Item</h4>
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









 @endsection


