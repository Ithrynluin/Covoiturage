<?php
	function getEnglishDate($date){
		$membres = explode('/', $date);
		$date = $membres[2].'-'.$membres[1].'-'.$membres[0];
		return $date;
	}
	
	function addJours($date, $nbJours){
		$membres = explode('/', $date);
		$date = $membres[2].'-'.$membres[1].'-'.(intval($membres[0])+$nbJours);
		return $date;
	}
    
    /**
     * Fonction qui définit la page précédament consulter
     * @param page Actuel
     */
     function setPagePrecedente($pageActuel){
         $pagePrecedente = $_SERVER['HTTP_REFERER'];
         if($pageActuel != $pagePrecedente){
             $_SESSION[$pageActuel] = $pagePrecedente;
         }
     }
     
     /**
      * Fonction qui retourne la page précédante
      * @param page actuel
      * @return la page précédente ou false si la page n'existe pas
      */
      function getPagePrecedente($pageActuel){
          if(empty($_SESSION[$pageActuel])){
              $pagePrecedente = false;
          }else{
              $pagePrecedente = $_SESSION[$pageActuel];
          }
          return $pagePrecedente;
      }
	
?>