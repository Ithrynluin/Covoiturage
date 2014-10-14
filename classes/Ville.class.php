<?php
class Ville{
	private $num;
    private $nom;
    
    public function __construct($valeurs = array()){
        if(!empty($valeurs)){
            affecte($valeurs);
        }
    }
    
    public function affecte($donnees){
        foreach ($donnees as $attribut => $value) {
            switch ($attribut) {
                case 'vil_num':
                    $this->setNum($value);
                    break;
                case 'vil_nom':
                    $this->setNom($value);
                default:
                    break;
            }
        }
    }
    
    public function getNum(){
        $this->num;
    }
    
    public function setNum($num){
        $this->num = $num;
    }
    
    public function getNom(){
        return $this->nom;
    }
    
    public function setNom($nom){
        $this->nom = $nom;        
    }
    
}

?>