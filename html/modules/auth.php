<script>    
    app.controller('authCtrl', function($scope,$http){        
        $scope.form = {};
        
        $scope.submit = function(event){
            $http({
                method: 'POST',
                url: '/login/',
                data:$scope.form,
            }).then(function successCallback(response) {
                if(response.data.status == 'success'){
                    location.reload();
                }else{
                    
                }
            });
            
            event.preventDefault();
        }
        
    });
</script>

<div id="loginModal" class="modal fade" role="dialog" ng-controller="authCtrl">
    <div class="modal-dialog"  style="width:400px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Авторизация</h4>
            </div>
            <div class="modal-body">
                <form class="form" ng-submit="submit($event)">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4">Email</div>

                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="email" ng-model="form.email">
                                <div class="error email_error"></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4">Password</div>

                            <div class="col-sm-8">
                                <input type="password" class="form-control" name="password" ng-model="form.password">
                                <div class="error"></div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-8">
                                <input type="submit" class="btn btn-primary" value="Войти">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>