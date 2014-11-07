<?php
class DepartementManager{
	private $db;
	
	public function __construct($db) {
		$this->db = $db;
	}
	
	public function add ($departement) {
		$requete = $this->db->prepare(
		'INSERT INTO departement (dep_nom) VALUES (:nom)');
		$requete->bindValue(':nom', $departement->getDep_nom());
		
		$retour=$requete->execute();
		return $retour;
	}
}