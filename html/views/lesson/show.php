<script>
    console.log('test2');
    app.controller('lessonCtrl', function($scope,$http){        
        $scope.form = {};
        
        $scope.listen = function(event){
            console.log('test');
            $http({
                method: 'POST',
                url: location.href,
            }).then(function successCallback(res) {
                console.log(res.data);
            });
            
            event.preventDefault();
        }
    });
</script>
<div class="container" ng-controller="lessonCtrl">
    <div class="form-control">
        <?php foreach($this->m->data as $item){ ?>
            <a data-id="<?=$item->id?>" href=""><?=$item->element?></a>
        <?php } ?>
    </div>
    
    <div class="form-control">
        <a ng-click="listen($event)" href="">Прослушать</a>
    </div>
</div>