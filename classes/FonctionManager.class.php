<?php
class FonctionManager{
	private $db;
	
	public function __construct($db) {
		$this->db = $db;
	}
	
	public function add ($fonction) {
		$requete = $this->db->prepare(
		'INSERT INTO fonction (fon_num) VALUES (:libelle)');
		$requete->bindValue(':libelle', $fonction->getFon_libelle());
		
		$retour=$requete->execute();
		return $retour;
	}
	
	public function getAllFonctions() {
		$listeFonctions = array();
		$sql='SELECT fon_num, fon_libelle FROM fonction ORDER BY fon_num';
		$requete=$this->db->prepare($sql);
		$requete->execute();
		while ($fonction = $requete->fetch(PDO::FETCH_ASSOC)) {
			$listeFonctions[] = new Fonction($fonction);
		}
		$requete->closeCursor();
		
		return $listeFonctions;
	}
	
	public function getFonction($num) {
		$sql='SELECT fon_num, fon_libelle FROM fonction WHERE fon_num = :num';
		$requete=$this->db->prepare($sql);
		$requete->bindValue(":num", $num);
		$requete->execute();
		$value = $requete->fetch(PDO::ASSOC);
		$fonction = new Fonction($value);
		$requete->closeCursor();
		
		return $fonction;
	}
}?>