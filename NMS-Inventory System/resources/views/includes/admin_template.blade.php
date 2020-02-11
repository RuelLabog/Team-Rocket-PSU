<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Inventory System</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="bower_components/admin-lte/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="bower_components/admin-lte/dist/css/adminlte.min.css">
  <!-- Select -->
  <link rel="stylesheet" href="bower_components/admin-lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <link rel="stylesheet" href="bower_components/admin-lte/plugins/select2/css/select2.min.css">
    <!-- DataTables -->
  <link rel="stylesheet" href="bower_components/admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.css">

      <!-- Toastr -->
  <link rel="stylesheet" href="bower_components/admin-lte/plugins/toastr/toastr.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <link rel="stylesheet" href="css/custom.css">

<script>
  var msg = '{{Session::get('alert')}}';
  var exist = '{{Session::has('alert')}}';
  if(exist){
    alert(msg);
  }
</script>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

@include('includes/header')

@include('includes/sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">



    <div class="content">
      @yield('content')
    </div>


  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
@include('includes/footer')
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<!-- jQuery -->
<script src="bower_components/admin-lte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="bower_components/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="bower_components/admin-lte/dist/js/adminlte.min.js"></script>
<!-- Select2 -->
<script src="bower_components/admin-lte/plugins/select2/js/select2.full.min.js"></script>

<!-- DataTables -->
<script src="bower_components/admin-lte/plugins/datatables/jquery.dataTables.js"></script>
<script src="bower_components/admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

<script src="bower_components/admin-lte/plugins/toastr/toastr.min.js"></script>



<script>
  $(function () {
    //Initialize Select2 Elements
    $('#select2').select2();
  });
</script>


{{-- edit category --}}
<script>
     $('#modal-edit-category').on('show.bs.modal', function (event) {

      var button = $(event.relatedTarget)
      var catid = button.data('catid')
      var catname = button.data('catname')
      var catdesc = button.data('catdesc') // Extract info from data-* attributes
      // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
      // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
      var modal = $(this)

      modal.find('.modal-body #eCatID').val(catid)
      modal.find('.modal-body #eCatDesc').val(catdesc)
      modal.find('.modal-body #eCatName').val(catname)

    })

</script>


{{-- edit items --}}
<script>
    $('#modal-edit-items').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var itemid = button.data('itemid')

        $.ajax({
        type: 'POST',
        url: 'getItem',
        data: {'_token': $('input[name=_token').val(),
            'eItemID': itemid},
        dataType: 'json',
        success: function(data){
            $('#eItemID').val(itemid);
            $('#eItemname').val(data.result.itemname);
            $('#eItemDesc').val(data.result.itemdesc);
            $('#ePrice').val(data.result.price);
            $('#eQuantity').val(data.result.quantity);
            $('#eCatName').val(data.result.catid);

        },
        error: function (err){
           console.log('Failed! ' + err);
        }

        })
        })

</script>


{{-- edit user --}}
<script>
    $('#modal-edit-user').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget)
      var userid = button.data('id')
      var username = button.data('username')
      var email = button.data('email')
      var firstname = button.data('fname')
      var lastname = button.data('lname')
      var password = button.data('password') // Extract info from data-* attributes
      // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
      // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
      var modal = $(this)

      modal.find('.modal-body #eID').val(userid)
      modal.find('.modal-body #eUsername').val(username)
      modal.find('.modal-body #eEmail').val(email)
      modal.find('.modal-body #eFirstName').val(firstname)
      modal.find('.modal-body #eLastName').val(lastname)
      modal.find('.modal-body #ePassword').val(password)

    })

</script>

<script>
  $(function () {
    $("#items_table").DataTable();

  });
</script>



<script>
  @if(Session::has('message'))
    var type="{{Session::get('alert-type', 'success')}}";

    switch(type){
      case 'success':
      toastr.success('{{Session::get('message')}}');
      break;
      case 'error':
      toastr.error('{{Session::get('message')}}');
      break;
    }
  @endif
</script>







    <script>
    //retrieve name of items in delete items modal
      $('#modal-delete-items').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var itemName = button.data('itemname');
        var id= button.data('itemid');

        var modal = $(this);

        modal.find('.modal-body #dItemID').val(id);
        modal.find('.modal-body #dItemName').html(itemName);

        })


    </script>


    <script>
        // retrieve name of category in delete category modal
     $('#modal-delete-category').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget)
      var catid = button.data('catid')
      var catname = button.data('catname')
      var modal = $(this)

      modal.find('.modal-body #dCatID').val(catid)
      modal.find('.modal-body #dCatName').html(catname)

    })

</script>


{{-- delete user --}}
<script>
    $('#modal-delete-user').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget)
      var userid = button.data('id')
      var fname = button.data('fname')
      var lname = button.data('lname')
      // Extract info from data-* attributes
      // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
      // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
      var modal = $(this)

      modal.find('.modal-body #dID').val(userid)
      modal.find('.modal-body #dFullName').html(fname + ' ' + lname)


    })

</script>




 <script type="text/javascript">
   $(document).ready(function() {
  
    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.profile-pic').attr('src', e.target.result);
            }
    
            reader.readAsDataURL(input.files[0]);
        }
    }
   
    $(".file-upload").on('change', function(){
        readURL(this);
    });
    
    $(".upload-button").on('click', function() {
       $(".file-upload").click();
    });
});
 </script>

</body>
</html>
