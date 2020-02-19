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

  <title>LOOP</title>

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
  <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
  <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="bower_components/admin-lte/dist/css/bootstrap-datepicker.min.css">

      <!-- Toastr -->
  <link rel="stylesheet" href="bower_components/admin-lte/plugins/toastr/toastr.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <link rel="stylesheet" href="css/custom.css">


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





</body>
</html>
