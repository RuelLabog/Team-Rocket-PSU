<?php $__env->startSection('content'); ?>
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
        <a class="waves-effect waves-light btn modal-trigger" href="#modal-default"><i class="material-icons">add</i>Add Persona</a>
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
                        <th width="15%">Inactive/Active&nbsp;<a ng-click="sort_with('Status');"><i class="material-icons">swap_vert</i></a></th>
                        <th width="25%">Name&nbsp;<a ng-click="sort_with('Name');"><i class="material-icons">swap_vert</i></a></th>
                        <th width="25%">Service</th>
                        <th width="25%">Date Created&nbsp;<a ng-click="sort_with('Date');" style="cursor:text-menu"><i class="material-icons">swap_vert</i></a></th>
                        <th width="10%">&nbsp;</th>

                    </thead>
                    <tbody ng-show="filter_data > 0">
                        <tr ng-repeat="row in data = (file | filter:search | orderBy : base :reverse) | beginning_data:(current_grid - 1)* data_limit | limitTo:data_limit">
                            <td ng-if="row.persona_status == 'inactive'">

                                <div class="switch">
                                    <label>
                                      Inactive
                                      <input disabled type="checkbox">
                                      <span class="lever"></span>
                                      Active
                                    </label>
                                  </div>
                            </td>
                            <td ng-if="row.persona_status == 'active'">

                                <div class="switch">
                                    <label>
                                      Inactive
                                      <input disabled type="checkbox" checked>
                                      <span class="lever"></span>
                                      Active
                                    </label>
                                  </div>
                            </td>
                            <td>{{ row.persona_name}}</td>
                            <td>{{ row.service_name}}</td>
                            <td>{{row.created_at}}</td>
                            <td>
                                <a title="Edit" class="waves-effect waves-light btn-small btn-floating modal-trigger" href="#modal-edit" ng-click="fetchSingleData(row.id, row.persona_name, row.service_id)">
                                    <i class="material-icons">edit</i>
                                </a>
                                <a title="Delete" class="waves-effect waves-light btn-small btn-floating red right modal-trigger" href="#modal-delete" ng-click="fetchDel(row.id, row.persona_name)">
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
                previous-text="&laquo;" next-text="&raquo;" style="cursor:context-menu">
            </pagination>
        </div>
    </div>


      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->

<!-- add items modal -->
 <!-- Modal Structure -->
 <div id="modal-default" class="modal">

    <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add New Persona</h4>
        </div>
        <form action="" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <?php echo e(csrf_field()); ?>


            <div class="input-field col s6">
              <input type="text" name="personaName" id="personaName" ng-model="personaName" class="validate" required>
              <label for="personaName">Persona Name</label>

              <div class="input-field col s12">
                  <select class="browser-default" ng-model="serviceID">
                      <option value="" disabled selected>Choose a Service</option>
                      <option value="{{ row.id }}" ng-repeat="row in data2">{{ row.service_name }}</option>
                  </select>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="waves-effect waves-light btn-small red left modal-close">Cancel</button>
          <button type="button" class="waves-effect waves-light btn-small green right" ng-click="insertPersona()">Save</button>
        </div>
      </form>
      </div>

  </div>
    <!-- /.add items modal -->


     <!-- edit item modal -->
     <div id="modal-edit" class="modal">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Edit Persona</h4>
          </div>
          <form action="" method="POST">
              <?php echo e(csrf_field()); ?>

              <?php echo e(method_field('PATCH')); ?>

          <div class="modal-body" >
            <div class="input-field col s6">
                <input type="hidden" class="form-control" ng-model="id" required>
                    <input placeholder="Placeholder" id="first_name" ng-model="editPersonaName" type="text" class="validate">
                    <label for="personaName">Persona Name</label>


                <div class="input-field col s12">
                    <select class="browser-default" ng-model="editServiceID">
                        <option value="" disabled selected>Choose a Service</option>
                        <option  ng-repeat="rows in data2" value="{{rows.id}}">{{ rows.service_name }}</option>

                    </select>
                </div>

              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="waves-effect waves-light btn-small red left modal-close">Cancel</button>
            <button type="button" class="waves-effect waves-light btn-small green right" ng-click="editPersona()">Save changes</button>
          </div>
          </form>
        </div>
        <!-- /.modal-content -->

    </div>
    <!-- /.edit item modal -->

          <!-- delete categories modal -->
          <div class="modal" id="modal-delete">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Delete Persona</h4>
                </div>
                 <?php echo e(csrf_field()); ?>

                <div class="modal-body">
                <input type="hidden" ng-model="dPersonaId" class="form-control">
                <h6 style="text-align:center">Are you sure you want to delete persona <b ng-bind='dPersonaName'></b>?</h6>
                </div>
                <div class="modal-footer">
                  <button type="button" class="waves-effect waves-light btn-small orange left modal-close">Cancel</button>
                  <button type="button" class="waves-effect waves-light btn-small red right" id='categoryDelBtn' ng-click='delPersona()'>Delete</button>
                </div>
                <!-- </form> -->
              </div>
              <!-- /.modal-content -->
          </div>
    <!-- /.delete item modal -->

    </div>

<!-- Angular js -->
<!-- angular -->
<script src ="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment-with-locales.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.9/angular.min.js"></script> -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.2.12/angular.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.10.0/ui-bootstrap-tpls.min.js"></script>

  <script>


  var personaApp = angular.module("myPersonaApp", ['ui.bootstrap']);

  personaApp.filter('beginning_data', function(){
      return function(input, begin){
          if(input){
              begin = +begin;
              return input.slice(begin);
          }
          return [];
      }
  });

  personaApp.controller("myPersonaController", function($scope, $http, $timeout){
      //insert new Persona
      $scope.insertPersona = function(){
        $http.post(
            "insertPersona",
            {'personaName':$scope.personaName, 'service':$scope.serviceID}
        ).then(function(){
            $scope.init();
            angular.elemet('.modal-close').trigger('click');
            M.toast({html: 'Successfully Added!', classes: 'rounded'});
        })
    }

    //display persona
    $scope.init= function(){
        $http.get('getPersona').then(function(response){
        $scope.data = response.data;
        $scope.file = response.data;
        $scope.current_grid =1;
        $scope.data_limit = 10;
        $scope.filter_data = $scope.data.length;
        $scope.entire_user =  $scope.file.length;
        $scope.init2();
    });
    }

    $scope.init2= function(){
        $http.get('getSubscriberService').then(function(response){
        $scope.data2 = response.data;
    });
    }


    // fetch data to edit
    $scope.fetchSingleData = function(id, name, service){
        $scope.editPersonaName = name;
        $scope.id = id;
        $scope.editServiceID = service;
    };

    //edit a Persona
    $scope.editPersona = function(){
        $http.post(
            'editPersona',
            {'personaName':$scope.editPersonaName, 'id':$scope.id, 'service':$scope.editServiceID}
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
        $scope.dPersonaName = name;
    }

    //delete a Persona
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

    // $scope.init3();


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

 <?php $__env->stopSection(); ?>



<?php echo $__env->make('includes.admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Repository\LoopSystem\resources\views/pages/personas.blade.php ENDPATH**/ ?>