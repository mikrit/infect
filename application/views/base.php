<?php defined('SYSPATH') or die('No direct script access.');?>

<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>Инфекции</title>

		<?=HTML::style('media/bootstrap/css/bootstrap.min.css')?>
		<?=HTML::style('media/css/sticky-footer-navbar.css')?>

		<?=HTML::script('media/js/jquery.js')?>
		<?=HTML::script('media/bootstrap/js/bootstrap.min.js')?>

		<link rel="apple-touch-icon" href="media/img/cash.png">
		<link rel="icon" href="media/img/cash.ico">
	</head>

	<body>
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Мини меню</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <?=$menu?>
                </div>
            </div>
        </nav>

        <div class="container">
            <?=$content?>
        </div>

        <footer class="footer">
            <div class="container">
                <p class="text-muted text-center">&copy;2017<?=(date('Y') != 2017) ? '-'.date('Y') : ''?> All Rights Reserved.</p>
            </div>
        </footer>
	</body>
</html>