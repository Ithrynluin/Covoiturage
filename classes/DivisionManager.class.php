<?php
class DivisionManager{
	private $db;
	
	public function __construct($db) {
		$this->db = $db;
	}
	
	public function add ($division) {
		$requete = $this->db->prepare(
		'INSERT INTO division (div_nom) VALUES (:nom);');
		$requete->bindValue(':nom', $division->getDivNom());
		
		$retour=$requete->execute();
		return $retour;
	}
	
	public function getAllDivisions() {
		$listeDivisions = array();
		$sql='SELECT div_num, div_nom FROM division ORDER BY div_nom';
		$requete=$this->db->prepare($sql);
		$requete->execute();
		while ($division = $requete->fetch(PDO::FETCH_ASSOC)) {
			$listeDivisions[] = new Division($division);
		}
		$requete->closeCursor();
		
		return $listeDivisions;
	}
	
	public function getDivision($num) {
		$sql='SELECT div_num, div_nom FROM division WHERE div_num = :num';
		$requete=$this->db->prepare($sql);
		$requete->bindValue(":num", $num);
		$requete->execute();
		$value = $requete->fetch(PDO::ASSOC);
		$division = new Division($value);
		$requete->closeCursor();
		
		return $division;
	}
}
?>