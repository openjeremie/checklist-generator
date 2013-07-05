<?php

class DataListManager {
	private $db;

	public function __construct($DataBase = null) {
		$this->db = $DataBase;
	}

	public function get_full_app_list() {
		$query = $this->db->prepare("SELECT * FROM wf;");
		$query->execute();
		$full_list = $query->fetchAll();
		return $full_list;
	}

	public function get_item_app_list($id = 0) {

	}

	public function add_item($item = array()) {

		$statement = "INSERT INTO gas.public.wf (timestamp, value_link, id_type_contrat, date_arrivee, date_depart, date_demande, date_prolong, nom, prenom, anniversaire, lieu_naissance, nationalite, responsable_uid, id_direction, id_departement, id_activite, fonction, comments_resp, comments_coll, badge_cnes, inscr_resto, aff_bureau, circuit_arr, enregistrement, photo, id_cle, telephone, id_badge, mobilier, mail, portail, windows, helpdesk, crm, comments_comptes, pc, pc_type, pc_os, pc_nb_ecrans, pc_comments, pc_soft_supp) VALUES (:timestamp, :value_link, :id_type_contrat, :date_arrivee, :date_depart, :date_demande, :date_prolong, :nom, :prenom, :anniversaire, :lieu_naissance, :nationalite, :responsable_uid, :id_direction, :id_departement, :id_activite, :fonction, :comments_resp, :comments_coll, :badge_cnes, :inscr_resto, :aff_bureau, :circuit_arr, :enregistrement, :photo, :id_cle, :telephone, :id_badge, :mobilier, :mail, :portail, :windows, :helpdesk, :crm, :commments_comptes, :pc, :pc_type, :pc_os, :pc_nb_ecrans, :pc_comments, :pc_soft_supp);";

		$query = $this->db->prepare($statement);
		
		$timestamp = time() + (7 * 24 * 60 * 60);

		$query->bindParam(':timestamp', $timestamp, PDO::PARAM_INT);
		$query->bindParam(':value_link', $item['value_link'], PDO::PARAM_STR);
		$query->bindParam(':id_type_contrat', $item['id_type_contrat'], PDO::PARAM_INT);
		$query->bindParam(':date_arrivee', $item['date_arrivee'], PDO::PARAM_INT);
		$query->bindParam(':date_depart', $item['date_depart'], PDO::PARAM_INT);
		$query->bindParam(':date_demande', $item['date_demande'], PDO::PARAM_INT);
		$query->bindParam(':date_prolong', $item['date_prolong'], PDO::PARAM_INT);
		$query->bindParam(':nom', $item['nom'], PDO::PARAM_STR);
		$query->bindParam(':prenom', $item['prenom'], PDO::PARAM_STR);
		$query->bindParam(':anniversaire', $item['anniversaire'], PDO::PARAM_INT);
		$query->bindParam(':lieu_naissance', $item['lieu_naissance'], PDO::PARAM_STR);
		$query->bindParam(':nationalite', $item['nationalite'], PDO::PARAM_STR);
		$query->bindParam(':responsable_uid', $item['responsable_uid'], PDO::PARAM_STR);
		$query->bindParam(':id_direction', $item['id_direction'], PDO::PARAM_INT);
		$query->bindParam(':id_departement', $item['id_departement'], PDO::PARAM_INT);
		$query->bindParam(':id_activite', $item['id_activite'], PDO::PARAM_INT);
		$query->bindParam(':fonction', $item['fonction'], PDO::PARAM_STR);
		$query->bindParam(':comments_resp', $item['comments_resp'], PDO::PARAM_STR);
		$query->bindParam(':comments_coll', $item['comments_coll'], PDO::PARAM_STR);
		$query->bindParam(':badge_cnes', $item['badge_cnes'], PDO::PARAM_BOOL);
		$query->bindParam(':inscr_resto', $item['inscr_resto'], PDO::PARAM_BOOL);
		$query->bindParam(':aff_bureau', $item['aff_bureau'], PDO::PARAM_BOOL);
		$query->bindParam(':circuit_arr', $item['circuit_arr'], PDO::PARAM_BOOL);
		$query->bindParam(':enregistrement', $item['enregistrement'], PDO::PARAM_BOOL);
		$query->bindParam(':photo', $item['photo'], PDO::PARAM_BOOL);
		$query->bindParam(':id_cle', $item['id_cle'], PDO::PARAM_INT);
		$query->bindParam(':telephone', $item['telephone'], PDO::PARAM_STR);
		$query->bindParam(':id_badge', $item['id_badge'], PDO::PARAM_INT);
		$query->bindParam(':mobilier', $item['mobilier'], PDO::PARAM_BOOL);
		$query->bindParam(':mail', $item['mail'], PDO::PARAM_BOOL);
		$query->bindParam(':portail', $item['portail'], PDO::PARAM_BOOL);
		$query->bindParam(':windows', $item['windows'], PDO::PARAM_BOOL);
		$query->bindParam(':helpdesk', $item['helpdesk'], PDO::PARAM_BOOL);
		$query->bindParam(':crm', $item['crm'], PDO::PARAM_BOOL);
		$query->bindParam(':pc', $item['pc'], PDO::PARAM_BOOL);
		$query->bindParam(':pc_type', $item['pc_type'], PDO::PARAM_STR);
		$query->bindParam(':pc_os', $item['pc_os'], PDO::PARAM_STR);
		$query->bindParam(':pc_nb_ecrans', $item['pc_nb_ecrans'], PDO::PARAM_INT);
		$query->bindParam(':pc_comments', $item['pc_comments'], PDO::PARAM_STR);
		$query->bindParam(':pc_soft_supp', $item['pc_soft_supp'], PDO::PARAM_STR);
		
		$query->execute();
	}

	public function remove_item($id = 0){

	}

	public function edit_item($id = 0, $item = array()) {

	}
}
