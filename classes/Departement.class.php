<?php
class Departement{
	private $dep_num;
	private $dep_nom;
	private $vil_num;
	
	public function __construct($valeur = array()) {
		if(!empty($valeur)) {
			$this->affecte($valeur);
		}
	}
	
	public function affecte ($donnees) {
		foreach ($donnees as $attribut => $valeur) {
			switch ($attribut) {
				case 'dep_num': $this->setDep_num($valeur); break;
				
				case 'dep_nom': $this->setDep_nom($valeur); break;
				
				default: 
					echo "Erreur case : fonction affecte - classe Departement ! \n";
					break;
			}
		}
	}

	/**
    * Get dep_num
    * @return int
    */
    public function getDep_num(){
        return $this->dep_num;
    }
	
	/**
    * Set dep_num
    * @param int $dep_num
    */
    public function setDep_num($dep_num){
        $this->dep_num = $dep_num;
    }

	/**
    * Get dep_nom
    * @return string
    */
    public function getDep_nom(){
        return $this->dep_nom;
    }
	
	/**
    * Set dep_nom
    * @param string $dep_nom
    */
    public function setDep_nom($dep_nom){
        $this->dep_nom = $dep_nom;
    }
	
	/**
    * Get vil_num
    * @return int
    */
    public function getVil_num(){
        return $this->vil_num;
    }

	/**
    * Set vil_num
    * @param int $vil_num
    */
    public function setVil_num($vil_num){
        $this->vil_num = $vil_num;
    }	
}