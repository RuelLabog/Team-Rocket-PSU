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
   <!-- Date picker problems
  <link rel="stylesheet" href="bower_components/admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  -->
    <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="bower_components/admin-lte/dist/css/bootstrap-datepicker.min.css">


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
<!-- AdminLTE for demo purposes -->
<script src="bower_components/admin-lte/dist/js/demo.js"></script>
  <!-- ChartJS -->
<script src="bower_components/admin-lte/plugins/chart.js/Chart.min.js"></script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('#select2').select2();






  });
</script>

<script>


$(document).ready(function() {

          //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')

    var pieData        = {
      labels: [
          'Admin and Finance Department',
          'Human Resources and Development',
          'Information Technology & Development',
          'Messaging Support Team',
          'Sales and Marketing',
          'Production Recruitment Department',
      ],
      datasets: [
        {
          data: [700,500,400,600,300,100],
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
        }
      ]
    }
    var pieOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var pieChart = new Chart(pieChartCanvas, {
      type: 'pie',
      data: pieData,
      options: pieOptions
    })

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
            $('#eQuantity').val(data.result.quantity);
            $('#eCatName').val(data.result.catid);

        },
        error: function (err){
           console.log('Failed! ' + err);
        }

        })
        })

</script>

{{-- edit receipt --}}
<script>
    $('#modal-edit-receipt').on('show.bs.modal', function (event) {

     var button = $(event.relatedTarget)
     var recid = button.data('recid')
     var ornum = button.data('ornum')
     var pdate = button.data('pdate')
     var supplier = button.data('supplier')
      // Extract info from data-* attributes
     // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
     // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
     var modal = $(this)

     modal.find('.modal-body #eRecID').val(recid)
     modal.find('.modal-body #eOrnum').val(ornum)
     modal.find('.modal-body #ePdate').val(pdate)
     modal.find('.modal-body #eSupplier').val(supplier)

   })

</script>

{{-- edit user --}}
<script>
    $('#modal-edit-user').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget)
      var userid = button.data('userid')
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
      modal.find('.modal-body #eConfPassword').val(password)

    })

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

<script>
    // retrieve name of category in delete category modal
    $('#modal-delete-receipt').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var recid = button.data('recid')
    var ornum = button.data('ornum')
    var modal = $(this)

    modal.find('.modal-body #dRecID').val(recid)
    modal.find('.modal-body #dOrnum').html(ornum)

    })

</script>


{{-- delete user --}}
<script>
    $('#modal-delete-user').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget)
      var userid = button.data('userid')
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

        $(document).ready(function(){
            // retrieve data to category table
            $('#categories_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{route('categories.index')}}",
                },
                columns: [
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'catname',
                        name: 'catname'
                    },
                    {
                        data: 'catdesc',
                        name: 'catdesc'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false
                    }
                ]
            });

            // retrieve data to items table
            $('#items_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{route('items.index')}}",
                },
                columns: [
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'itemname',
                        name: 'itemname'
                    },
                    {
                        data: 'itemdesc',
                        name: 'itemdesc'
                    },
                    {
                        data: 'catname',
                        name: 'catname'
                    },
                    {
                        data: 'quantity',
                        name: 'quantity'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false
                    }
                ]
            });


            $('#users_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{route('users_page.index')}}",
                },
                columns: [
                    {
                        data: 'username',
                        name: 'username'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false
                    }
                ]
            });


            $('#receipts_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{route('receipt.index')}}",
                },
                columns: [
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'ornum',
                        name: 'ornum'
                    },
                    {
                        data: 'pdate',
                        name: 'pdate'
                    },
                    {
                        data: 'supplier',
                        name: 'supplier'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false
                    }
                ]
            });


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

{{-- reduce quantity --}}
<script>
    $('#modal-reduce-quantity').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget)
      var itemid = button.data('itemid')
      var quantity = button.data('quantity')
    $("#rQuantity")
            .attr("min", 0)
            .attr("max", quantity)
            .val(quantity)
      // Extract info from data-* attributes
      // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
      // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
      var modal = $(this)

      modal.find('.modal-body #rItemID').val(itemid)
      modal.find('.modal-body #rQuantity').val(quantity)
    })

</script>

{{-- increase quantity --}}
<script>
  $('#modal-increase-quantity').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var itemid = button.data('itemid')
    var quantity = button.data('quantity')
  $("#iQuantity")
          .attr("min", quantity)
          
          .val(quantity)
    // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)
    modal.find('.modal-body #iItemID').val(itemid)
    modal.find('.modal-body #iQuantity').val(quantity)
  })
</script>
</body>
</html>
