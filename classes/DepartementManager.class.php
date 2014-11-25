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
	
	public function getAllDepartements() {
		$listeDepartements = array();
		$sql='SELECT dep_num, dep_nom, vil_num FROM departement ORDER BY dep_num';
		$requete=$this->db->prepare($sql);
		$requete->execute();
		while ($departement = $requete->fetch(PDO::FETCH_ASSOC)) {
			$listeDepartements[] = new Departement($departement);
		}
		$requete->closeCursor();
		
		return $listeDepartements;
	}
	
	public function getDepartement($num) {
		$sql='SELECT dep_num, dep_nom, vil_num FROM departement WHERE dep_num = :num';
		$requete=$this->db->prepare($sql);
		$requete->bindValue(":num", $num);
		$requete->execute();
		$value = $requete->fetch(PDO::FETCH_ASSOC);
		$departement = new Departement($value);
		$requete->closeCursor();
		
		return $departement;
	}
}
?>