
<script>
    $('document').ready(function(){
        
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
    });
</script>
<div id="registrationModal" class="modal fade" role="dialog">
    <div class="modal-dialog"  style="width:600px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Регистрация</h4>
            </div>
            <div class="modal-body">
                <form class="form">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4">Имя</div>

                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="firstname">
                                <div class="error firstname_error"></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4">Фамилия</div>

                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="lastname">
                                <div class="error lastname_error"></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4">Имейл</div>

                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="email">
                                <div class="error email_error"></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4">Пароль</div>

                            <div class="col-sm-8">
                                <input type="password" class="form-control" name="password">
                                <div class="error password_error"></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4">Повторить Пароль</div>

                            <div class="col-sm-8">
                                <input type="password" class="form-control" name="conf_password">
                                <div class="error conf_password_error"></div>
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
