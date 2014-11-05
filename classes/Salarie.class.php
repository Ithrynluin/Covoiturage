<?php
class Salarie extends Personne{
	private $sal_telprof;
	private $fon_num;
	
	public function __construct($valeur = array()) {
		if(!empty($valeur)) {
			parent::__construct($valeur);
        	$this->affecteSalarie($valeur);
		}
	}
	
	public function affecteSalarie($donnees) {
		foreach ($donnees as $attribut => $valeur) {
			switch ($attribut) {
				case 'sal_telprof' : $this->setSal_telprof($valeur) ; break;
				case 'fon_num' : $this->setFon_num($valeur); break;
				default:break;
			}
		}
	}

	/**
    * Get sal_telprof
    * @return string
    */
    public function getSal_telprof(){
        return $this->sal_telprof;
    }

	/**
    * Set sal_telprof
    * @param string $sal_telprof
    */
    public function setSal_telprof($sal_telprof){
        $this->sal_telprof = $sal_telprof;
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
}
?>