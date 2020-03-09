@extends('includes.admin_template')

@section('content')
<div ng-app="mySubsApp" ng-controller="mySubsController">
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">

          <h1 class="m-0 text-dark"><i class="nav-icon fas fa fa-user"></i> Subscribers</h1>
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
          <i class="fas fa-plus mr-2"></i>Add Subscriber
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
            </div> <br/>

            <div class="col-sm-6 pull-right">
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
                        <th width="25%">Name&nbsp;<a ng-click="sort_with('Username');"><i class="material-icons">swap_vert</i></a></th>
                        <th width="25%">Email&nbsp;<a ng-click="sort_with('Email');"><i class="material-icons">swap_vert</i></a></th>
                        <th width="20%">Date Created&nbsp;<a ng-click="sort_with('Date');" style="cursor:text-menu"><i class="material-icons">swap_vert</i></a></th>
                        <th width="15%">&nbsp;</th>

                    </thead>
                    <tbody ng-show="filter_data > 0">
                        <tr ng-repeat="row in data = (file | filter:search | orderBy : base :reverse) | beginning_data:(current_grid - 1)* data_limit | limitTo:data_limit">
                            <td>@{{ row.subscriber_status }}</td>
                            <td>@{{ row.subscriber_name}}</td>
                            <td>@{{ row.email }}</td>
                            <td>@{{row.created_at}}</td>
                            <td>
                                <button type="button" title="Edit" class="waves-effect waves-light btn-small blue" id="" data-toggle="modal" data-target="#modal-edit" ng-click="fetchSingleData(row.id, row.subscriber_name, row.username, row.email, row.password)">
                                    <i class="material-icons">edit</i>
                                </button>
                                <button type="button" title="Delete" class="waves-effect waves-light btn-small red right" id="" data-toggle="modal" data-target="#modal-delete" ng-click="fetchData(row.id, row.subscriber_name)">
                                    <i class="material-icons">delete</i>
                                </button>
                            </td>

                        </tr>
                    </tbody>
                    <tfoot ng-show="filter_data == 0">
                        <th></th>
                        <th></th>
                        <th>No records found..</th>
                        <th></th>
                        <th></th>
                    </tfoot>

                </table>
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

<!-- add items modal -->
    <div class="modal fade" id="modal-default">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-danger">
            <h4 class="modal-title">Add New Subscriber</h4>
          </div>
          <form action="" method="POST">
          <div class="modal-body">
            <div class="form-group">
              {{ csrf_field() }}
              <div class="input-field col s6">
                <input type="text" id="name" class="form-control" ng-model="name" required>
                <label for="name">Name</label>
              </div>
            </div>
            <div class="form-group">
                <div class="input-field col s6">
                    <input type="text" id="username" class="form-control" ng-model="username" required>
                    <label for="username">Username</label>
                </div>
            </div>
            <div class="form-group">
                <div class="input-field col s6">
                    <input type="email" id="email" class="form-control" ng-model="email" required>
                    <label for="email">Email</label>
                </div>
            </div>
            <div class="form-group">
                <div class="input-field col s6">
                    <input type="text" id="password" class="form-control" ng-model="password" required>
                    <label for="password">Password</label>
                </div>
            </div>
            <div class="form-group">
                <div class="input-field col s6">
                    <input type="text" id="confPassword" class="form-control" ng-model="confPassword"  required>
                    <label for="confPassword">Confirm Password</label>
                </div>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-success" name="submit" id='categoryAddBtn' ng-click="insertSubscriber()">Save changes</button>
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
            <h4 class="modal-title">Edit Subscriber</h4>
          </div>
          <form action="" method="POST">
              {{ csrf_field() }}
              {{method_field('PATCH')}}
          <div class="modal-body">
              <input type="hidden" class="form-control" ng-model="eId" value=""  required>
              <div class="form-group">
              <label>Name:</label>
              <input type="text" class="form-control"  ng-model="eName" placeholder="Name" required>
            </div>
            <div class="form-group">
              <label>Username:</label>
              <input type="text" class="form-control"  ng-model="eUsername" placeholder="Username" required>
            </div>
            <div class="form-group">
              <label>Email:</label>
              <input type="email" class="form-control"  ng-model="eEmail" placeholder="Email" required>
            </div>
            <div class="form-group">
              <label>Password:</label>
              <input type="text" class="form-control"  ng-model="ePassword" placeholder="Password" required>
            </div>

            <div class="form-group">
              <label>Confirm Password:</label>
              <input type="text" class="form-control"  ng-model="eConfPassword" placeholder="Confirm Password" required>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-success" id="categoryEditBtn" ng-click="editSubscriber()">Save changes</button>
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
            <h4 class="modal-title">Delete Subscriber</h4>
          </div>
          {{-- <!-- <form action="{{route('catSoftDelete')}}" method="POST"> --> --}}
           {{ csrf_field() }}
          <div class="modal-body">
          <input type="hidden" ng-model="dId" class="form-control">
          <h6 style="text-align:center">Are you sure you want to delete subscriber <b ng-bind="dSubscriberName"></b>?</h6>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-danger" id='categoryDelBtn' ng-click='delSubscriber()'>Delete</button>
          </div>
          <!-- </form> -->
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.delete item modal -->

</div>
<!-- subsapp subscontroller -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.2.12/angular.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.10.0/ui-bootstrap-tpls.min.js"></script>
<script>
    var subsApp = angular.module('mySubsApp', ['ui.bootstrap']);

    subsApp.filter('beginning_data', function(){
      return function(input, begin){
          if(input){
              begin = +begin;
              return input.slice(begin);
          }
          return [];
      }
    });

    subsApp.controller("mySubsController", function($scope, $http, $timeout){
        // insert subscriber
        $scope.insertSubscriber = function(){
        $http.post(
            'insertSubscriber',
            {'name':$scope.name,'username':$scope.username, 'email':$scope.email, 'password':$scope.password}
        ).then(function(response){
            $scope.init();
            $('#modal-default').modal('hide');
            $('.modal-backdrop').remove();
            M.toast({html: 'Successfully Added!', classes: 'rounded'});
        })
    }

        // display data
        $scope.init = function(){
            $http.get('getSubscribers').then(function(response){
                $scope.data = response.data;
                $scope.file = response.data;
                $scope.current_grid =1;
                $scope.data_limit = 10;
                $scope.filter_data = $scope.data.length;
                $scope.entire_user =  $scope.file.length;
            });
        }

         //fetch data to edit
        $scope.fetchSingleData = function(id, name, username, email, password){
            $scope.eId = id;
            $scope.eUsername = username;
            $scope.eName = name;
            $scope.eEmail = email;
            $scope.ePassword = password;

        }

          //edit a service
        $scope.editSubscriber = function(){
            $http.post(
                'editSubscriber',
                {'id':$scope.eId,'name':$scope.eName,'username':$scope.eUsername, 'email':$scope.eEmail, 'password':$scope.ePassword}
            ).then(function(data){
                $scope.init();
                $('#modal-edit').modal('hide');
                $('.modal-backdrop').remove();
                M.toast({html: 'Successfully Updated!', classes: 'rounded'});
            })
        };

        //fetch data to delete
        $scope.fetchData = function(id, name){
            $scope.dId = id;
            $scope.dSubscriberName = name;
        }

        //delete a subscriber
        $scope.delSubscriber = function(){
            $http.post(
                'delSubscriber',
                {'id':$scope.dId}
            ).then(function(response){
                $scope.init();
                $('#modal-delete').modal('hide');
                $('.modal-backdrop').remove();
                M.toast({html: 'Successfully Deleted!', classes: 'rounded'});
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
</script>
 @endsection


