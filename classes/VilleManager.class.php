<?php
class VilleManager{
	private $db;

	
	public function __construct($db) {
		$this->db = $db;
	}
	
	public function add ($ville) {
		$requete = $this->db->prepare(
		'INSERT INTO ville (vil_nom) VALUES (:nom);');
		$requete->bindValue(':nom', $ville->getVilNom());
		
		$retour=$requete->execute();
		return $retour;
	}
	
	public function getAllVilles() {
		$listeVilles = array();
		$sql='SELECT vil_num, vil_nom FROM ville ORDER BY vil_nom';
		$requete=$this->db->prepare($sql);
		$requete->execute();
		while ($ville = $requete->fetch(PDO::FETCH_ASSOC)) {
			$listeVilles[] = new Ville($ville);
		}
		$requete->closeCursor();
		
		return $listeVilles;
	}
    
    public function getVille($num){
        $sql='SELECT vil_num, vil_nom FROM ville WHERE vil_num = :num';
        $requete=$this->db->prepare($sql);
        $requete->bindValue(":num", $num);
        $requete->execute();
        $value = $requete->fetch(PDO::FETCH_ASSOC);
        $ville = new Ville($value);
        $requete->closeCursor();
        
        return $ville;
    }
}

?>