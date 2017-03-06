<script>
    var game,player;
    var workplace,top_menu;
    //var places= new Array();
    var current_dragged_place;
    var data = JSON.parse('<?=$this->m->json?>');
    
    var zone_group;
    var places_group;
    
    var active_zone = false;
    var draw_zone_action = false;
    var zone_start_x,zone_start_y;
    var current_zone;
    var zone_graphic;
    var zone_sprite;
    
    $("document").ready(function(){
        game = new Phaser.Game(800, 600, Phaser.AUTO, 'game', { preload: preload , create: create , update: update, render: render  });
        
        function preload(){
            game.load.image('ball', '/html/images/canvas/ball.png');
            game.load.image('zone', '/html/images/canvas/zone.png');
        }
        
        function create(){
            game.stage.backgroundColor = "#4488AA";
            
            initTopMenu();                        
            initWorkPlace();
            
            //СОздаем группы для имитации z-index
            zone_group = game.add.group();
            places_group = game.add.group();
            
            for(var key in data){
                if(data[key].type == 1){
                    createPlace(data[key]);
                }else if(data[key].type == 2){
                    console.log("ZONE");
                    createZone(data[key]);
                }
            }
            
            createPlace();            
            createZoneBtn();
            
            /*var group = game.add.group();
            group.x = 100;
            group.y = 100;*/
        
            /*place = game.add.sprite(100, 100, 'ball');
            place.width = 40;
            place.height = 40;
            place.inputEnabled = true;
            place.input.enableDrag(true);
            
            //var style = { font: "32px Arial", fill: "#ff0044", wordWrap: true, wordWrapWidth: sprite.width, align: "center", backgroundColor: "#ffff00" };
            var style = { font: "10px Arial", fill: "#000000"};
            var text = game.add.text(0, 0, "- text on a sprite -\ndrag me", style);
            text.anchor.set(0.5);
            place.addChild(text);*/
            //group.add(place);
            //group.add(text);
        }
        
        function createZoneBtn(){
            var zone = game.add.sprite(100, 5, 'zone');;
            
            zone.inputEnabled = true;
            zone.events.onInputUp.add(function(){
                console.log('zone click');
                active_zone = active_zone == true? false:true;
                //active_zone = true;
            }, this);
            
            zone.events.onInputOver.add(function(){
                $("*").css({"cursor":"pointer"});
            }, this);
            
            zone.events.onInputOut.add(function(){                
                $("*").css({"cursor":"default"});
            }, this);
        }
        
        function createZone(item){
            var sprite = game.add.sprite(item.pos_x*50,item.pos_y*50);
            
            sprite.inputEnabled = true;
            sprite.id = item.id;
            
            sprite.events.onInputUp.add(function(sprite){
                //sprite.text_element.setText("updated");
                
                $('#zoneModal').modal('show');  
                $('#zoneModal input[name=id]').val(item.id);
                $('#zoneModal input[name=label]').val(item.label);
            });
            sprite.events.onInputOver.add(function(sprite){
               $("*").css({"cursor":"pointer"}); 
            });
            sprite.events.onInputOut.add(function(sprite){
               $("*").css({"cursor":"default"}); 
            });
            
            var style = { font: "12px Arial", fill: "#000000"};
            var text = game.add.text(0, 0, item.label, style);
            
            text.x = (item.width*50)/2;
            text.y = 15;
            
            text.anchor.set(0.5);
            sprite.addChild(text);
            sprite.text_element = text;

            zone_group.add(sprite);

            var graphic = game.add.graphics(0, 0);
            //zone_group.add(current_zone);
            sprite.addChild(graphic);
            graphic.lineStyle(1, 0xFF0000, 0.8);
            graphic.beginFill(0xff0000, 0);

            graphic.drawRect(0,0, item.width*50, item.height*50);
        }
        
        function addNewZone(){
            //console.log('DRAW ZONE');
            draw_zone_action = true;
            zone_start_x = game.input.mousePointer.x;
            zone_start_y = game.input.mousePointer.y;

            //создаем спрайт что бы на него навешать события. так как на графику нельзя
            zone_sprite = game.add.sprite(0,0);
            zone_sprite.inputEnabled = true;
            zone_sprite.events.onInputUp.add(function(sprite){
                sprite.text_element.setText("updated");
            });
            zone_sprite.events.onInputOver.add(function(sprite){
               $("*").css({"cursor":"pointer"}); 
            });
            zone_sprite.events.onInputOut.add(function(sprite){
               $("*").css({"cursor":"default"}); 
            });
            var style = { font: "10px Arial", fill: "#000000"};
            var text = game.add.text(0, 0, 'text', style);                    
            text.anchor.set(0.5);
            zone_sprite.addChild(text);
            zone_sprite.text_element = text;

            zone_group.add(zone_sprite);

            current_zone = game.add.graphics(0, 0);
            zone_group.add(current_zone);
            current_zone.lineStyle(1, 0xFF0000, 0.8);

            current_zone.drawRect(0,0, 40, 40);
        }
        
        function initWorkPlace(){
            game.input.moveCallback  = function(){
                console.log('move');
            }
            
            workplace = game.add.graphics(0, 0);            
            workplace.beginFill(0xff8899, 1);
            workplace.inputEnabled = true;    
            workplace.drawRect(0, 50, game.width, game.height-50);
            
            workplace.events.onInputDown.add(function(){
                if(active_zone == true){
                    addNewZone();
                    
                }
            }, this);
        }
        
        function initTopMenu(){
            top_menu = game.add.graphics(0, 0);
            top_menu.lineStyle(2, 0x0000FF, 0);
            top_menu.beginFill(0xFF700B, 1);            
            top_menu.drawRect(0, 0, game.width, 50);
            top_menu.inputEnabled = true;
        }
        
        function updateCurrentZone(){
            current_zone.clear();
                
            current_zone = game.add.graphics(0, 0);
            current_zone.lineStyle(1, 0xFF0000, 0.8);
            current_zone.beginFill(0xff0000, 0);

            var diff_x = game.input.mousePointer.x - zone_start_x;
            var diff_y = game.input.mousePointer.y - zone_start_y;
            
            if(diff_x < 0){
                zone_sprite.x = zone_start_x + diff_x;
            }else{
                zone_sprite.x = zone_start_x    ;
            }
            
            if(diff_y < 0){
                zone_sprite.y = zone_start_y + diff_y;
            }else{
                zone_sprite.y = zone_start_y;
            }
            
            
            current_zone.drawRect(0,0, Math.abs(diff_x), Math.abs(diff_y));

            zone_sprite.addChild(current_zone);                                
        }
        
        
        
        function saveCurrentZone(){
            console.log('SaveCurrentZone');
/*            
            console.log(zone_sprite.x,current_zone.width);
            console.log(zone_start_x,zone_start_y);*/
            
            var x = zone_sprite.x/50;
            var y = zone_sprite.y/50;
            var width = current_zone.width/50;
            var height = current_zone.height/50;
            
            //console.log(width);
            
            //определим правильные координаты
            if(width < 0){
                x = x - width;
                width = Math.abs(width);
            }
            
            if(height < 0){
                y = y - height;
                height = Math.abs(height);
            }
            
            $.ajax({
                url:'/canvas/add_zone/',
                type:'POST',
                data:{pos_x:x,pos_y:y,width:width,height:height},
                success:function(msg){
                    console.log(msg);
                }
            });
        }
        
        function update(){            
            if(game.input.mousePointer.isUp && draw_zone_action == true){
                draw_zone_action = false;
                
                saveCurrentZone();
            }
            
            if(draw_zone_action == true){
                updateCurrentZone();                
            }
        }
        function render(){
            
        }
        
        function createPlace(item){
            var x,y;
            
            if(item){                
                x = item.pos_x*50;
                y = item.pos_y*50;
            }else{
                x = 50;
                y = 7;
            }
            
            place = game.add.sprite(x, y, 'ball');
            
                //console.log('!!!!');
                //console.log(places_group);
                //places_group.add(place);
            
            //places.push(place);
            //place.tint = Math.random() * 0xffffff;
            
            place.width = 40;
            place.height = 40;
            //place.index = places.length-1;
            console.log(item);
            if(item){
                place.id = item.id;
                place.pos_x = item.pos_x;
                place.pos_y = item.pos_y;
                place.label = item.label;
                
                var style = { font: "10px Arial", fill: "#000000"};
                var text = game.add.text(0, 0, item.label, style);
                text.anchor.set(0.5);
                place.addChild(text);
            }
            
            place.inputEnabled = true;
            place.input.enableDrag(true);
            
            place.events.onDragStart.add(function(){
                current_dragged_place = place;
                
                createPlace();
                console.log('drag start');
            });
            
            place.events.onDragStop.add(function(sprite,pointer){
                if(sprite.overlap(top_menu)){
                    sprite.destroy();
                    sprite = undefined;  //обнуляем                
                }
                console.log('drag stop');
                    
                sprite.x = (Math.floor( (sprite.x + 25) / 50)*50 );                
                sprite.y = (Math.floor( (sprite.y + 25) / 50)*50 );                                
                
                var pos_x = sprite.x/50;
                var pos_y = sprite.y/50;
                
                if(sprite.id != undefined){ //update
                    if(sprite.pos_x == pos_x && sprite.pos_y == pos_y){                                                        
                            $('#popupModal input[name=label]').val(sprite.label);
                            $('#popupModal input[name=id]').val(sprite.id);
                            $('#popupModal').modal('show');
                            
                    }else{                    
                        $.ajax({
                            url:'/canvas/update_place/',
                            type:'POST',
                            data:{pos_x:pos_x,pos_y:pos_y,id:sprite.id},
                            success:function(msg){
                                console.log(msg);
                            }
                        });
                    }
                }else{  //insert
                    $.ajax({
                        url:'/canvas/add_place/',
                        type:'POST',
                        data:{pos_x:sprite.x/50,pos_y:sprite.y/50},
                        success:function(msg){
                            console.log(msg);
                        }
                    });
                }
            });
                        
            place.events.onInputUp.add(function(){
                //current_dragged_place.destroy();
                //current_dragged_place = undefined;  //обнуляем                
            }, this);
            
            
            place.events.onInputOver.add(function(){
                $("*").css({"cursor":"pointer"});
            }, this);
            
            place.events.onInputOut.add(function(){                
                $("*").css({"cursor":"default"});
            }, this);
        }
        
        $('#zoneModal form').submit(function(){
            var id = $('input[name=id]',this).val();
            var label = $('input[name=label]',this).val();
            
            $.ajax({
                url:'/canvas/edit_zone/',
                type:'POST',
                data:{id:id,label:label},
                success:function(msg){
                    console.log(msg);
                }
            });
            return false;
        });
        
        $('#popupModal form').submit(function(){
            var id = $('input[name=id]',this).val();
            var label = $('input[name=label]',this).val();
            
            $.ajax({
                url:'/canvas/update_place_label/',
                type:'POST',
                data:{id:id,label:label},
                success:function(msg){
                    console.log(msg);
                }
            });
            return false;
        });
    });
</script>

<div class="modal fade" id="popupModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title font-header"><p><strong>Редактировать Место</strong></p></h4>
            </div>

            <div class="modal-body">
                <form action="" method="POST">
                    <div class="form-group">
                        <div class="row">                                
                            <div class="col-sm-12">
                                <input type="text" class="form-control" placeholder="Label" name='label'>
                                <input type="hidden" name='id'>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group" style="border-bottom: 1px solid #2c3039; padding-bottom:30px;">
                        <div class="row">
                            <div class="col-sm-6">
                                <input type="submit" class="btn btn-transparent-small pull-right" value="Сохранить">
                            </div>
                        </div>
                    </div>                    
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="zoneModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title font-header"><p><strong>Редактировать Зону</strong></p></h4>
            </div>

            <div class="modal-body">
                <form action="" method="POST">
                    <div class="form-group">
                        <div class="row">                                
                            <div class="col-sm-12">
                                <input type="text" class="form-control" placeholder="Label" name='label'>
                                <input type="hidden" name='id'>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">                                
                            <div class="col-sm-12">
                                <input type="text" class="form-control" placeholder="Цвет" name='color'>
                                <input type="hidden" name='id'>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group" style="border-bottom: 1px solid #2c3039; padding-bottom:30px;">
                        <div class="row">
                            <div class="col-sm-6">
                                <input type="submit" class="btn btn-transparent-small pull-right" value="Сохранить">
                            </div>
                        </div>
                    </div>                    
                </form>
            </div>
        </div>
    </div>
</div>

<div id="game">
</div>