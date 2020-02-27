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




 @endsection


