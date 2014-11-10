<?php
class Fonction{
	private $fon_num;
	private $fon_libelle;
	
	public function __construct($valeur = array()) {
		if(!empty($valeur)) {
			$this->affecte($valeur);
		}
	}
	
	public function affecte ($donnees) {
		foreach ($donnees as $attribut => $valeur) {
			switch ($attribut) {
				case 'fon_num': $this->setFon_num($valeur); break;
				
				case 'fon_libelle': $this->setFon_libelle($valeur); break;
				
				default:
					echo "Erreur case : fonction affecte - classe Fonction ! \n";
					break;
			}	
		}
	}

	/**
    * Get fon_num
    * @return int
    */
    public function getFon_num(){
        return $this->fon_num;
    }

	/**
    * Set fon_num
    * @param int $fon_num
    */
    public function setFon_num($fon_num){
        $this->fon_num = $fon_num;
    }

	/**
    * Get fon_libelle
    * @return string
    */
    public function getFon_libelle(){
        return $this->fon_libelle;
    }

	/**
    * Set fon_libelle
    * @param string $fon_libelle
    */
    public function setFon_libelle($fon_libelle){
        $this->fon_libelle = $fon_libelle;
    }
}?>