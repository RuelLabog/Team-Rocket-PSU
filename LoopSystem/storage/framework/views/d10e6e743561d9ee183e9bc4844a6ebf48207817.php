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
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
          <i class="fas fa-plus mr-2"></i>Add Operator
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
                        <th width="25%">Username&nbsp;<a ng-click="sort_with('Username');"><i class="material-icons">swap_vert</i></a></th>
                        <th width="25%">Email&nbsp;<a ng-click="sort_with('Email');"><i class="material-icons">swap_vert</i></a></th>
                        <th width="20%">Date Created&nbsp;<a ng-click="sort_with('Date');" style="cursor:text-menu"><i class="material-icons">swap_vert</i></a></th>
                        <th width="15%">&nbsp;</th>

                    </thead>
                    <tbody ng-show="filter_data > 0">
                        <tr ng-repeat="row in data = (file | filter:search | orderBy : base :reverse) | beginning_data:(current_grid - 1)* data_limit | limitTo:data_limit">
                            <td>{{ row.user_status }}</td>
                            <td>{{ row.username}}</td>
                            <td>{{ row.email }}</td>
                            <td>{{row.created_at}}</td>
                            <td>
                                <button type="button" title="Edit" class="waves-effect waves-light btn-small blue" id="" data-toggle="modal" data-target="#modal-edit" ng-click="fetchSingleData(row.id, row.username, row.email, row.password)">
                                    <i class="material-icons">edit</i>
                                </button>
                                <button type="button" title="Delete" class="waves-effect waves-light btn-small red right" id="" data-toggle="modal" data-target="#modal-delete" ng-click="fetchData(row.id, row.username)">
                                <i class="material-icons">delete</i>
                                </button>
                            </td>

                        </tr>
                    </tbody>
                    <tfoot ng-show="filter_data == 0">
                        <th>No records found..</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tfoot>

                </table>
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
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-danger">
            <h4 class="modal-title">Add New Operator</h4>
          </div>
          <form action="" method="POST">
          <div class="modal-body">
            <div class="form-group">
              <?php echo e(csrf_field()); ?>

              <label>Username:</label>
              <input type="text" class="" name="oUsername" id="oUsername" ng-model="oUsername" placeholder="Username" required>
            </div>
            <div class="form-group">
              <label>Email:</label>
              <input type="email" class="" name="oEmail" id="oEmail" ng-model="oEmail" placeholder="Email Address" required>

            </div>
            <div class="form-group">
              <label>Password:</label>
              <input type="password" class="" name="oPassword" id="oPassword" ng-model="oPassword" placeholder="Password" required>
            </div>
            <div class="form-group">
              <label>Confirm Password:</label>
              <input type="password" class="" name="oConPass" id="oConPass" ng-model="oConPass" placeholder="Confirm Password" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-success" id='operatorAddBtn' name='operatorAddBtn' ng-click="insertOperator()">Save changes</button>
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
                      <input type="text" name="catName" id="catName" placeholder="Username" ng-model="eUsername" required>
                    </div>
                    <div class="form-group">
                      <label>Email:</label>
                      <input type="email" name="catName" id="catName" placeholder="Email Address" ng-model="eEmail" required>

                    </div>
                    <div class="form-group">
                      <label>Password:</label>
                      <input type="password" name="catName" id="catName" placeholder="Password" ng-model="ePassword" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success" id="categoryEditBtn" ng-click="editOperator()">Save changes</button>
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
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-danger" id='categoryDelBtn' ng-click='delOperator()'>Delete</button>
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
 <!-- <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.9/angular.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.2.12/angular.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.10.0/ui-bootstrap-tpls.min.js"></script>
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


  operatorApp.controller("myOperatorsController", function($scope, $http, $timeout){
    //insert operator
    $scope.insertOperator = function(){
        $http.post(
            'insertOperator',
            {'username':$scope.oUsername, 'email':$scope.oEmail, 'password':$scope.oPassword}
        ).then(function(response){
            $scope.init();

        })
    }

    //display operator data
    $scope.init = function(){
        $http.get('getOperators').then(function(response){
            $scope.data = response.data;
            $scope.file = response.data;
            $scope.current_grid =1;
            $scope.data_limit = 10;
            $scope.filter_data = $scope.data.length;
            $scope.entire_user =  $scope.file.length;

        });
    }

    //fetch data to edit
    $scope.fetchSingleData = function(id, username, email, password){
        $scope.eId = id;
        $scope.eUsername = username;
        $scope.eEmail = email;
        $scope.ePassword = password;

    }

    //fetch data to delete
    $scope.fetchData = function(id, username){
        $scope.dId = id;
        $scope.dOperatorName = username;
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
</script>


 <?php $__env->stopSection(); ?>



<?php echo $__env->make('includes.admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Repository\LoopSystem\resources\views/pages/operators.blade.php ENDPATH**/ ?>