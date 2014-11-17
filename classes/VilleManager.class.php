<?php
class VilleManager {
    private $db;

    public function __construct($db) {
        $this -> db = $db;
    }

    public function add($ville) {
        $requete = $this -> db -> prepare('INSERT INTO ville (vil_nom) VALUES (:nom);');
        $requete -> bindValue(':nom', $ville -> getVilNom());

        $retour = $requete -> execute();
        return $retour;
    }

    public function getAllVilles() {
        $listeVilles = array();
        $sql = 'SELECT vil_num, vil_nom FROM ville ORDER BY vil_nom';
        $requete = $this -> db -> prepare($sql);
        $requete -> execute();
        while ($ville = $requete -> fetch(PDO::FETCH_ASSOC)) {
            $listeVilles[] = new Ville($ville);
        }
        $requete -> closeCursor();

        return $listeVilles;
    }

    public function getVille($num) {
        $sql = 'SELECT vil_num, vil_nom FROM ville WHERE vil_num = :num';
        $requete = $this -> db -> prepare($sql);
        $requete -> bindValue(":num", $num);
        $requete -> execute();
        $value = $requete -> fetch(PDO::FETCH_ASSOC);
        $ville = new Ville($value);
        $requete -> closeCursor();

        return $ville;
    }

    public function getVillesParcoursDepart() {
        $listeVille = array();
        $sql = 'Select distinct vil_num, vil_nom from ville 
                where vil_num in (select vil_num1 from parcours) 
                OR vil_num in (select vil_num2 from parcours)';
        $requete = $this -> db -> prepare($sql);
        $requete -> execute();
        while ($ligne = $requete -> fetch(PDO::FETCH_ASSOC)) {
            $ville = new Ville($ligne);
            $listeVille[] = $ville;
        }

        $requete -> closeCursor();
        return $listeVille;
    }
    
    public function getVilleParcoursArrive($ville_num){
        $listeVille = array();
        $sql = 'Select distinct vil_num, vil_nom from ville 
                where vil_num in (select vil_num1 from parcours where vil_num2=:num) 
                OR vil_num in (select vil_num2 from parcours where vil_num1=:num)';
        $requete = $this -> db -> prepare($sql);
        $requete->bindValue(':num', $ville_num);
        $requete -> execute();
        while ($ligne = $requete -> fetch(PDO::FETCH_ASSOC)) {
            $ville = new Ville($ligne);
            $listeVille[] = $ville;
        }

        $requete -> closeCursor();
        return $listeVille;
    }

}
?>