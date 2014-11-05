<?php
class PersonneManager{
	private $db;

	
	public function __construct($db) {
		$this->db = $db;
	}
	
	public function add ($personne) {
		$requete = $this->db->prepare(
		'INSERT INTO personne(per_nom, per_prenom, per_tel, per_mail, per_login, per_pwd) VALUES (:nom, :prenom, :tel, :mail, :login, :pwd);');
		$requete->binValue(':nom', $personne->getPer_nom());
		$requete->binValue(':prenom', $personne->getPer_prenom());
		$requete->binValue(':tel', $personne->getPer_tel());
		$requete->binValue(':mail', $personne->getPer_mail());
		$requete->binValue(':login', $personne->getPer_login());
		$requete->binValue(':pwd', $personne->getPer_pwd());
		
		$retour=$requete->execute();
		return $retour;
	}
	
	public function getAllPersonne() {
		$listePersonnes = array();
		$sql='SELECT per_num, per_nom, per_prenom, per_tel, per_mail, per_login, per_pwd FROM personne ORDER BY per_nom';
		$requete = $this->db->prepare($sql);
		$requete->execute();
		while ($personne = $requete->fetch(PDO::FETCH_ASSOC)) {
			$listePersonnes[] = new Personne($personne);
		}
		$requete->closeCursor();
		
		return $listePersonnes;
	}
}
?>