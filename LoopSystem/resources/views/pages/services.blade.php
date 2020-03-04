@extends('includes.admin_template')

@section('content')
<div ng-app="myServiceApp" ng-controller="myServiceController">
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">

          <h1 class="m-0 text-dark"><i class="nav-icon fas fa-box"></i> Services</h1>
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
          <i class="fas fa-plus mr-2"></i>Add Service
        </button>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="categories_table" class="table table-bordered table-striped">
          <thead>
           <tr>
                <th width="10%">ID</th>
                <th width="25%">Name</th>
                <th width="25%">Status</th>
                <th width="25%">Date Created</th>
                <th width="15%"></th>
              </tr>
          </thead>
          <tbody>
              <tr ng-repeat="row in data">
                  <td>@{{ row.service_id | json}}</td>
                  <td>@{{ row.service_name }}</td>
                  <td>@{{ row.service_status }}</td>
                  <td ng-model="created_at">@{{ row.created_at }}</td>
                  <td></td>
              </tr>

          </tbody>
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
            <h4 class="modal-title">Add New Service</h4>
          </div>
          <form action="" method="POST">
          <div class="modal-body">
            <div class="form-group">
              {{ csrf_field() }}
              <label>Service Name:</label>
              <input type="text" class="form-control @error('catName') is-invalid @enderror " name="serviceName" id="serviceName" ng-model="serviceName" placeholder="Service Name" required>
                @{{ serviceName }}
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-success" name="submit" id='categoryAddBtn' ng-click="insertService()">Save changes</button>
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
            <h4 class="modal-title">Edit Service</h4>
          </div>
          <form action="" method="POST">
              {{ csrf_field() }}
              {{method_field('PATCH')}}
          <div class="modal-body">
              <input type="hidden" class="form-control" id="eCatID" name="eCatID" value="" placeholder="Category Name" required>
              <div class="form-group">
              <label>Service Name:</label>
              <input type="text" class="form-control" id="eCatName" name="eCatName" placeholder="Category Name" required>
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
            <h4 class="modal-title">Delete Service</h4>
          </div>
          {{-- <!-- <form action="{{route('catSoftDelete')}}" method="POST"> --> --}}
           {{ csrf_field() }}
          <div class="modal-body">
          <input type="hidden" id="dCatID" name="dCatID" class="form-control">
          <h6 style="text-align:center">Are you sure you want to delete service <label id="dCatName"></label>?</h6>
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

    </div>
    <!-- /.end of ng-app and ng-controller -->


<!-- Angular js -->
<!-- angular -->
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.9/angular.min.js"></script>
  <script>
  var serviceApp = angular.module("myServiceApp", []);

  serviceApp.controller("myServiceController", function($scope, $http){
    $scope.insertService = function(){
        $http.post(
            "insertService",
            {'serviceName':$scope.serviceName}
        )
        // alert($scope.serviceName);
    }


    $http.get('getServices').then(function(response){
        $scope.data = response.data;
    });

    $scope.created_at = moment($scope.created_at).format('llll');

  });
  </script>

 @endsection


