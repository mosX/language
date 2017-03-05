<script>
    $('document').ready(function(){
        $('#loginModal form').submit(function(){
            $.ajax({
                url:'/login/',
                type:'POST',
                data:{email:$('#loginModal input[name=email]').val(),password:$('#loginModal input[name=password]').val()},
                success:function(msg){
                    var json = JSON.parse(msg);
                    if(json.status == 'success'){
                        location.href = location.href;
                    }
                }
            });
            
            return false;
        });
    });
</script>
<div id="loginModal" class="modal fade" role="dialog">
    <div class="modal-dialog"  style="width:400px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Авторизация</h4>
            </div>
            <div class="modal-body">
                <form class="form">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4">Email</div>

                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="email">
                                <div class="error email_error"></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4">Password</div>

                            <div class="col-sm-8">
                                <input type="password" class="form-control" name="password">
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