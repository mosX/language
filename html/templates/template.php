<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta charset="utf-8" />
        <?= $this->css() ?>
        <?= $this->js() ?>
        <?= $this->header() ?>
    </head>
    <body ng-app="app">
        <script>
            var app = angular.module("app",[]);
        </script>
        
        <?=$this->module('header')?>
        <?=$this->module('auth')?>
        <?=$this->module('registration')?>
        <?=$this->maincontent?>
    </body>
</html>