<?php
class SalarieManager{
	private $db;

	
	public function __construct($db) {
		$this->db = $db;
	}
	
	public function add ($salarie) {
		$requete = $this->db->prepare(
		'INSERT INTO salarie(per_num, sal_telprof, fon_num) VALUES (:per_num, :sal_telprof, :fon_num);');
		$requete->bindValue(':per_num', $salarie->getPer_num());
		$requete->bindValue(':sal_telprof', $salarie->getSal_telprof());
		$requete->bindValue(':fon_num', $salarie->getFon_num());
		
		$retour=$requete->execute();
		return $retour;
	}
	
	public function getAllSalarie() {
		$listeSalaries = array();
		$sql='SELECT per_num, sal_telprof, fon_num FROM salarie ORDER BY per_num';
		$requete = $this->db->prepare($sql);
		$requete->execute();
		while ($salarie = $requete->fetch(PDO::FETCH_ASSOC)) {
			$listeSalaries[] = new Salarie($salarie);
		}
		$requete->closeCursor();
		
		return $listeSalaries;
	}
	
	public function getSalarieNum($num){
        $sql = "SELECT per_num, sal_telprof, fon_num
                FROM salarie WHERE per_num = :num";
        $requete = $this->db->prepare($sql);
        $requete->bindValue(":num", $num);
        $requete->execute();
        $ligne = $requete->fetch(PDO::FETCH_ASSOC);
        if(!$ligne){
            $salarie = false;
        }else{
            $salarie = new Salarie($ligne);
        }
        
        return $salarie;
    }
    
    public function delete($num){
        $sql = 'DELETE FROM salarie WHERE per_num = :num';
        $requete = $this->db->prepare($sql);
        $requete->bindValue(":num", $num);
        $retour = $requete->execute();
        return $retour;
    }
}
?>