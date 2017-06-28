<?php defined('SYSPATH') or die('No direct script access.');?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Мой бюджет</title>

    <?=Html::style('media/bootstrap/css/bootstrap.min.css')?>
    <?=Html::style('media/css/sticky-footer-navbar.css')?>
    <?=Html::style('media/css/ladda-themeless.min.css')?>

    <?=Html::script('media/js/jquery.js')?>
    <?=Html::script('media/js/login.js')?>
    <?=Html::script('media/js/spin.min.js')?>
    <?=Html::script('media/js/ladda.min.js')?>
    <?=Html::script('media/bootstrap/js/bootstrap.min.js')?>

    <link rel="apple-touch-icon" href="media/img/cash.png">
    <link rel="icon" href="media/img/cash.ico">
</head>

<body>
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Мой бюджет</a>
        </div>
        <div class="collapse navbar-collapse">
            <?=$menu?>
        </div>
    </div>
</div>

<div class="container">
    <?=$content?>
</div>

<div id="footer">
    <div class="container">
        <p class="text-muted text-center">Egor Isaev &copy;2015<?=(date('Y') != 2015) ? '-'.date('Y') : ''?> All Rights Reserved.</p>
    </div>
</div>
</body>
</html>