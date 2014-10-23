<?php
class ParcoursManager{
    
    private $db;
    
    public function __construct($db){
        $this->db = $db;
    }
    
    public function add($parcours){
        $sql= "INSERT INTO parcours (par_km, vil_num1, vil_num2) 
                VALUES (:km, :vil1, :vil2)";
        $requete = $this->db->prepare($sql);
        $requete->bindValue(":km", $parcours->getPar_km());
        $requete->bindValue(":vil1", $parcours->getVil_num1());
        $requete->bindValue(":vil2", $parcours->getVil_num2());
        
        $retour = $requete->execute();
        
        return $retour;      
    }
    
    public function exist($vil1, $vil2){
        $sql="SELECT par_num FROM parcours 
                WHERE vil_num1=:vil1 AND vil_num2 = :vil2";
        $requete = $this->db->prepare($sql);
        $requete->bindValue(":vil1", $vil1);
        $requete->bindValue(":vil2", $vil2);
        
        $requete->execute();
        if(!$requete->fetch(PDO::FETCH_ASSOC)){
            $exist = false;
        }else{
            $exist = true;
        }
        $requete->closeCursor();
        return $exist;
    }
	
}