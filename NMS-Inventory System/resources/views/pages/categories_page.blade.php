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
              <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Categories Page</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- /.card -->
      <div class="card">
        <div class="card-header">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
            <i class="fas fa-plus mr-2"></i>Add Category
          </button>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="categories_table" class="table table-bordered table-striped">
            <thead>
             <tr>
                  <th width="5%">#</th>
                  <th width="25%">Name</th>
                  <th width="55%">Description</th>
                  <th width="7%"></th>
                </tr>
            </thead>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

       <!-- add items modal -->
       <div class="modal fade" id="modal-default" data-backdrop="static">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-danger">
              <h4 class="modal-title"><i class="fas fa-sitemap mr-2"></i>Add New Category</h4>
            </div>
            <form action="" method="POST" id="add-form" autocomplete="off">
            <div class="modal-body">
              <div class="form-group">
                {{ csrf_field() }}
                <label>Category: <span class="required">*</span></label>
                <input type="text" class="form-control" name="catName" id="catName" placeholder="Category Name" required>
              </div>
              <div class="form-group">
                <label>Description: <span class="required">*</span></label>
                <textarea class="form-control" id="catDesc" name="catDesc" placeholder="Category Description" required></textarea>
              </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="resetBoxes()">Cancel</button>
              <button type="button" class="btn btn-success" name="submit" id='categoryAddBtn' onclick="categoryAdd()">Save</button>
            </div>
          </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
       </div>
       <!-- /.add items modal -->

       <!-- edit item modal -->
       <div class="modal fade" id="modal-edit-category" data-backdrop="static">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header btn-danger">
              <h4 class="modal-title"><i class="fas fa-sitemap mr-2"></i>Edit Category</h4>
            </div>
            <form action="" method="POST" autocomplete="off">
                {{ csrf_field() }}
                {{method_field('PATCH')}}
            <div class="modal-body">
                <input type="hidden" class="form-control" id="eCatID" name="eCatID" value="" placeholder="Category Name" required>
                <div class="form-group">
                <label>Category: <span class="required">*</span></label>
                <input type="text" class="form-control" id="eCatName" name="eCatName" placeholder="Category Name" required>
              </div>
              <div class="form-group">
                <label>Description: <span class="required">*</span></label>
                <textarea class="form-control" placeholder="Category Description" id="eCatDesc" name="eCatDesc" required></textarea>
              </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="resetBoxes()">Cancel</button>
              <button type="button" class="btn btn-success" id="categoryEditBtn" onclick="categoryEdit()">Save changes</button>
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
              <h5 class="modal-title"><i class="fas fa-sitemap mr-2"></i>Delete Category</h5>
            </div>
             <form action="{{route('catSoftDelete')}}" method="POST" id="delete-form">
             {{ csrf_field() }}
            <div class="modal-body">
            <input type="hidden" id="dCatID" name="dCatID" class="form-control">
            <h6 style="text-align:center">Are you sure you want to delete category <label id="dCatName"></label>?</h6>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              <button type="button" class="btn btn-danger" id='categoryDelBtn' onclick='categoryDel()'>Delete</button>
            </div>
            <!-- </form> -->
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.delete item modal -->

    <script type="text/javascript">

        function resetBoxes(){
            $('#catName, #catDesc, #eCatName, #eCatDesc').css({
                'border': '1px solid grey'
            });
            $('#add-form')[0].reset();
        }

        function categoryDel(){
            var id = $('#dCatID').val();
              $.ajax({
                type: 'POST',
                url: 'softDelCat',
                data: {'_token': $('input[name=_token').val(),
                        'dCatID': $('input[name=dCatID').val()},
                beforeSend:function(){
                    $('#categoryDelBtn').text('Deleting...');
                    $('#categoryDelBtn').attr('disabled', true);
                },
                success: function (response){
                    if(response.success){
                        toastr.success('Successfully deleted.');
                        $('#modal-delete-category').modal('hide');
                        $('#categories_table').DataTable().ajax.reload();
                    }else{
                        toastr.error(response.err);
                        $('#modal-delete-category').modal('hide');
                    }
                        $('#categoryDelBtn').attr('disabled', false);
                        $('#categoryDelBtn').text('Delete');
                }
            });
        }

        function categoryEdit(){
            var url =  "editCat";
            var eCatDesc = $('#eCatDesc').val();
            var eCatName = $('#eCatName').val();
            if(eCatDesc == "" || eCatName == "" ){
                toastr.error('All fields are required!');
                if(eCatDesc == ""){
                    $('#eCatDesc').css({
                        'border': '1px solid red'
                    });
                }else{
                    $('#eCatDesc').css({
                        'border': '1px solid grey'
                    });
                }
                if(eCatName == ""){
                    $('#eCatName').css({
                        'border': '1px solid red'
                    });
                }else{
                    $('#eCatName').css({
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
                        'eCatID':$('input[name=eCatID').val(),
                        'eCatName':$('input[name=eCatName').val(),
                        'eCatDesc': eCatDesc
                        },
                beforeSend:function(){
                    $('#categoryEditBtn').text('Updating...');
                    $('#categoryEditBtn').attr('disabled', true);
                },
                success: function (response){
                    if(response.success){
                        toastr.success('Successfully Updated.');
                        $('#modal-edit-category').modal('hide');
                        $('#categories_table').DataTable().ajax.reload();
                    }else{
                        toastr.error(response.err);
                    }
                        $('#categoryEditBtn').attr('disabled', false);
                        $('#categoryEditBtn').text('Save Changes');
                }
            });
            }

        }

        function categoryAdd(){
            var catDesc = $('#catDesc').val();
            var catName = $('#catName').val();
            if( catDesc == "" || catName == "" ){
                toastr.error('All fields are required!');
                if(catDesc == ""){
                    $('#catDesc').css({
                        'border': '1px solid red'
                    });
                }else{
                    $('#catDesc').css({
                        'border': '1px solid grey'
                    });
                }
                if(catName == ""){
                    $('#catName').css({
                        'border': '1px solid red'
                    });
                }else{
                    $('#catName').css({
                        'border': '1px solid grey'
                    });
                }
            }
            else{
                $.ajax({
                    type: 'POST',
                    url: "{{ route('categoryInsert') }}",
                    data: {
                        '_token': $('input[name=_token').val(),
                        'catName':$('input[name=catName').val(),
                        'catDesc': catDesc
                        },
                    beforeSend:function(){
                        $('#categoryAddBtn').text('Inserting...');
                        $('#categoryAddBtn').attr('disabled', true);
                    },
                    success: function (response){

                        if(response.success){
                            toastr.success('Successfully Added.');
                            resetBoxes();
                            $('#modal-default').modal('hide');
                            $('#categories_table').DataTable().ajax.reload();
                        }else{
                            toastr.error(response.err);
                            $('#catName').css({'border': '1px solid red'});
                        }

                        $('#categoryAddBtn').text('Save Changes');
                        $('#categoryAddBtn').attr('disabled', false);
                    }
                });
            }
        }

        function restore(){
            var catname = $('#restoreBtn').val();
            var url = "restoreCat";
            $.ajax({
                    type: 'POST',
                    url: url,
                    data: {
                        '_token': $('input[name=_token').val(),
                        'catName':catname
                        },
                    beforeSend:function(){

                        toastr.warning(catname+' Restoring...');
                    },
                    success: function (response){
                        resetBoxes();
                        toastr.success('Successfully Restored.');
                        $('#modal-edit-category').modal('hide');
                        $('#modal-default').modal('hide');
                        $('#categories_table').DataTable().ajax.reload();
                    }
                });
        }

        function forceDel(){
            var catname = $('#forcedDelBtn').val();
            var url = "forceDelCat";
            $.ajax({
                    type: 'POST',
                    url: url,
                    data: {
                        '_token': $('input[name=_token').val(),
                        'catName':catname
                        },
                    beforeSend:function(){
                        toastr.warning(catname+' Deleting...');
                    },
                    success: function (response){
                        resetBoxes();
                        categoryEdit();
                        // toastr.success('Successfully Deleted.');
                        $('#categories_table').DataTable().ajax.reload();
                    }
            });
        }


    </script>


 @endsection
