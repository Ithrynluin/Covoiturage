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
    
    public function getAllParcours(){
        $list = array();
        $sql = "SELECT par_num, par_km, vil_num1, vil_num2 
                    FROM parcours";
        $requete = $this->db->prepare($sql);
        
        $requete->execute();
        while($parcours = $requete->fetch(PDO::FETCH_OBJ)){
            $list[] = new Parcours($parcours);
        }
        
        return $list;
    }
	
    public function getParcoursEtSensAvecVilles($vil_num1, $vil_num2){
        $resultat = array();
        $sql='Select par_num from parcours where vil_num1 = :vil_num1 and vil_num2 = :vil_num2';
        $requete = $this->db->prepare($sql);
        $requete->bindValue(':vil_num1', $vil_num1);
        $requete->bindValue(':vil_num2', $vil_num2);
        $requete->execute();
        $ligne = $requete->fetch(PDO::FETCH_ASSOC);
        if(!$ligne){
            $sql='Select par_num from parcours where vil_num1 = :vil_num2 and vil_num2 = :vil_num1';
            $requete = $this->db->prepare($sql);
            $requete->bindValue(':vil_num1', $vil_num1);
            $requete->bindValue(':vil_num2', $vil_num2);
            $requete->execute();
            $ligne = $requete->fetch(PDO::FETCH_ASSOC);
            if(!$ligne){
                $resultat = false;
            }else{
                $resultat['sens'] = 1;
                $resultat['parcours'] = $ligne['par_num'];
            }
        }else{
            $resultat['sens'] = 0;
            $resultat['parcours'] = $ligne['par_num'];
        }
        return $resultat;
    }
}