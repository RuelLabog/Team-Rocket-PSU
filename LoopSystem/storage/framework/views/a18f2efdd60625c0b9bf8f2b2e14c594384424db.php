<?php $__env->startSection('content'); ?>
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
        <table id="categories_table" class="table table-bordered table-striped">
          <thead>
           <tr>
                <th width="25%">Name</th>
                <th width="55">Description</th>
                <th width="55">Date Created</th>
                <th width="10%"></th>
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
          <div class="modal-header bg-danger">
            <h4 class="modal-title">Add New Category</h4>
          </div>
          <form action="" method="POST">
          <div class="modal-body">
            <div class="form-group">
              <?php echo e(csrf_field()); ?>

              <label>Category:</label>
              <input type="text" class="form-control <?php $__errorArgs = ['catName'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> " name="catName" id="catName" placeholder="Category Name" required>
            </div>
            <div class="form-group">
              <label>Description:</label>
              <textarea class="form-control" id="catDesc" name="catDesc" placeholder="Category Description" required></textarea>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-success" name="submit" id='categoryAddBtn' onclick="categoryAdd()">Save changes</button>
          </div>
        </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.add items modal -->


     <!-- edit item modal -->
     <div class="modal fade" id="modal-edit-category">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header btn-danger">
            <h4 class="modal-title">Edit Category</h4>
          </div>
          <form action="" method="POST">
              <?php echo e(csrf_field()); ?>

              <?php echo e(method_field('PATCH')); ?>

          <div class="modal-body">
              <input type="hidden" class="form-control" id="eCatID" name="eCatID" value="" placeholder="Category Name" required>
              <div class="form-group">
              <label>Category:</label>
              <input type="text" class="form-control" id="eCatName" name="eCatName" placeholder="Category Name" required>
            </div>
            <div class="form-group">
              <label>Description:</label>
              <textarea class="form-control" placeholder="Category Description" id="eCatDesc" name="eCatDesc" required></textarea>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
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
            <h4 class="modal-title">Delete Category</h4>
          </div>
          
           <?php echo e(csrf_field()); ?>

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

  

 <?php $__env->stopSection(); ?>



<?php echo $__env->make('includes.admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Repository\LoopSystem\resources\views/pages/admin_page.blade.php ENDPATH**/ ?>