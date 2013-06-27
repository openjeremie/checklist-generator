<?php
	/*
	 *
	 * TODO : Make it secure.
	 * TODO : Make it logical.
	 * TODO : Make it nice and clear with separate classes.
	 * TODO : Make it database ready.
	 * TODO : Make it LDAP authentification ready.
	 *
	 */

	require_once'twig/lib/Twig/Autoloader.php';
	
	Twig_Autoloader::register();

	$loader = new Twig_Loader_Filesystem('tpl/');	
	
	$twig = new Twig_Environment($loader, array('cache' => false));
	

	$torender = null;

	$template = $twig->loadTemplate('index.twig');
	
	if ($_POST['action'] == 'fetch'){
	
		$list[] = array(
			'id'			=> '1',
			'name'  		=> 'John Doe',
			'departement'	=> 'DOS',
			'tache'			=> 'Bureau à mettre en place',
			'timeLastUpdate'=> '12/12/12',
			'icon'			=> 'forward',
			'link'			=> 'http://url.application.tld/?w=1234',
			'completeClass'	=> array('ok', 'refresh', 'ok'),
			'label'			=> array(
				'class'		=> 'warning',
				'status'	=> 'validation demandée',
				'classbg'	=> 'warning'
			));

		$list[] = array(
			'id'			=> '2',
			'name'  		=> 'John Doe',
			'departement'	=> 'DAS',
			'tache'			=> 'Donner un badge',
			'timeLastUpdate'=> '24/24/24',
			'icon'			=> 'backward',
			'link'			=> 'http://url.application.tld/?w=1234',
			'completeClass'	=> array('ok', 'refresh', 'ok'),
			'label'			=> array(
				'class'		=> 'important',
				'status'	=> 'Vite !!!',
				'classbg'	=> 'error'
			));

		$list[] = array(
			'id'			=> 'l4',
			'name'  		=> 'John Doe',
			'departement'	=> 'DT',
			'tache'			=> 'Reprendre le badge',
			'timeLastUpdate'=> '24/24/24',
			'link'			=> 'http://url.application.tld/?w=1234',
			'completeClass'	=> array('ok', 'refresh', 'ok'),
			'icon'			=> 'retweet'
			);

		$torender = $list;
		$template = $twig->loadTemplate('ajax.twig');

	}

	if ($_POST['action'] == 'getmodal'){

		$list = array(
			'absence' => 'modals/absence.twig',
			'arrivee' => 'modals/arrivee.twig',
			'checklist' => 'modals/checklist.twig',
			'depart' => 'modals/depart.twig',
			'mobilite' => 'modals/mobilite.twig',
			'prolongation' => 'modals/prolongation.twig'
		);
		
		$template = $twig->loadTemplate($list[$_POST['name']]);	
	}

	if ($_POST['action'] == 'add'){
		$icon = array(
			'arrivee' 	=> 'forward',
			'depart'	=> 'backward',
			'mobilite'	=> 'retweet',
			'prolongation'	=> 'resize-horizontal',
			'absence'	=> 'time'
		);

		$list[] = array(
			'id'			=> $_POST['id'],
			'name'  		=> $_POST['name'],
			'departement'	=> $_POST['dep'],
			'tache'			=> $_POST['tache'],
			'timeLastUpdate'=> '42/42/42',
			'icon'			=> $icon[$_POST['type']],
			'link'			=> 'http://url.application.tld/?w=1234',
			'completeClass'	=> array('refresh', 'refresh', 'refresh'),
			'label'			=> array(
				'class'		=> 'info',
				'status'	=> 'nouveau',
				'classbg'	=> ''
			));

		$torender = $list;
		$template = $twig->loadTemplate('ajax.twig');
	}

	echo $template->render(array('checklists' => $torender));

