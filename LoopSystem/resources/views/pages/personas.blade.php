@extends('includes.admin_template')

@section('content')
<div ng-app="myPersonaApp" ng-controller="myPersonaController">
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">

          <h1 class="m-0 text-dark"><i class="nav-icon fas fa-comments"></i> Persona</h1>
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
        <button type="button" class="waves-effect waves-light btn-small" data-toggle="modal" data-target="#modal-default">
          <i class="fas fa-plus mr-2"></i>Add Persona
        </button>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="categories_table" class="table table-bordered table-striped">
          <thead>
           <tr>
                <th width="10%">ID</th>
                <th width="40%">Name</th>
                <th width="40%">Status</th>
                <th width="10%"></th>
              </tr>
          </thead>
          <tbody>
              <tr ng-repeat="row in data">
                  <td>@{{ row.persona_id}}</td>
                  <td>@{{ row.persona_name }}</td>
                  <td>@{{ row.persona_status }}</td>
                  <td>
                      <button type="button" class="waves-effect waves-light btn-small blue" id='' data-toggle="modal" data-target="#modal-edit" ng-click="fetchSingleData(row.persona_id, row.persona_name)">

                            <i class="material-icons">edit</i></button>
                      <button type="button" class="waves-effect waves-light btn-small red right" id='' data-toggle="modal" data-target="#modal-delete" ng-click="fetchDel(row.persona_id, row.persona_name)">
                      <i class="material-icons">delete</i></button>
                </td>
              </tr>

          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->

<!-- add items modal -->
<div class="modal" id="modal-default">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-danger">
            <h4 class="modal-title">Add New Persona</h4>
          </div>
          <form action="" method="POST">
          <div class="modal-body">
            <div class="form-group">
              {{ csrf_field() }}

              <div class="input-field col s6">
                <input type="text" name="personaName" id="personaName" ng-model="personaName" class="validate" required>
                <label for="personaName">Persona Name</label>
              </div>
              <!-- <input type="text" name="serviceName" id="serviceName" ng-model="serviceName" placeholder="Service Name" required> -->
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="waves-effect waves-light btn-small red left" data-dismiss="modal">Cancel</button>
            <button type="button" class="waves-effect waves-light btn-small green right" name="submit" id='categoryAddBtn' ng-click="insertPersona()" >Save</button>
          </div>
        </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.add items modal -->


     <!-- edit item modal -->
     <div class="modal fade" id="modal-edit">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header btn-danger">
            <h4 class="modal-title">Edit Service</h4>
          </div>
          <form action="" method="POST">
              {{ csrf_field() }}
              {{method_field('PATCH')}}
          <div class="modal-body" >
              <input type="text" class="form-control" placeholder="Service ID" ng-model="id" required>
              <div class="form-group">
              <label>Persona Name: </label>
              <input type="text" class="form-control" placeholder="Service Name" required ng-model="editPersonaName">
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="waves-effect waves-light btn-small red left" data-dismiss="modal">Cancel</button>
            <button type="button" class="waves-effect waves-light btn-small blue right" ng-click="editPersona()">Save changes</button>
          </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.edit item modal -->

          <!-- delete categories modal -->
    <div class="modal fade" id="modal-delete">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-danger">
            <h4 class="modal-title">Delete Persona</h4>
          </div>
          {{-- <!-- <form action="{{route('catSoftDelete')}}" method="POST"> --> --}}
           {{ csrf_field() }}
           <div class="modal-body">
          <input type="text" ng-model="dPersonaId" class="form-control">
          <h6 style="text-align:center">Are you sure you want to delete persona <label ng-value='dPersonaName'></label>?</h6>
          </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="waves-effect waves-light btn-small red left" data-dismiss="modal">Cancel</button>
            <button type="button" class="waves-effect waves-light btn-small blue right" id='categoryDelBtn' ng-click='delPersona()'>Delete</button>
          </div>
          <!-- </form> -->
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.delete item modal -->

    </div>

<!-- Angular js -->
<!-- angular -->
<script src ="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment-with-locales.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.9/angular.min.js"></script>
  <script>
  var personaApp = angular.module("myPersonaApp", []);

  personaApp.controller("myPersonaController", function($scope, $http){
      //insert new service
      $scope.insertPersona = function(){
        $http.post(
            "insertPersona",
            {'personaName':$scope.personaName}
        ).then(function(){
            $scope.init();
            $('#modal-default').modal('hide');
            $('.modal-backdrop').remove();
            M.toast({html: 'Successfully Added!', classes: 'rounded'});
        })
    }

    //display service
    $scope.init= function(){
        $http.get('getPersona').then(function(response){
        $scope.data = response.data;
    });
    }

    // fetch data to edit
    $scope.fetchSingleData = function(id, name){
        $scope.editPersonaName = name;
        $scope.id = id;
    };

    //edit a service
    $scope.editPersona = function(){
        $http.post(
            'editPersona',
            {'personaName':$scope.editPersonaName, 'id':$scope.id}
        ).then(function(data){
            $scope.init();
            $('#modal-edit').modal('hide');
            $('.modal-backdrop').remove();
            M.toast({html: 'Successfully Updated!', classes: 'rounded'});
        })
    };

    // fetch data to delete
    $scope.fetchDel = function(id, name){
        $scope.dPersonaId = id;
        // $scope.dServiceName = name;
    }

    //delete a service
    $scope.delPersona = function(){
        $http.post(
            'deletePersona',
            {'id':$scope.dPersonaId}
        ).then(function(response){
            $scope.init();
            $('#modal-delete').modal('hide');
            $('.modal-backdrop').remove();
            M.toast({html: 'Successfully Deleted!', classes: 'rounded'});
        })
    }

    $scope.init();

  });
  </script>

 @endsection


