<?php $__env->startSection('content'); ?>
<div ng-app="myOperatorsApp" ng-controller="myOperatorsController">
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">

          <h1 class="m-0 text-dark"><i class="nav-icon fas fa-headphones"></i> Operators</h1>
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
        <button type="button" class="waves-effect waves-light btn-small"  data-toggle="modal" data-target="#modal-default">
        <i class="material-icons">add</i>Add Operator
        </button>
      </div>


      <!-- /.card-header -->
      <div class="card-body">
        <div class="row">
            <div class="col-sm-2">
                <label>PageSize:</label>
                <select ng-model="data_limit" class="form-control">
                    <option>10</option>
                    <option>20</option>
                    <option>50</option>
                    <option>100</option>
                </select>
            </div>

            <div class="col-sm-8 pull-right">
                <label>Search:</label>
                <input type="text" ng-model="search" ng-change="filter()" placeholder="Search" class="form-control" />
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
                            {{ row.user_status }}
                            </button>

                            <button class="btn-small green" ng-show="row.user_status == 'active'">
                            {{ row.user_status }}
                            </button>
                            </td>
                            <td>{{ row.username}}</td>
                            <td>{{ row.email }}</td>
                            <td>{{ row.service_name }}</td>
                            <td><span id="moment">{{row.created_at}}</span></td>
                            <td>
                                <button type="button" title="Edit" class="waves-effect waves-light btn-floating btn-small blue" id="" data-toggle="modal" data-target="#modal-edit" ng-click="fetchSingleData(row.id, row.username, row.email, row.password, row.service_id)">
                                    <i class="material-icons">edit</i>
                                </button>
                                <button type="button" title="Delete" class="waves-effect waves-light btn-floating btn-small red right" id="" data-toggle="modal" data-target="#modal-delete" ng-click="fetchData(row.id, row.username)">
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
            <p>Showing {{data.length}} of {{ entire_user}} entries</p>
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


      <!-- /.card-body -->
    </div>
    <!-- /.card -->

<!-- add operator modal -->
    <div class="modal fade" id="modal-default">
      <div class="modal-dialog" width="100%">
        <div class="modal-content">
          <div class="modal-header bg-danger">
            <h4 class="modal-title">Add New Operator</h4>
          </div>
          <form action="" method="POST">
          <div class="modal-body">
            <div class="form-group">
              <?php echo e(csrf_field()); ?>

                <div class="input-field col s6">
                    <input type="text" class="" name="oUsername" id="oUsername" ng-model="oUsername" required>
                    <label for="oUsername">Username</label>
                </div>
            </div>
            <div class="form-group">
                <div class="input-field col s6">
                    <input type="email" class="" name="oEmail" id="oEmail" ng-model="oEmail"  required>
                    <label for="oEmail">Email</label>
                </div>
            </div>
            <div class="form-group">
                <div class="input-field col s6">
                    <input type="password" class="" name="oPassword" id="oPassword" ng-model="oPassword" required>
                    <label for="oPassword">Password</label>
                </div>
            </div>
            <div class="form-group">
                <div class="input-field col s6">
                    <input type="password" class="" name="oConPass" id="oConPass" ng-model="oConPass"  required>
                    <label for="oConPass">Confirm Password</label>
                </div>
            </div>
            <div class="form-group">
                <div class="col s12">
                    <label>Service</label>
                    <select class="browser-default" ng-model='serviceId'>
                        <option value="" disabled selected><label>Select Service</label></option>
                        <option ng-repeat='rows in dataService' value="{{rows.id}}">{{rows.service_name}}</option>
                    </select>

                </div><br/>
                <button type="button" class="waves-effect waves-light btn-small blue left" data-toggle="modal" data-target="#Service">Service</button>
            </div>
          </div>
          <!-- ./modal-body -->
          <div class="modal-footer">
            <button type="button" class="waves-effect waves-light btn-small red left" data-dismiss="modal">Cancel</button>
            <button type="button" class="waves-effect waves-light btn-small green right" id='operatorAddBtn' name='operatorAddBtn' ng-click="insertOperator()" ng-disabled="OperatorSave" >Save</button>
          </div>
        </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.add items modal -->

    <div class="modal fade" id="modal-edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header btn-danger">
                    <h4 class="modal-title">Edit Operator</h4>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" ng-model="eId" class="form-control" />
                      <?php echo e(csrf_field()); ?>

                      <label>Username:</label>
                      <input type="text" name="eUsername" id="eUsername" placeholder="Username" ng-model="eUsername" required>
                    </div>
                    <div class="form-group">
                      <label>Email:</label>
                      <input type="email" name="eEmail" id="eEmail" placeholder="Email Address" ng-model="eEmail" required>

                    </div>
                    <div class="form-group">
                      <label>Password:</label>
                      <input type="password" name="ePassword" id="ePassword" placeholder="Password" ng-model="ePassword" required>
                    </div>
                    <div class="form-group">
                        <div class="col s12">
                            <label>Service</label>
                            <select class="browser-default" ng-model='eServiceId'>
                                <option value="" disabled selected><label>Select Service</label></option>
                                <option ng-repeat='rows in dataService' value="{{rows.id}}">{{rows.service_name}}</option>
                            </select>

                        </div><br/>
                        <button type="button" class="waves-effect waves-light btn-small blue left" data-toggle="modal" data-target="#Service">Service</button>
                    </div>
                </div>
                <!-- /.modal-body -->
                <div class="modal-footer">
                    <button type="button" class="waves-effect waves-light btn-small red left" data-dismiss="modal">Cancel</button>
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
          
           <?php echo e(csrf_field()); ?>

          <div class="modal-body">
          <input type="text" id="dCatID" name="dCatID" class="form-control" ng-model="dId" >
          <h6 style="text-align:center">Are you sure you want to delete operator <b ng-bind="dOperatorName"></b>?</h6>
          </div>
          <div class="modal-footer">
            <button type="button" class="waves-effect waves-light btn-small orange left" data-dismiss="modal">Cancel</button>
            <button type="button" class="waves-effect waves-light btn-small red right" id='categoryDelBtn' ng-click='delOperator()'>Delete</button>
          </div>
          <!-- </form> -->
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.delete item modal -->
  </div>

<!-- Service modal -->
<div class="modal fade" id="Service">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-danger">
            <h4 class="modal-title">Service</h4>
          </div>
          
           <?php echo e(csrf_field()); ?>

          <div class="modal-body">
            <div class="input-field col s6">
              <input type="text" class="" name="oService" id="oService" ng-model="oService" required>
              <label for="oService">Service </label>
            </div>
            <button type="button" class="waves-effect waves-light btn green right" id='categoryDelBtn' ng-click='insertService()'>Add</button>
          </div>
          <div class="modal-footer">
            <button type="button" class="waves-effect waves-light btn-small red left" data-dismiss="modal">Done</button>

          </div>
          <!-- </form> -->
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.Service modal -->




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
        $http.post(
            'insertOperator',
            {'username':$scope.oUsername, 'email':$scope.oEmail, 'password':$scope.oPassword, 'service': $scope.serviceId}
        ).then(function(response){
            $scope.OperatorSave = false;
            $('#modal-default').modal('hide');
            $('.modal-backdrop').remove();
            M.toast({html: 'Successfully Added!', classes: 'rounded'});
        });
    }

    //insert new service
    $scope.insertService = function(){
        $http.post(
            'insertService',
            {'serviceName':$scope.oService}
        )
        .then(function(response){
            $scope.getService();
            $('#Service').modal('hide');
            $('.modal-backdrop').remove();
            M.toast({html: 'Successfully Added!', classes: 'rounded'});
        })
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
            $scope.getService();
        });
    }

    $scope.getService = function(){
        $http.get('getOperatorService').then(function(response){
            $scope.dataService = response.data;
        })
    }



    //fetch data to edit
    $scope.fetchSingleData = function(id, username, email, password, service){
        $scope.eId = id;
        $scope.eUsername = username;
        $scope.eEmail = email;
        $scope.ePassword = password;
        $scope.eServiceId = service;
    }

    $scope.editOperator = function(){
        $http.post(
            'editOperator',
            {'id':$scope.eId, 'username':$scope.eUsername, 'email':$scope.eEmail, 'password':$scope.ePassword, 'service':$scope.eServiceId}
        )
        .then(function (response){
           $scope.init();
           $('#modal-edit').modal('hide');
            $('.modal-backdrop').remove();
            M.toast({html: 'Successfully Updated!', classes: 'rounded'});
        })
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
            $('#modal-delete').modal('hide');
            $('.modal-backdrop').remove();
            M.toast({html: 'Successfully Deleted!', classes: 'rounded'});
        });

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


 <?php $__env->stopSection(); ?>



<?php echo $__env->make('includes.admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Repository\LoopSystem\resources\views/pages/operators.blade.php ENDPATH**/ ?>