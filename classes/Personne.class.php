<?php
class Personne{
	private $per_num;
	private $per_nom;
	private $per_prenom;
	private $per_tel;
	private $per_mail;
	private $per_login;
	private $per_pwd;
	
	public function __construct($valeur = array()) {
		if(!empty($valeur)) {
			$this->affecte($valeur);
		}
	}
	
	public function affecte ($donnees) {
		foreach ($donnees as $attribut => $valeur) {
			switch ($attribut) {
				case 'per_num': $this->setPer_num($valeur); break;
				case 'per_nom' : $this->setPer_nom($valeur); break;
				case 'per_prenom' : $this->setPer_prenom($valeur); break;
				case 'per_tel' : $this->setPer_tel($valeur); break;
				case 'per_mail' : $this->setPer_mail($valeur); break;
				case 'per_login' : $this->setPer_login($valeur); break;
				case 'per_pwd' : $this->setPer_pwd($valeur); break;
				
				default:break;
			}
		}
	}


	/**
    * Get per_num
    * @return int
    */
    public function getPer_num(){
        return $this->per_num;
    }

	/**
    * Set per_num
    * @param int $per_num
    */
    public function setPer_num($per_num){
        $this->per_num = $per_num;
    }

	/**
    * Get per_nom
    * @return string
    */
    public function getPer_nom(){
        return $this->per_nom;
    }

	/**
    * Set per_nom
    * @param string $per_nom
    */
    public function setPer_nom($per_nom){
        $this->per_nom = $per_nom;
    }

	/**
    * Get per_prenom
    * @return string
    */
    public function getPer_prenom(){
        return $this->per_prenom;
    }

	/**
    * Set per_prenom
    * @param string $per_prenom
    */
    public function setPer_prenom($per_prenom){
        $this->per_prenom = $per_prenom;
    }

	/**
    * Get per_tel
    * @return string
    */
    public function getPer_tel(){
        return $this->per_tel;
    }

	/**
    * Set per_tel
    * @param string $per_tel
    */
    public function setPer_tel($per_tel){
        $this->per_tel = $per_tel;
    }

	/**
    * Get per_mail
    * @return string
    */
    public function getPer_mail(){
        return $this->per_mail;
    }

	/**
    * Set per_mail
    * @param string $per_mail
    */
    public function setPer_mail($per_mail){
        $this->per_mail = $per_mail;
    }

	/**
    * Get per_login
    * @return string
    */
    public function getPer_login(){
        return $this->per_login;
    }

	/**
    * Set per_login
    * @param string $per_login
    */
    public function setPer_login($per_login){
        $this->per_login = $per_login;
    }

	/**
    * Get per_pwd
    * @return string
    */
    public function getPer_pwd(){
        return $this->per_pwd;
    }

	/**
    * Set per_pwd
    * @param string $per_pwd
    */
    public function setPer_pwd($per_pwd){
        $this->per_pwd = $per_pwd;
    }
}
?>