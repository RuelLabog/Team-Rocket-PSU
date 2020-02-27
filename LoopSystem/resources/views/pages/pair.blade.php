@extends('includes.admin_template')

@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">

          <h1 class="m-0 text-dark"><i class="nav-icon fas fa-heartbeat"></i> Pairing</h1>
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


  <div class="row">
    <div class="col s4 m4">
      <div class="card blue lighten-5">
        <div class="card-content black-text">

          <form action="#">
            <p>
                <label>
                    <h4>Subscribers</h4>
                </label>
            </p>
<<<<<<< HEAD
            <div id='subscribers_panel'>
           <!-- /show online subs not connected to any convo -->
            </div>
=======
            <p>
              <label>
                <input name="group1" type="radio" />
                <span>Yengla (service 1)</span>
              </label>
            </p>
            <p>
              <label>
                <input name="group1" type="radio" />
                <span>Ayaa (service 1)</span>
              </label>
            </p>
            <p>
              <label>
                <input name="group1" type="radio" />
                <span>Yengla (service 1)</span>
              </label>
            </p>
            <p>
              <label>
                <input name="group1" type="radio" />
                <span>Ayaa (service 2)</span>
              </label>
            </p>
            <p>
              <label>
                <input name="group1" type="radio" />
                <span>Yengla (service 2)</span>
              </label>
            </p>
            <p>
              <label>
                <input name="group1" type="radio" />
                <span>Ayaa (service 2)</span>
              </label>
            </p>
            <p>
              <label>
                <input name="group1" type="radio" />
                <span>Yengla (service 2)</span>
              </label>
            </p>
            <p>
              <label>
                <input name="group1" type="radio" />
                <span>Ayaa (service 2)</span>
              </label>
            </p>

>>>>>>> 814f684b24694389381da0c4ed473dbf191f303b
          </form>

        </div>

      </div>
    </div>

    <div class="col s4 m4">
        <div class="card blue lighten-5">
            <div class="card-content black-text">

            <form action="#">
              <p>
                  <label>
                      <h4>Personas</h4>
                  </label>
              </p>
            <div id="operators_panel">
                <!-- show online operators -->
            </div>
            </form>
          </div>
        </div>
      </div>

    <div>
        <p>
      <button class="btn waves-effect waves-teal btn-large" type="submit" name="action" style="margin-top: 100px;">
        <i class="material-icons right">arrow_forward</i>
      </button>
    </p>

    <p>
        <button class="btn waves-effect waves-teal btn-large" type="submit" name="action" style="margin-top: 100px;">
            <i class="material-icons right">arrow_back</i>
        </button>
    </p>
    </div>
    <div>

      </div>

      <div class="col s4 m4">
        <div class="card blue lighten-5">
            <div class="card-content black-text">

            <form action="#">
              <p>
                  <label>
                      <h4>Paired</h4>
                  </label>
              </p>
              <p>
                <label>
                  <input name="group1" type="radio" />
                  <span>Yengla and Ayaa (service 2)</span>
                </label>
              </p>
              <p>
                <label>
                  <input name="group1" type="radio" />
                  <span>Ayaa and (service 1)</span>
                </label>
              </p>

            </form>

          </div>

        </div>
      </div>
  </div>
  <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
<script type="text/javascript" src="http://localhost:8000/socket.io/socket.io.js"></script>
<script>
     var socket = io('http://localhost:8000');
 $(function(){

        var $subscribers = $('#subscribers_panel');
        var $operators = $('#operators_panel');

        // show subs in subscribers_panel
        socket.on('showSubscribers', function(rows) {
        var html='';
        for (var i=0; i<rows.length; i++) {
          html += '<p><label> <input name="subscribers_rad" type="radio" onclick="showOperators('+rows[i].service_id+')" value="'+rows[i].id+'"/> <span>'+rows[i].subscriber_name+'</span></label></p>';

        }
         $subscribers.html(html);
        });

        // show operators in operator_panel when subs name is clicked

        socket.on('showOperators', function(rows) {
        var html='';
        for (var i=0; i<rows.length; i++) {
          html += '<p><label> <input name="operators_rad" type="radio" value="'+rows[i].id+'"/> <span>'+rows[i].username+'</span></label></p>';

        }
         $operators.html(html);
        });

          // show operators in operator_panel

        socket.on('showOnOperators', function(rows) {
        var html='';
        for (var i=0; i<rows.length; i++) {
          html += '<p><label style="font-size:15px;">'+rows[i].username+'</label></p>';

        }
         $operators.html(html);
        });



 });

 function showOperators(service_id){
           socket.emit('selectOperators', (service_id));
        }
</script>



 @endsection


