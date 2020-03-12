<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'LOOP') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <!-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> -->

    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <!-- <link rel="stylesheet" href="css/style.css"> -->

    <!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
    <!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script> -->
    <!-- {{-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> --}}
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> --}} -->

    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->

    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous"> -->

    <!--Import Google Icon Font-->
    <!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> -->

    <!-- Compiled and minified JavaScript -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script> -->


     <!-- Font Awesome Icons -->
  <!-- <link rel="stylesheet" href="bower_components/admin-lte/plugins/fontawesome-free/css/all.min.css"> -->
  <!-- Theme style adminstyle-->
  {{-- <link rel="stylesheet" href="bower_components/admin-lte/dist/css/adminlte.min.css"> --}}
  <!-- Select -->
  <!-- <link rel="stylesheet" href="bower_components/admin-lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css"> -->
  <!-- <link rel="stylesheet" href="bower_components/admin-lte/plugins/select2/css/select2.min.css"> -->
    <!-- DataTables -->
  <!-- <link rel="stylesheet" href="bower_components/admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.css"> -->
   <!-- Date picker problems
  <link rel="stylesheet" href="bower_components/admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  -->
  <!-- <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" /> -->
  <!-- <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script> -->
    <!-- bootstrap datepicker -->
  <!-- <link rel="stylesheet" href="bower_components/admin-lte/dist/css/bootstrap-datepicker.min.css"> -->

      <!-- Toastr -->
  <!-- <link rel="stylesheet" href="bower_components/admin-lte/plugins/toastr/toastr.min.css"> -->
  <!-- Google Font: Source Sans Pro -->
  <!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> -->


      <!-- angular datatable -->
      <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/angular-data-table/0.8.1/material.css" integrity="sha256-wJo5gtF+u+ZWGuf0wTVDOtfyrPIWF7jAB+qlYx+78d8=" crossorigin="anonymous" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/angular-data-table/0.8.1/material.min.css" integrity="sha256-3d30ZChWkJs7cJ4IPPBr8vrbF+qLluUXNTVxSkypyR8=" crossorigin="anonymous" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/angular-data-table/0.8.1/material.min.css.map" integrity="undefined" crossorigin="anonymous" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/angular-data-table/0.8.1/dataTable.css" integrity="sha256-Qag8nSImj1zxbNwxZV2mJ3uRginlgSlmUjO8nGJtaV0=" crossorigin="anonymous" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/angular-data-table/0.8.1/dataTable.min.css" integrity="sha256-Hy8+mUOLD1moX0EvqObO8nwARTkEEPbEeXsGxmeeRRY=" crossorigin="anonymous" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/angular-data-table/0.8.1/dataTable.min.css.map" integrity="undefined" crossorigin="anonymous" /> -->


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

      <!-- Compiled and minified JavaScript -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

      {{-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">

        <!--Import jQuery Library-->
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <!--Import materialize.js-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script> --}}

</head>
<body>
    <script>
    // $(document).ready(function(){
    //     $('.sidenav').sidenav();
    //   });
    //   function zxc(){
    //     $('#modal1').modal('close');
    //   };
  </script>
    @include('includes.header')
    @include('includes.sidebar')

    @yield('content')

    @include('includes.footer')


    <!-- {{-- <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script> --}}
    {{--  --}} -->

<!-- jQuery -->
<!-- <script src="bower_components/admin-lte/plugins/jquery/jquery.min.js"></script> -->
<!-- Bootstrap 4 -->
<!-- <script src="bower_components/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script> -->
<!-- AdminLTE App -->
<!-- <script src="bower_components/admin-lte/dist/js/adminlte.min.js"></script> -->
<!-- Select2 -->
<!-- <script src="bower_components/admin-lte/plugins/select2/js/select2.full.min.js"></script> -->

<!-- DataTables -->
<!-- {{-- <script src="angular-datatables.min.js"></script>
<script src="angular.min.js"></script> --}} -->
<!-- <script src="bower_components/admin-lte/plugins/datatables/jquery.dataTables.js"></script> -->
<!-- <script src="bower_components/admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script> -->

<!-- <script src="bower_components/admin-lte/plugins/toastr/toastr.min.js"></script> -->

<!-- angular
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.9/angular.min.js"></script> -->

 <!-- {{-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"> --}} -->

</body>
</html>




