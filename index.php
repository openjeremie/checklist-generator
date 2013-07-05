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

	require_once 'twig/lib/Twig/Autoloader.php';
	require_once 'core/DataListManager.class.php';
	require_once 'core/DBManager.class.php';

	Twig_Autoloader::register();

	$loader = new Twig_Loader_Filesystem('tpl/');	
	
	$twig 	= new Twig_Environment($loader, array('cache' => false));
	
	$db 	= new DBManager('pgsql:dbname=gas;host=pgsql-qt.vlandata.cls.fr;port=5432', 'gas', 'gasgas');

	$dlm	= new DataListManager($db);	

	$torender = null;

	$template = $twig->loadTemplate('index.twig');
	
	
	if (isset($_POST['action']) && $_POST['action'] == 'fetch'){
		
		$list = $dlm->get_full_app_list();

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

	if (isset($_POST['action']) && $_POST['action'] == 'getmodal'){
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

	if (isset($_POST['action']) && $_POST['action'] == 'add'){
		/*$icon = array(
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
		*/

		$info['value_link'] = uniqid();
		$info['id_type_contrat'] = $_POST['id_type_contrat'];
		$info['date_arrivee'] = time() + (7 * 24 * 60 * 60);
		$info['date_depart'] = time() + (7 * 24 * 60 * 60);
		$info['date_demande'] = time() + (7 * 24 * 60 * 60);
		$info['date_prolong'] = time() + (7 * 24 * 60 * 60);
		$info['nom'] = $_POST['nom'];
		$info['prenom'] = $_POST['prenom'];
		$info['anniversaire'] = time() + (7 * 24 * 60 * 60);
		$info['lieu_naissance'] = "Toulouse";
		$info['nationalite'] = "France";
		$info['responsable_uid'] = $_POST['responsable_uid'];
		$info['id_direction'] = $_POST['id_direction'];
		$info['id_departement'] = $_POST['id_departement'];
		$info['id_activite'] = $_POST['id_activite'];
		$info['fonction'] = $_POST['fonction'];
		$info['comments_resp'] = "";
		$info['comments_coll'] = "";
		$info['badge_cnes'] = false;
		$info['inscr_resto'] = false;
		$info['aff_bureau'] = false;
		$info['circuit_arr'] = false;
		$info['enregistrement'] = false;
		$info['photo'] = false;
		$info['id_cle'] = 1;
		$info['telephone'] = "01.12.23.34";
		$info['id_badge'] = 1;
		$info['mobilier'] = false;
		$info['mail'] = false;
		$info['portail'] = false;
		$info['windows'] = false;
		$info['helpdesk'] = false;
		$info['crm'] = false;
		$info['comments_comptes'] = "";
		$info['pc'] = false;
		$info['pc_type'] = "";
		$info['pc_os'] = "";
		$info['pc_nb_ecrans'] = 1;
		$info['pc_comments'] = "";
		$info['pc_soft_supp'] = "";

		$dlm->add_item($info);

		var_dump($info);

		$torender = $dlm->get_full_app_list();
		$template = $twig->loadTemplate('ajax.twig');
	}

	if (isset($_GET['wf'])) {
		$template = $twig->loadTemplate('workflow.twig');	
	}

	echo $template->render(array('checklists' => $torender));

