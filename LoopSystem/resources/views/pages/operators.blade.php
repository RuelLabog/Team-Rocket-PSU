@extends('includes.admin_template')

@section('content')
<div ng-app="myOperatorsApp" ng-controller="myOperatorsController">

<div class="row">
    <div class="col s12">
        <div class="card blue-grey darken-1">
            <div class="card-content white-text">
            <span class="card-title">Operators</span>
            <a class="waves-effect waves-light btn modal-trigger" href="#modal-default">
                    <i class="material-icons">add</i>Add Operator
            </a>
            </div>
        </div>
    </div>


<div class="col s12">
    <div class="card">
      <div class="card-content">
        <div class="row">
        <div class="col s2">
                <label>Records per page</label>
                <select class="browser-default" ng-model="data_limit">
                    <option>10</option>
                    <option>20</option>
                    <option>50</option>
                    <option>100</option>
                </select>
            </div>

            <div class="col s8 right">
                <label for="search">Search:</label>
                <input type="text" ng-model="search" ng-change="filter()" id="search" class="form-control" />
            </div>
        </div>
        <br/>

        <div class="row">
            <div class="col-md-12" >
                <table class="highlight striped table-bordered">
                    <thead>
                        <th width="15%">Status&nbsp;<a ng-click="sort_with('Status');"><i class="material-icons">swap_vert</i></a></th>
                        <th width="15%">Username&nbsp;<a ng-click="sort_with('Username');"><i class="material-icons">swap_vert</i></a></th>
                        <th width="20%">Email&nbsp;<a ng-click="sort_with('Email');"><i class="material-icons">swap_vert</i></a></th>
                        <th width="15%">Service&nbsp;<a ng-click="sort_with('Service');"><i class="material-icons">swap_vert</i></a></th>
                        <th width="20%">Date Created&nbsp;<a ng-click="sort_with('Date');" style="cursor:text-menu"><i class="material-icons">swap_vert</i></a></th>
                        <th width="12%">&nbsp;</th>

                    </thead>
                    <tbody ng-show="filter_data > 0 && ctr > 0">
                        <tr ng-repeat="row in data = (file | filter:search | orderBy : base :reverse) | beginning_data:(current_grid - 1)* data_limit | limitTo:data_limit">
                            <td>
                            <button class="btn-small red" ng-show="row.user_status == 'inactive'">
                            @{{ row.user_status }}
                            </button>

                            <button class="btn-small green" ng-show="row.user_status == 'active'">
                            @{{ row.user_status }}
                            </button>
                            </td>
                            <td>@{{ row.username}}</td>
                            <td>@{{ row.email }}</td>
                            <td>@{{ row.service_name }}</td>
                            <td><span id="moment">@{{row.created_at}}</span></td>
                            <td>
                                <button type="button" title="Edit" class="waves-effect waves-light btn-floating btn-small blue modal-trigger" id=""  data-target="modal-edit" ng-click="fetchSingleData(row.id, row.username, row.email, row.service_id)">
                                    <i class="material-icons">edit</i>
                                </button>
                                <button type="button" title="Delete" class="waves-effect waves-light btn-floating btn-small red right modal-trigger" id=""  data-target="modal-delete" ng-click="fetchData(row.id, row.username)">
                                <i class="material-icons">delete</i>
                                </button>
                            </td>

                        </tr>
                    </tbody>
                </table>
                <br/>
                <!-- loader -->
                <div class="center" ng-show="ctr == 0">
                    <div class="preloader-wrapper small active">
                        <div class="spinner-layer spinner-blue-only">
                            <div class="circle-clipper left">
                                <div class="circle"></div>
                            </div>
                            <div class="gap-patch">
                                <div class="circle"></div>
                            </div>
                            <div class="circle-clipper right">
                                <div class="circle"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.loader -->
                <h5 ng-show="filter_data == 0" class="center"><b>No records found..</b></h5>
            </div>
      </div>


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
                previous-text="&laquo;" next-text="&raquo;" style="cursor:context-menu"></pagination>
        </div>
    </div>

      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
</div>

<!-- add operator modal -->
    <div class="modal fade" id="modal-default">
        <div class="modal-content">
          <div class="modal-header bg-danger">
            <h4 class="modal-title">Add New Operator</h4>
          </div>
          <form action="" method="POST">
          <div class="modal-body">
              <div class="row">
                        <div class="input-field col s6">
                            <input type="text" class="validate" name="oUsername" id="oUsername" ng-model="oUsername" required>
                            <label for="oUsername">Username</label>
                            <span class="helper-text" data-error="This field is required"></span>
                        </div>

                        <div class="input-field col s6">
                            <input type="email" class="validate" name="oEmail" id="oEmail" ng-model="oEmail"  required>
                            <label for="oEmail">Email</label>
                            <span class="helper-text" data-error="Email is not valid"></span>
                        </div>

                        <div class="input-field col s6">
                            <input type="password" class="validate" name="oPassword" id="oPassword" ng-model="oPassword" required>
                            <label for="oPassword">Password</label>
                            <span class="helper-text" data-error="This field is required"></span>
                        </div>

                        <div class="input-field col s6">
                            <input type="password" class="validate" name="oConfPassword" id="oConfPassword" ng-model="oConfPassword"  required>
                            <label for="oConfPassword">Confirm Password</label>
                            <span class="helper-text" data-error="This field is required"></span>
                        </div>

                        <div class="col s6">
                            <label>Service</label>
                            <select class="browser-default validate" ng-model='serviceId' ng-change="select()">
                                <option value="" disabled selected><label>Select Service</label></option>
                                <option ng-repeat='rows in dataService' value="@{{rows.id}}">@{{rows.service_name}}</option>
                            </select>
                            <span class="helper-text red-text" data-error="This field is required" ng-bind="required"></span>
                        </div>

                        <div class="col s6">
                            <br/>
                            <button type="button" class="waves-effect waves-light btn-small blue left modal-trigger" data-target="Service">Add Service</button>
                        </div>

              </div>


          </div>
          <!-- ./modal-body -->
          <div class="modal-footer">
            <button type="button" class="waves-effect waves-light btn-small red left modal-close">Cancel</button>
            <button type="button" class="waves-effect waves-light btn-small green right" id='operatorAddBtn' name='operatorAddBtn' ng-click="insertOperator()" ng-disabled="OperatorSave" >Save</button>
          </div>
        </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.add items modal -->

    <div class="modal fade" id="modal-edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header btn-danger">
                    <h4 class="modal-title">Edit Operator</h4>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" ng-model="eId" class="form-control" />
                        <div class="input-field col s6">
                            <label for="eUsername"  class="active">Username</label>
                            <input type="text" class="validate" name="eUsername" id="eUsername" ng-model="eUsername" placeholder="Username" required>
                            <span class="helper-text" data-error="This field is required"></span>
                        </div>
                        <div class="input-field col s6">
                            <label for="eEmail" class="active">Email</label>
                            <input type="email" class="validate" name="eEmail" id="eEmail"  ng-model="eEmail" placeholder="Email" required>
                            <span class="helper-text" data-error="Email is not valid"></span>
                        </div>
                        <div class="input-field col s6">
                            <label for="ePassword">Password</label>
                            <input type="password" class="validate" name="ePassword" id="ePassword"  ng-model="ePassword">
                        </div>
                        <div class="input-field col s6">
                            <label for="eConfPassword">Confirm Password</label>
                            <input type="password" class="validate" name="eConfPassword" id="eConfPassword"  ng-model="eConfPassword">
                        </div>
                        <div class="col s6">
                            <label>Service</label>
                            <select class="browser-default" ng-model='eServiceId'>
                                <option value="" disabled selected><label>Select Service</label></option>
                                <option ng-repeat='rows in dataService' value="@{{rows.id}}">@{{rows.service_name}}</option>
                             </select>

                        </div>

                        <div class="col s6">
                            <br/>
                            <button type="button" class="waves-effect waves-light btn-small blue left modal-trigger" data-target="Service">Add Service</button>
                        </div>
                    </div>
                </div>
                <!-- /.modal-body -->
                <div class="modal-footer">
                    <button type="button" class="waves-effect waves-light btn-small red left modal-close">Cancel</button>
                    <button type="button" class="waves-effect waves-light btn-small green right" id="categoryEditBtn" ng-click="editOperator()">Save changes</button>
                </div>
            </div>
        </div>
    </div>




    <!-- delete categories modal -->
    <div class="modal fade" id="modal-delete">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-danger">
            <h4 class="modal-title">Delete Operator</h4>
          </div>
          {{-- <!-- <form action="{{route('catSoftDelete')}}" method="POST"> --> --}}
           {{ csrf_field() }}
          <div class="modal-body">
          <input type="hidden" id="dCatID" name="dCatID" class="form-control" ng-model="dId" >
          <h6 style="text-align:center">Are you sure you want to delete operator <b ng-bind="dOperatorName"></b>?</h6>
          </div>
          <div class="modal-footer">
            <button type="button" class="waves-effect waves-light btn-small orange left modal-close">Cancel</button>
            <button type="button" class="waves-effect waves-light btn-small red right" id='categoryDelBtn' ng-click='delOperator()'>Delete</button>
          </div>
          <!-- </form> -->
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.delete item modal -->


<!-- Service modal -->
<div class="modal" id="Service">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-danger">
            <h4 class="modal-title">Service</h4>
          </div>
          {{-- <!-- <form action="{{route('catSoftDelete')}}" method="POST"> --> --}}
           {{ csrf_field() }}
          <div class="modal-content">
            <div class="input-field col s6">
              <input type="text" class="" name="oService" id="oService" ng-model="oService" required>
              <label for="oService">Service </label>
            </div>
            <button type="button" class="waves-effect waves-light btn green right" id='categoryDelBtn' ng-click='insertService()'>Add</button>
          </div>
          <div class="modal-footer">
            <button type="button" class="waves-effect waves-light btn-small red left modal-close" id="serviceCancel">Cancel</button>

          </div>
          <!-- </form> -->
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.Service modal -->


</div>
<!-- ng app -->

<!-- Angular js -->
<!-- angular -->
 <!-- <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.9/angular.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.2.12/angular.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.10.0/ui-bootstrap-tpls.min.js"></script>

<!-- Moment -->
<script src ="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment-with-locales.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script>

  var operatorApp = angular.module('myOperatorsApp', ['ui.bootstrap']);

  operatorApp.filter('beginning_data', function(){
      return function(input, begin){
          if(input){
              begin = +begin;
              return input.slice(begin);
          }
          return [];
      }
  });


  operatorApp.controller("myOperatorsController", function($scope, $http, $timeout, $interval){
      $scope.ctr = 0;
    //insert operator
    $scope.insertOperator = function(){
        $scope.OperatorSave = true;
        if($scope.oUsername == null || $scope.oPassword == null || $scope.serviceId == null){
            M.toast({html: 'All fields are required!', classes: 'rounded red'});
            $scope.OperatorSave = false;
        }else{
            if($scope.oEmail == null){
                M.toast({html: 'Email is not valid!', classes: 'rounded red'});
                $scope.OperatorSave = false;
            }else{
                if($scope.oPassword != $scope.oConfPassword){
                    M.toast({html: 'Passwords did not match!', classes: 'rounded red'});
                    $scope.OperatorSave = false;
                }else{
                    if($scope.oPassword.length < 8){
                        M.toast({html: 'Password is weak!', classes: 'rounded red'});
                        $scope.OperatorSave = false;
                    }else{
                        $http.post(
                            'insertOperator',
                            {'username':$scope.oUsername, 'email':$scope.oEmail, 'password':$scope.oPassword, 'service': $scope.serviceId}
                        ).then(function(response){
                            $scope.OperatorSave = false;
                            $scope.oUsername = null;
                            $scope.oEmail = null;
                            $scope.oPassword = null;
                            $scope.oConfPassword = null;
                            $scope.serviceId = null;
                            $scope.required = null;
                            angular.element('.modal-close').trigger('click');
                            M.toast({html: 'Successfully Added!', classes: 'rounded green'});
                        });
                    }

                }
            }


        }

    }

    //insert new service
    $scope.insertService = function(){
        if($scope.oService == null){
            M.toast({html: 'Service name is required', classes: 'rounded red'});
        }else{
            $http.post(
                'insertService',
                {'serviceName':$scope.oService}
            )
            .then(function(response){
                $scope.getService();
                $scope.oService = null;
                angular.element('#serviceCancel').trigger('click');
                M.toast({html: 'Successfully Added!', classes: 'rounded green'});
            });
        }

    }

    //display operator data
    $scope.init = function(){
        $scope.ctr =0;
        $http.get('getOperators').then(function(response){
            $scope.data = response.data;
            $scope.file = response.data;
            $scope.current_grid =1;
            $scope.data_limit = 10;
            $scope.filter_data = $scope.data.length;
            $scope.entire_user =  $scope.file.length;
            $scope.ctr=1;

        });
    }

    $scope.getService = function(){
        $http.get('getOperatorService').then(function(response){
            $scope.dataService = response.data;
        })
    }



    //fetch data to edit
    $scope.fetchSingleData = function(id, username, email, service){
        $scope.eId = id;
        $scope.eUsername = username;
        $scope.eEmail = email;
        $scope.eServiceId = service;
    }

    $scope.editOperator = function(){
        if($scope.eUsername == null || $scope.eServiceId == null ){
            M.toast({html: 'All fields are required!', classes: 'rounded red'});
        }else{
            if( $scope.eEmail == null){
                M.toast({html: 'Email is not valid!', classes: 'rounded red'});
            }else{
                if($scope.ePassword != $scope.eConfPassword){
                    M.toast({html: 'Passwords did not match!', classes: 'rounded red'});
                }else{
                    if($scope.ePassword != null){
                        if($scope.ePassword.length < 8){
                            M.toast({html: 'Password is weak!', classes: 'rounded red'});
                        }
                    }else{
                        $http.post(
                            'editOperator',
                            {'id':$scope.eId, 'username':$scope.eUsername, 'email':$scope.eEmail, 'password':$scope.ePassword, 'service':$scope.eServiceId}
                        )
                        .then(function (response){
                            $scope.init();
                            angular.element('.modal-close').trigger('click');
                            $scope.ePassword = null;
                            $scope.eConfPassword = null;
                            M.toast({html: 'Successfully Updated!', classes: 'rounded green'});
                        });
                    }

                }
            }


        }

    }
    //fetch data to delete
    $scope.fetchData = function(id, username){
        $scope.dId = id;
        $scope.dOperatorName = username;
    }

    $scope.delOperator = function(){
        $http.post(
            'delOperator',
            {'id': $scope.dId}
        )
        .then(function(response){
            $scope.init();
            angular.element('.modal-close').trigger('click');
            M.toast({html: 'Successfully Deleted!', classes: 'rounded'});
        });

    }

    $scope.init();
    $scope.getService();

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

    //reload datatable
    $interval(function(){
        $scope.init();
    }, 10000);

    //reverse sort (arrow)
    $scope.sort_with = function(base) {
        $scope.base = base;
        $scope.reverse = !$scope.reverse;
    };



  });

</script>


 @endsection


