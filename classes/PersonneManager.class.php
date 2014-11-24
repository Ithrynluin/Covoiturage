<?php
class PersonneManager{
	private $db;

	
	public function __construct($db) {
		$this->db = $db;
	}
	
	public function add ($personne) {
		$requete = $this->db->prepare(
		'INSERT INTO personne(per_nom, per_prenom, per_tel, per_mail, per_login, per_pwd) VALUES (:nom, :prenom, :tel, :mail, :login, :pwd);');
		$requete->bindValue(':nom', $personne->getPer_nom());
		$requete->bindValue(':prenom', $personne->getPer_prenom());
		$requete->bindValue(':tel', $personne->getPer_tel());
		$requete->bindValue(':mail', $personne->getPer_mail());
		$requete->bindValue(':login', $personne->getPer_login());
		$requete->bindValue(':pwd', $personne->getPer_pwd());
		
		$retour=$requete->execute();
		if($retour == 0) {
			$id = 0;
		} else {
			$id = $this->db->lastInsertId();
		}
		return $id;
	}
	
	public function getAllPersonne() {
		$listePersonnes = array();
		$sql='SELECT per_num, per_nom, per_prenom, per_tel, per_mail, per_login, per_pwd FROM personne ORDER BY per_nom, per_prenom, per_num';
		$requete = $this->db->prepare($sql);
		$requete->execute();
		while ($personne = $requete->fetch(PDO::FETCH_ASSOC)) {
			$listePersonnes[] = new Personne($personne);
		}
		$requete->closeCursor();
		
		return $listePersonnes;
	}
    
    public function getPersonneLogin($login){
        $sql = "SELECT per_num, per_nom, per_prenom, per_tel, per_mail, per_login, per_pwd
                FROM personne WHERE per_login = :login";
        $requete = $this->db->prepare($sql);
        $requete->bindValue(":login", $login);
        $requete->execute();
        $ligne = $requete->fetch(PDO::FETCH_ASSOC);
        if(!$ligne){
            $personne = false;
        }else{
            $personne = new Personne($ligne);
        }
        
        return $personne;
    }
	
	public function isEtudiant($num) {
		$sql = "SELECT COUNT(*) FROM etudiant WHERE per_num = :num";
		$requete = $this->db->prepare($sql);
		$requete->bindValue(":num", $num);
		$requete->execute();
		$ligne = $requete->fetch(PDO::FETCH_ASSOC);
		if($ligne == 0) {
			$etudiant = false;
		}else {
			$etudiant = true;
		}
		
		return $etudiant;
	}
}
?>