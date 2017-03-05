<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta charset="utf-8" />
        <?= $this->css() ?>
        <?= $this->js() ?>
        <?= $this->header() ?>
    </head>
    <body>
        <?=$this->module('header')?>
        <?=$this->module('auth')?>
        <?=$this->module('registration')?>
        <?=$this->maincontent?>
    </body>
</html>