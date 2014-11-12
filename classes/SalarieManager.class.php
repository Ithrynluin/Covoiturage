<?php
class SalarieManager{
	private $db;

	
	public function __construct($db) {
		$this->db = $db;
	}
	
	public function add ($salarie) {
		$requete = $this->db->prepare(
		'INSERT INTO salarie(sal_telprof, fon_num) VALUES (:sal_telprof, :fon_num);');
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
}
?>