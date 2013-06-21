<?php
	require_once'twig/lib/Twig/Autoloader.php';
	
	Twig_Autoloader::register();

	$loader = new Twig_Loader_Filesystem('tpl/');	
	$twig = new Twig_Environment($loader, array('cache' => false));
	

	$torender = null;

	$template = $twig->loadTemplate('index.twig');
	
	if ($_POST['action'] == 'fetch'){
	
		$list[] = array(
			'id'			=> 'john1',
			'name'  		=> 'John Doe',
			'departement'	=> 'DOS',
			'tache'			=> 'Bureau à mettre en place',
			'timeLastUpdate'=> '12/12/12',
			'icon'			=> 'forward',
			'label'			=> array(
				'class'		=> 'warning',
				'status'	=> 'validation demandée',
				'classbg'	=> 'warning'
			));

		$list[] = array(
			'id'			=> 'john2',
			'name'  		=> 'John Doe the great',
			'departement'	=> 'DAS',
			'tache'			=> 'Donner un badge',
			'timeLastUpdate'=> '24/24/24',
			'icon'			=> 'backward',
			'label'			=> array(
				'class'		=> 'important',
				'status'	=> 'Vite !!!',
				'classbg'	=> 'error'
			));

		$list[] = array(
			'id'			=> 'l4',
			'name'  		=> 'John le beau',
			'departement'	=> 'DT',
			'tache'			=> 'Reprendre le badge',
			'timeLastUpdate'=> '24/24/24',
			'icon'			=> 'retweet'
			);

		$torender = $list;
		$template = $twig->loadTemplate('ajax.twig');

	}
	echo $template->render(array('checklists' => $torender));

