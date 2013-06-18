<?php

	require_once'../twig/lib/Twig/Autoloader.php';
	
	Twig_Autoloader::register();
	$loader = new Twig_Loader_Filesystem('../tpl/');	
	$twig = new Twig_Environment($loader, array('cache' => false));
	

	$twig->display('template.twig', array('template' => $template));

	$template = $twig->loadTemplate('ajax.twig');


	echo $template->display(array('name' => 'lol'));
