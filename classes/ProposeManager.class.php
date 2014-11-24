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
    
    
    public function getVilleDepartTrajet(){
        $listeVille = array();
        $sql = 'select distinct vil_num, vil_nom 
                from ville 
                where vil_num IN (select vil_num1 
                    from parcours p inner join propose pr on pr.par_num = p.par_num 
                    where pro_sens = 0) 
                OR vil_num IN (select vil_num2 
                    from parcours p inner join propose pr on pr.par_num = p.par_num 
                    where pro_sens = 1)';
        $requete = $this->db->prepare($sql);
        $requete->execute();
        
        while($ligne = $requete->fetch(PDO::FETCH_ASSOC)){
            $listeVille[] = new Ville($ligne);
        }
        
        $requete->closeCursor();
        return $listeVille;
    }
    
    public function getTrajetWithParam($par_num, $date_debut, $date_fin, $heure, $sens){
        $listeTrajet = array();    
        $sql='SELECT * from propose 
                Where par_num = :par_num 
                AND pro_date BETWEEN :date_debut AND :date_fin 
                AND pro_time >= :pro_time 
                AND pro_sens = :pro_sens';
        
       $requete = $this->db->prepare($sql);
       $requete->bindValue(":par_num", $par_num);
       $requete->bindValue(":date_debut", $date_debut);
       $requete->bindValue(":date_fin", $date_fin);
       $requete->bindValue(":pro_time", $heure);
       $requete->bindValue(":pro_sens", $sens);
       $requete->execute();
       
       while($ligne = $requete->fetch(PDO::FETCH_ASSOC)){
           $listeTrajet[] = new Propose($ligne);
       }
       
       $requete->closeCursor();
       return $listeTrajet;
    }
}