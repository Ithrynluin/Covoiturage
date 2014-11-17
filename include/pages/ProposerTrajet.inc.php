<h1>Proposer un trajet</h1>
<?php
$pdo = new Mypdo();
$villeManager = new VilleManager($pdo);
if(empty($_POST['vildepart']) && empty($_POST['vilarr']) && empty($_POST['dateDep']) && empty($_POST['hDep']) && empty($_POST['nbPlaces'])){
    $listeVilleDepart = $villeManager->getVillesParcoursDepart();
?>
<form action="index.php?page=9" method="post">
    <p>
        <label for="vildepart">Ville de départ :</label>
        <select id="vildepart" name="vildepart" class="champ">
<?php       foreach ($listeVilleDepart as $value) { ?>
                <option value=<?php echo $value->getVilNum() ?>><?php echo $value->getVilNom() ?></option>
<?php       } ?>
        </select>
        <input type="submit" value="Valider" class="bouton"/>
    </p>
</form>    
<?php    
}else if(!empty($_POST['vildepart']) && empty($_POST['vilarr']) && empty($_POST['dateDep']) && empty($_POST['hDep']) && empty($_POST['nbPlaces'])){ 
    $listeVilleArrive = $villeManager->getVilleParcoursArrive($_POST['vildepart']);
    $villeDepart = $villeManager->getVille($_POST['vildepart']); 
    $_SESSION['vildepart'] = $_POST['vildepart']; ?>
   <form action="index.php?page=9" method="post">
    <table>
        <tr>
            <td><label>Ville de départ :</label></td>
            <td> <?php echo $villeDepart->getVilNom(); ?></td>
            <td>
                <label for="vilarr">Ville d'arrive :</label>
            </td>
            <td>
                <select id="vilarr" name="vilarr" class="champ">
<?php               foreach ($listeVilleArrive as $value) { ?>
                    <option value=<?php echo $value->getVilNum() ?>><?php echo $value->getVilNom() ?></option>
<?php               } ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                <label for="dateDep">Date de départ : </label>
            </td>
            <td>
                <input type="date" id="dateDep" name="dateDep" class="champ" value=<?php echo '"'.date("d/m/Y").'"'; ?>/>
            </td>
            <td>
                <label for="hDep">Heure de départ : </label>
            </td>
            <td>
                <input type="time" id="hDep" name="hDep" class="champ" value=<?php echo '"'.date("H:i:s").'"'; ?>/>
            </td>
        </tr>
        <tr>
            <td>
                <label for="nbPlaces">Nombre de places : </label>
            </td>
            <td>
                <input type="number" id="nbPlaces" name="nbPlaces" value="0" class="champ"/>
            </td>
        </tr>
    </table>
    <input type="submit" value="Valider" class="bouton"/>
</form> 
<?php
}else if(empty($_POST['vildepart']) && !empty($_POST['vilarr']) && !empty($_POST['dateDep']) && !empty($_POST['hDep']) && !empty($_POST['nbPlaces'])){ 
    if($_POST['nbPlaces'] == 0){ ?>
        <p>Le nombre de places ne peut pas être égale à 0</p>
        <p><a href="index.php?page=9">Retour au formulaire</a></p>
<?php
    }else{
        $parcourManager = new ParcoursManager($pdo);
        $parcoursEtSens = $parcourManager->getParcoursEtSensAvecVilles($_SESSION['vildepart'], $_POST['vilarr']);
        $propose = new Propose(array('per_num' => $_SESSION['per_num'],
                                        'par_num' => $parcoursEtSens['parcours'],
                                        'pro_date' => getEnglishDate($_POST['dateDep']),
                                        'pro_time' => $_POST['hDep'],
                                        'pro_place' => $_POST['nbPlaces'],
                                        'pro_sens' => $parcoursEtSens['sens']));
        $proposeManager = new ProposeManager($pdo);
        $retour=$proposeManager->add($propose);
        if($retour != 0){ ?>
            <p>Proposition ajouter</p>
<?php   }else{ ?>
            <p>Erreur lors de l'insertion.</p>
<?php   }
    }?>
<?php
}else if(empty($_POST['nbPlaces'])){ ?>
    <p>Le nombre de places ne peut pas être égale à 0</p>
    <p><a href="index.php?page=9">Retour au formulaire</a></p>
<?php
}
?>    
