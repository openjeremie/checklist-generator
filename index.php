<?php
	require_once'twig/lib/Twig/Autoloader.php';
	Twig_Autoloader::register();

	$loader = new Twig_Loader_Filesystem('tpl/');	
	$twig = new Twig_Environment($loader);
	$template = $twig->loadTemplate('index.tpl');


	echo $template->render(array('name' => 'lol'));
