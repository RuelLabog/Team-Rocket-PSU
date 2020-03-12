<!DOCTYPE html>
<html>

<head>
  <!--Import Google Icon Font-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--Import materialize.css-->
  <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection" />
  <!-- <link type="text/css" rel="stylesheet" href="css/main.css" /> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <!--Let browser know website is optimized for mobile-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>
  <title>Filmyhu-Watch Latest Hindi movies,latest hollywood movies,latest south movies download,movis download,new movie download</title>
  <style>

    header, main, footer,.content {
      padding-left: 300px;
    }

    @media only screen and (max-width : 992px) {
      header, main, footer,.content {
        padding-left: 0;
      }
    }
  </style>
</head>
<body>
<nav class="blue">
  <div class="nav wrapper">
    <div class="container">
<a href="" class="brand-logo center">Adminer</a>
<a href="" class="button-collapse show-on-large" data-activates="sidenav"><i class="material-icons">menu</i></a>
<ul class="right collection hide-on-small-and-down" style="margin:0px;
      border: 0px solid transparent">
        <li class="collection-item avatar" style="background-color: transparent;min-height: 60px;">
          <a href="" class="tooltipped" data-tooltip="Notifications" data-position="top">
            <i class="material-icons circle white blue-text">notifications_active</i></a>
        </li>

      </ul>
    </div>
  </div>
</nav>

<ul class="side-nav fixed" id="sidenav">
  <li>
    <div class="user-view">
<div class="background">
  <img src="img/img11.jpg" alt="" class="responsive-img">
</div>
<a href="">
  <img src="img/img29.jpg" alt="" class="circle">
</a>
<span class="white-text name">Techievivek</span>
<span class="white-text email">Techievivek123@gmail.com</span>
    </div>
  </li>

<li>
  <a href=""><i class="material-icons blue-text">dashboard</i>Dashboard
  </a>
</li>

<li>
    <a href=""><i class="material-icons blue-text">description</i>Posts
    </a>
</li>

<li>
    <a href=""><i class="material-icons blue-text">image</i>Images
    </a>
</li>
<li>
    <a href=""><i class="material-icons blue-text">trending_up</i>Analytics
    </a>
</li>
<li>
    <a href=""><i class="material-icons blue-text">question_answer</i>Comments
    </a>
</li>
<div class="divider"></div>

<li>
    <a href=""><i class="material-icons blue-text">help</i>Help
    </a>
</li>
<li>
    <a href=""><i class="material-icons blue-text">exit_to_app</i>Logout
    </a>
</li>
</ul>




<!--SideNav Finished-->

<div class="content">
    <div class="row">
        <div class="col s12">
            @yield('content')
        </div>
    </div>
</div>

  <!--Import jQuery before materialize.js-->
  <!-- <script type="text/javascript" src="js/jquery.js"></script> -->
  <script type="text/javascript" src="js/materialize.min.js"></script>
  <script>
    $(document).ready(function () {
      // Custom JS & jQuery here
      $('.button-collapse').sideNav();
    });

    document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.modal');
    var instances = M.Modal.init(elems);
  });
</script>
</body>

</html>
