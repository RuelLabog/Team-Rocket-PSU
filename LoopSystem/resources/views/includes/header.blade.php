  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-danger navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item" >
        <a class="sidenav-trigger" data-widget="pushmenu" href="#" ><i class="material-icons">menu</i></a>
      </li>
    </ul>

     <!-- floating buttons -->
     <div class="fixed-action-btn horizontal">
        <a class="btn-floating btn-large black">
            <i class="large material-icons">mode_edit</i>
        </a>
        <ul>
            <li><a class="btn-floating red"><i class="material-icons">insert_chart</i></a></li>
            <li><a class="btn-floating yellow darken-1"><i class="material-icons">format_quote</i></a></li>
            <li><a class="btn-floating green"><i class="material-icons">publish</i></a></li>
            <li><a class="btn-floating blue"><i class="material-icons">attach_file</i></a></li>
        </ul>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.fixed-action-btn');
            var instances = M.FloatingActionButton.init(elems, {
                hoverEnabled: false
            });
        });

  // Or with jQuery



//   var instance = M.FloatingActionButton.getInstance(elem);

  /* jQuery Method Calls
    You can still use the old jQuery plugin method calls.
    But you won't be able to access instance properties.
*/



</script>


    <!-- Right navbar links -->

  </nav>
  <!-- /.navbar -->
