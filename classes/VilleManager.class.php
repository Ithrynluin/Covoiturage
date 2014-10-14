<?php
class VilleManager{
	private $db;
    
    public function __construct($db){
        $this->db = $db;
    }
    
    public function add($ville){
        $sql='INSERT INTO ville (vil_num) values :nom';
        $requete = $this->db->prepare($sql);
        $requete->bindValue(':nom', $ville->getNom());
        $retour = $requete->execute();
        return $retour;
    }
}

?>