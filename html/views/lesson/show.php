<script>
        app.controller('lessonCtrl', function($scope,$http){        
        $scope.form = {};
        
        $scope.listen = function(event){            
            $http({
                url: '/lesson/question/',
                method: 'POST',
                data:{session:$scope.session,lesson:$scope.lesson}
                //url: location.href,
                
            }).then(function successCallback(res) {
                console.log(res.data);
            });
            
            event.preventDefault();
        }
        
        $scope.answer = function(event){
            var item = $(event.target).attr('data-id');
            $http({
                url: '/lesson/answer/',
                method: 'POST',
                data:{session:$scope.session,lesson:$scope.lesson,item:item},                
            }).then(function successCallback(res) {
                console.log(res.data);
            });
            
            event.preventDefault();
        }
    });
</script>

<div class="container" ng-controller="lessonCtrl">
    <div class="attempts">До завершения<span></span></div>
    <div class="errors">У вас осталось попыток<span></span></div>
    
    <input type="hidden" name="session" value="<?=$this->m->_path[3]?>" ng-init="session = '<?=$this->m->_path[3]?>'">
    <input type="hidden" name="lesson" value="<?=$this->m->_path[2]?>" ng-init="lesson = <?=$this->m->_path[2]?>">
    
    <input type="hidden" name="item" value="" ng-init="item = <?=$this->m->answer->element ? $this->m->answer->element:0?>">
    <input type="hidden" name="item_id" value="" ng-init="item_id = <?=$this->m->answer->id?$this->m->answer->item:0?>">
    
    <div class="form-control answer_list">
        <?php foreach($this->m->data as $item){ ?>
            <a ng-click="answer($event)" class="item" data-id="<?=$item->id?>" href=""><?=$item->element?></a>
        <?php } ?>
    </div>
    
    <div class="form-control">
        <?php if($this->m->answer){ ?>
            <a ng-click="listen($event)" href="">Повторить</a>
        <?php }else{ ?>
            <a ng-click="listen($event)" href="">Прослушать</a>
        <?php } ?>
    </div>
</div>

