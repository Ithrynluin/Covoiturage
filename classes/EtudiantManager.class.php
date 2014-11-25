<?php
class EtudiantManager{
	private $db;

	
	public function __construct($db) {
		$this->db = $db;
	}
	
	public function add ($etudiant) {
		$requete = $this->db->prepare(
		'INSERT INTO etudiant(per_num, dep_num, div_num) VALUES (:per_num, :dep_num, :div_num);');
		$requete->bindValue(':per_num', $etudiant->getPer_num());
		$requete->bindValue(':dep_num', $etudiant->getDep_num());
		$requete->bindValue(':div_num', $etudiant->getDiv_num());
		
		$retour=$requete->execute();
		return $retour;
	}
	
	public function getAllEtudiant() {
		$listeEtudiants = array();
		$sql='SELECT per_num, dep_num, div_num FROM etudiant ORDER BY per_num';
		$requete = $this->db->prepare($sql);
		$requete->execute();
		while ($etudiant = $requete->fetch(PDO::FETCH_ASSOC)) {
			$listeEtudiants[] = new Etudiant($etudiant);
		}
		$requete->closeCursor();
		
		return $listeEtudiants;
	}
    
    public function delete($num){
        $sql = 'DELETE FROM etudiant WHERE per_num = :num';
        $requete = $this->db->prepare($sql);
        $requete->bindValue(":num", $num);
        $retour = $requete->execute();
        return $retour;
    }
}
?>