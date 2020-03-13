@extends('includes.admin_template')

@section('content')
<div ng-app="myServiceApp" ng-controller="myServiceController">

<!-- title and add button modal -->
<div class="row">
    <div class="col s12">
      <div class="card blue-grey darken-1">
        <div class="card-content white-text">
          <span class="card-title">Services</span>
          <a class="waves-effect waves-light btn modal-trigger" href="#modal-default">
                <i class="material-icons">add</i>Add Service
          </a>
        </div>
      </div>
    </div>

  <!-- /.title and add button modal -->


      <!-- data table -->
    <div class="col s12">
      <div class="card">
        <div class="card-content">
            <div class="col s2">
                <label>Records per page</label>
                <select class="browser-default" ng-model="data_limit">
                    <option>10</option>
                    <option>20</option>
                    <option>50</option>
                    <option>100</option>
                </select>
            </div>

            <div class="input-field col s6  right">
                <label for="search">Search</label>
                <input type="text" ng-model="search" ng-change="filter()" id="search" class="form-control" />
            </div>

            <!-- table -->
            <div class="row">
            <div class="col s12" >
                <table class="highlight striped table-bordered">
                    <thead>
                        <th width="25%">Status&nbsp;<a ng-click="sort_with('Status');"><i class="material-icons">swap_vert</i></a></th>
                        <th width="25%">Name&nbsp;<a ng-click="sort_with('Name');"><i class="material-icons">swap_vert</i></a></th>
                        <th width="25%">Date Created&nbsp;<a ng-click="sort_with('Date');" style="cursor:text-menu"><i class="material-icons">swap_vert</i></a></th>
                        <th width="10%">&nbsp;</th>

                    </thead>
                    <tbody ng-show="filter_data > 0">
                        <tr ng-repeat="row in data = (file | filter:search | orderBy : base :reverse) | beginning_data:(current_grid - 1)* data_limit | limitTo:data_limit">
                            <td>

                                 <!-- Switch -->
                                    <div class="switch">
                                        <label>
                                        Inactive
                                        <input type="checkbox" ng-if="row.service_status == 'active'" checked class="green modal-trigger" ng-click="updateStatus(row.id, row.service_status, row.service_name)" data-target="modal-status">
                                        <input type="checkbox" ng-if="row.service_status == 'inactive'" class="modal-trigger" ng-click="updateStatus(row.id, row.service_status, row.service_name)" data-target="modal-status">
                                        <span class="lever"></span>
                                        Active
                                        </label>
                                    </div>
                            </td>
                            <td>@{{ row.service_name}}</td>
                            <td>@{{row.created_at}}</td>
                            <td>
                                <a title="Edit" class="btn-floating btn-small blue modal-trigger" id='' href="#modal-edit" ng-click="fetchSingleData(row.id, row.service_name)">
                                    <i class="material-icons">edit</i>
                                </a>
                                <a title="Delete" class="btn-floating btn-small red right modal-trigger" id=''  href="#modal-delete" ng-click="fetchDel(row.id, row.service_name)">
                                    <i class="material-icons">delete</i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot ng-show="filter_data == 0">
                        <th></th>
                        <th></th>
                        <th>No matching records found..</th>
                        <th></th>
                        <th></th>
                    </tfoot>

                </table>
            </div>
      </div>
<!-- /.table -->
<!--  record length and pagination -->
<div class="col-md-12">
        <div class="col-md-4">
            <p>Showing @{{data.length}} of @{{ entire_user}} entries</p>
        </div>
        <div class="col-md-6 pull-right" ng-show="filter_data > 0">
            <pagination page="current_grid"
                on-select-page="page_position(page)"
                boundary-links="true"
                total-items="filter_data"
                items-per-page="data_limit"

                class="pagination-small right-align"
                previous-text="&laquo;" next-text="&raquo;" style="cursor:context-menu">
            </pagination>
        </div>
    </div>
    <!-- record length -->
        </div>
        <!-- <div class="card-action">
          <a href="#">This is a link</a>
          <a href="#">This is a link</a>
        </div> -->
      </div>
    </div>
  </div>


<!-- update status modal -->
<div class="modal" id="modal-status">
        <div class="modal-content">
          <div class="modal-header bg-danger">
            <h4 class="modal-title">Change Service Status</h4>
          </div>
          {{-- <!-- <form action="{{route('catSoftDelete')}}" method="POST"> --> --}}
           {{ csrf_field() }}
          <div class="modal-body">
          <input type="hidden"  ng-model="sId" class="form-control">
          <input type="hidden"  ng-model="sStatus" class="form-control">
          <h6 style="text-align:center" ng-bind-html="confirmMessage"></h6>
          </div>
          <div class="modal-footer">
            <button type="button" class="waves-effect waves-light btn-small red left modal-close" data-dismiss="modal">Cancel</button>
            <button type="button" class="waves-effect waves-light btn-small blue right" id='categoryDelBtn' ng-click='changeStatus()'>Change</button>
          </div>
          <!-- </form> -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.update status  modal -->


    <!-- Modal Add -->
<div class="modal" id="modal-default">
        <div class="modal-content">
          <div class="modal-header bg-danger">
            <h4 class="modal-title">Add New Service</h4>
          </div>
          <form action="" method="POST">
          <div class="modal-content">
                <div class="col s12">
                    <div class="input-field col s12">
                        <input type="text" name="serviceName" id="serviceName" ng-model="serviceName" class="validate" required>
                        <label for="serviceName">Service Name</label>
                        <span class="helper-text" data-error="This field is required"></span>
                    </div>
                </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn-small red left modal-close" >Cancel</button>
            <button type="button" class="btn-small green right" name="submit" ng-click="insertService()" >Save</button>
          </div>
        </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /. modal add -->

        <!-- edit item modal -->
        <div class="modal fade" id="modal-edit">
        <div class="modal-content">
          <div class="modal-header btn-danger">
            <h4 class="modal-title">Edit Service</h4>
          </div>
          <form action="" method="POST">
              {{ csrf_field() }}
              {{method_field('PATCH')}}
          <div class="modal-content" >
                <input type="hidden" class="form-control" id="eCatID" name="eCatID" value="" placeholder="Service ID" ng-model="id" required>
                <div class="col 12">
                    <div class="input-field col s6">
                        <label>Service Name </label>
                        <input type="text" class="validate" id="eCatName" name="eCatName" placeholder="Service Name" required ng-model="editServiceName">
                        <span class="helper-text" data-error="This field is required"></span>
                    </div>
                </div>


          </div>
          <div class="modal-footer">
            <button type="button" class="waves-effect waves-light btn-small red left modal-close" data-dismiss="modal">Cancel</button>
            <button type="button" class="waves-effect waves-light btn-small blue right" id="categoryEditBtn" ng-click="editService()">Save changes</button>
          </div>
          </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.edit item modal -->


          <!-- delete categories modal -->
          <div class="modal" id="modal-delete">
        <div class="modal-content">
          <div class="modal-header bg-danger">
            <h4 class="modal-title">Delete Service</h4>
          </div>
          {{-- <!-- <form action="{{route('catSoftDelete')}}" method="POST"> --> --}}
           {{ csrf_field() }}
          <div class="modal-body">
          <input type="hidden" id="dCatID" name="dCatID" ng-model="dServiceId" class="form-control">
          <h6 style="text-align:center">Are you sure you want to delete service <b ng-bind='dServiceName'></b>?</h6>
          </div>
          <div class="modal-footer">
            <button type="button" class="waves-effect waves-light btn-small orange left modal-close" data-dismiss="modal">Cancel</button>
            <button type="button" class="waves-effect waves-light btn-small red right" id='categoryDelBtn' ng-click='delService()'>Delete</button>
          </div>
          <!-- </form> -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.delete item modal -->

</div>
<!-- /.ng-app -->

  <!-- Angular js -->
<!-- angular -->
<script src ="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment-with-locales.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.2.12/angular.min.js"></script>

<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-sanitize.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.10.0/ui-bootstrap-tpls.min.js"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.9/angular.min.js"></script> -->
  <script>
  var serviceApp = angular.module("myServiceApp", ['ui.bootstrap', 'ngSanitize']);

  serviceApp.filter('beginning_data', function(){
      return function(input, begin){
          if(input){
              begin = +begin;
              return input.slice(begin);
          }
          return [];
      }
  });

  serviceApp.controller("myServiceController", function($scope, $http, $timeout){
      //insert new service
    $scope.insertService = function(){
        if($scope.serviceName == null){
            M.toast({html: 'Service name is required!', classes: 'rounded red'});
        }else{
            $http.post(
                "insertService",
                {'serviceName':$scope.serviceName}
            ).then(function(){
                $scope.init();
                $scope.serviceName = null;
                angular.element('.modal-close').trigger('click');
                M.toast({html: 'Successfully Added!', classes: 'rounded green'});
            });
        }

    }

    //display service
    $scope.init= function(){
        $http.get('getServices').then(function(response){
        $scope.data = response.data;
        $scope.file = response.data;
        $scope.current_grid =1;
        $scope.data_limit = 10;
        $scope.filter_data = $scope.data.length;
        $scope.entire_user =  $scope.file.length;
    });
    }

    // fetch data to edit
    $scope.fetchSingleData = function(id, name){
        $scope.editServiceName = name;
        $scope.id = id;
    };

    //edit a service
    $scope.editService = function(){
        if($scope.editServiceName == null){
            M.toast({html: 'Service name is required', classes: 'rounded red'});
        }else{
            $http.post(
                'editService',
                {'serviceName':$scope.editServiceName, 'id':$scope.id}
            ).then(function(data){
                $scope.init();
                angular.element('.modal-close').trigger('click');
                M.toast({html: 'Successfully Updated!', classes: 'rounded green'});
            });
        }

    };

    // fetch data to delete
    $scope.fetchDel = function(id, name){
        $scope.dServiceId = id;
        $scope.dServiceName = name;
    }

    //delete a service
    $scope.delService = function(){
        $http.post(
            'deleteService',
            {'id':$scope.dServiceId}
        ).then(function(response){
            $scope.init();
            angular.element('.modal-close').trigger('click');
            M.toast({html: 'Successfully Deleted!', classes: 'rounded green'});
        })
    }

    // fecth data to update status
    $scope.updateStatus = function(id, status, name){
        $scope.init();
        $scope.sId = id;
        $scope.sStatus = status;
        if(status == 'inactive'){
            $scope.confirmMessage = 'Are you sure you want to change service <b>'+name+'</b> status from inactive to active?';
        }else{
            $scope.confirmMessage = 'Are you sure you want to change service <b>'+name+'</b> status from active to inactive?';
        }
    }
    // update service status
    $scope.changeStatus = function(){
        $http.post(
            'updateStatus',
            {'id':$scope.sId, 'status':$scope.sStatus}
        ).then(function(response){
            $scope.init();
            angular.element('.modal-close').trigger('click');
            M.toast({html: 'Successfully Updated!', classes: 'rounded green'});
        })
    }

    $scope.init();

    //pagination
    $scope.page_position = function(page_number){
        $scope.current_grid =page_number;
    }


    //filter in search
    $scope.filter = function(){
        $timeout(function(){
            $scope.filter_data = $scope.data.length;
        }, 20);

    }

    //reverse sort (arrow)
    $scope.sort_with = function(base) {
        $scope.base = base;
        $scope.reverse = !$scope.reverse;
    };

  });
  document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.modal');
    var instances = M.Modal.init(elems);
  });
  </script>

 @endsection
