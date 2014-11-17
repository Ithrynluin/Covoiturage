<?php
class ProposeManager{
	private $db;

    public function __construct($db){
        $this->db = $db;
    }
    
    public function add($propose){
        $sql = 'INSERT INTO propose(per_num, par_num, pro_date, pro_time, pro_place, pro_sens)
                    VALUES (:personne, :parcours, :date, :time, :place, :sens)';
        $requete = $this->db->prepare($sql);
        $requete->bindValue(':personne', $propose->getPer_num());
        $requete->bindValue(':parcours', $propose->getPar_num());
        $requete->bindValue(':date', $propose->getPro_date());
        $requete->bindValue(':time', $propose->getPro_time());
        $requete->bindValue(':place', $propose->getPro_place());
        $requete->bindValue(':sens', $propose->getPro_sens());
        $retour = $requete->execute();
        return $retour;
    }
}