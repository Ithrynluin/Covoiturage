<?php
class Etudiant extends Personne{
	private $dep_num;
	private $div_num;

	public function __construct($valeur = array()) {
		if(!empty($valeur)) {
			parent::__construct($valeur);
        	$this->affecteEtudiant($valeur);
		}
	}
	
	public function affecteEtudiant($donnees) {
		foreach ($donnees as $attribut => $valeur) {
			switch ($attribut) {
				case 'dep_num' : $this->setDep_num($valeur); break;
				case 'div_num' : $this->setDiv_num($valeur); break;
				default:break;
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
    * Get div_num
    * @return int
    */
    public function getDiv_num(){
        return $this->div_num;
    }

	/**
    * Set div_num
    * @param int $div_num
    */
    public function setDiv_num($div_num){
        $this->div_num = $div_num;
    }
}