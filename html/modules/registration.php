<script>    
    app.controller('registrationCtrl', function($scope,$http){
        $scope.form = {};
        
        $scope.submit = function(event){
            $http({
                method: 'POST',
                url: '/registration/',
                data:$scope.form,
            }).then(function successCallback(response) {
                if(response.data.status == 'success'){
                    location.reload();
                }else if(response.data.status == 'error'){
                    $scope.firstname_error = response.data.messages.firstname;
                    $scope.lastname_error = response.data.messages.lastname;
                    $scope.email_error = response.data.messages.email;
                    $scope.password_error = response.data.messages.password;
                    $scope.conf_password_error = response.data.messages.conf_password;                    
                }
            });
            
            event.preventDefault();
        }
        
    });
</script>


<script>
    /*$('document').ready(function(){
        
        $('#registrationModal').submit(function(){
            var data = new Object();
            data.firstname = $('#registrationModal input[name=firstname]').val();
            data.lastname = $('#registrationModal input[name=lastname]').val();
            data.email = $('#registrationModal input[name=email]').val();
            data.password = $('#registrationModal input[name=password]').val();
            data.conf_password = $('#registrationModal input[name=conf_password]').val();
            console.log(data);
            $.ajax({
                url:'/registration/',
                type:"POST",
                data:data,
                success:function(msg){
                    var json = JSON.parse(msg);
                    
                    if(json.status == 'error'){
                        if(json.messages.firstname){
                            $('#registrationModal .firstname_error').text(json.messages.firstname);
                            $('#registrationModal .lastname_error').text(json.messages.lastname);
                            $('#registrationModal .email_error').text(json.messages.email);
                            $('#registrationModal .password_error').text(json.messages.password);
                            $('#registrationModal .conf_password_error').text(json.messages.conf_password);
                        }
                    }
                }
            });            
            return false;
        });
    });*/
</script>
<div id="registrationModal" class="modal fade" role="dialog" ng-controller="registrationCtrl">
    <div class="modal-dialog"  style="width:600px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Регистрация</h4>
            </div>
            <div class="modal-body">
                <form class="form" ng-submit="submit($event)">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4">Имя</div>

                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="firstname" ng-model="form.firstname">
                                <div class="error firstname_error">{{firstname_error}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4">Фамилия</div>

                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="lastname" ng-model="form.lastname">
                                <div class="error lastname_error">{{lastname_error}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4">Имейл</div>

                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="email" ng-model="form.email">
                                <div class="error email_error">{{email_error}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4">Пароль</div>

                            <div class="col-sm-8">
                                <input type="password" class="form-control" name="password" ng-model="form.password">
                                <div class="error password_error">{{password_error}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4">Повторить Пароль</div>

                            <div class="col-sm-8">
                                <input type="password" class="form-control" name="conf_password" ng-model="form.conf_password">
                                <div class="error conf_password_error">{{conf_password_error}}</div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-8">
                                <input type="submit" class="btn btn-primary" value="Зарегестрироватьь">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
