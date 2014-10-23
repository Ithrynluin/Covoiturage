<?php
class Parcours{
	private $par_num;
    private $par_km;
    private $vil_num1;
    private $vil_num2;
    
    public function __construct($valeurs){
        if(!empty($valeurs)){
            $this->affecte($valeurs);
        }
    }
    
    public function affecte ($donnees){
        foreach ($donnees as $key => $value) {
            switch ($key) {
                case 'par_num':
                    $this->setPar_num($value);
                    break;
                    
                case 'par_km':
                    $this->setPar_km($value);
                    break;
                    
                case 'vil_num1':
                    $this->setVil_num1($value);
                    break;
                    
                case 'vil_num2':
                    $this->setVil_num2($value);
                    break;
                                    
                default:
                    break;
            }
        }
    }

	/**
    * Get par_num
    * @return numero du parcour
    */
    public function getPar_num(){
        return $this->par_num;
    }

	/**
    * Set par_num
    * @param numero du parcour $par_num
    */
    public function setPar_num($par_num){
        $this->par_num = $par_num;
    }

	/**
    * Get par_km
    * @return VariableType
    */
    public function getPar_km(){
        return $this->par_km;
    }

	/**
    * Set par_km
    * @param VariableType $par_km
    */
    public function setPar_km($par_km){
        $this->par_km = $par_km;
    }

	/**
    * Get vil_num1
    * @return VariableType
    */
    public function getVil_num1(){
        return $this->vil_num1;
    }

	/**
    * Set vil_num1
    * @param VariableType $vil_num1
    */
    public function setVil_num1($vil_num1){
        $this->vil_num1 = $vil_num1;
    }

	/**
    * Get vil_num2
    * @return VariableType
    */
    public function getVil_num2(){
        return $this->vil_num2;
    }

	/**
    * Set vil_num2
    * @param VariableType $vil_num2
    */
    public function setVil_num2($vil_num2){
        $this->vil_num2 = $vil_num2;
    }
}

?>