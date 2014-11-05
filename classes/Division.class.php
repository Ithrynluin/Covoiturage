<?php
class Division{
	private $div_num;
	private $div_nom;
	
	public function __construct($valeur = array()) {
		if(!empty($valeur)) {
			$this->affecte($valeur);
		}
	}
	
	public function affecte ($donnees) {
		foreach ($donnees as $attribut => $valeur) {
			switch ($attribut) {
				case 'div_num': $this->setDiv_num($valeur); break;
				
				case 'div_nom': $this->setDiv_nom($valeur); break;
				
				default :
					echo "Erreur case : fonction affecte - classe Division ! \n";
					break;
			}
			
		}
	}

	/**
    * Get div_num
    * @return VariableType
    */
    public function getDiv_num(){
        return $this->div_num;
    }

	/**
    * Set div_num
    * @param VariableType $div_num
    */
    public function setDiv_num($div_num){
        $this->div_num = $div_num;
    }

	/**
    * Get div_nom
    * @return int
    */
    public function getDiv_nom(){
        return $this->div_nom;
    }

	/**
    * Set div_nom
    * @param string $div_nom
    */
    public function setDiv_nom($div_nom){
        $this->div_nom = $div_nom;
    }
}