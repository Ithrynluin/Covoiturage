<?php
class Propose{
	private $par_num;
    private $per_num;
    private $pro_date;
    private $pro_time;
    private $pro_place;
    private $pro_sens;
    
    public function __construct($valeur){
        if(!empty($valeur)){
            $this->affecte($valeur);
        }
    }
    
    public function affecte($donnees){
        foreach ($donnees as $key => $value) {
            switch ($key) {
                case 'per_num':
                    $this->setPer_num($value);                    
                    break;
                case 'par_num':
                    $this->setPar_num($value);
                    break;
                case 'pro_date':
                    $this->setPro_date($value);
                    break;
                case 'pro_time':
                    $this->setPro_time($value);
                    break;
                case 'pro_place':
                    $this->setPro_place($value);
                case 'pro_sens':
                    $this->setPro_sens($value);
                default:
                    break;
            }
        }
    }

	/**
    * Get par_num
    * @return numero personne
    */
    public function getPar_num(){
        return $this->par_num;
    }

	/**
    * Set par_num
    * @param numero personne $par_num
    */
    public function setPar_num($par_num){
        $this->par_num = $par_num;
    }

	/**
    * Get per_num
    * @return numero du de la personne
    */
    public function getPer_num(){
        return $this->per_num;
    }

	/**
    * Set per_num
    * @param numero du de la personne $per_num
    */
    public function setPer_num($per_num){
        $this->per_num = $per_num;
    }

	/**
    * Get pro_date
    * @return date de la proposition
    */
    public function getPro_date(){
        return $this->pro_date;
    }

	/**
    * Set pro_date
    * @param date de la proposition $pro_date
    */
    public function setPro_date($pro_date){
        $this->pro_date = $pro_date;
    }

	/**
    * Get pro_time
    * @return heure de la proposition
    */
    public function getPro_time(){
        return $this->pro_time;
    }

	/**
    * Set pro_time
    * @param heure de la proposition $pro_time
    */
    public function setPro_time($pro_time){
        $this->pro_time = $pro_time;
    }

	/**
    * Get pro_sens
    * @return le sens de parcours proposé
    */
    public function getPro_sens(){
        return $this->pro_sens;
    }

	/**
    * Set pro_sens
    * @param le sens de parcours proposé $pro_sens
    */
    public function setPro_sens($pro_sens){
        $this->pro_sens = $pro_sens;
    }

	/**
    * Get pro_place
    * @return Nombre de place
    */
    public function getPro_place(){
        return $this->pro_place;
    }

	/**
    * Set pro_place
    * @param Nombre de place $pro_place
    */
    public function setPro_place($pro_place){
        $this->pro_place = $pro_place;
    }
}