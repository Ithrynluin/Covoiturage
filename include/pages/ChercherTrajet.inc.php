<h1>Rechercher un trajet</h1>
<?php 
$pdo = new Mypdo();
if(empty($_POST['vildepart']) && empty($_POST['vilarr']) && empty($_POST['depart']) && empty($_POST['precision']) && empty($_POST['heure'])){ ?>
    <form action="index.php?page=10" method="post">
        <p>
            <label for="vildepart"> Ville de départ : </label>
            <select id="vildepart" name="vildepart" class="champ">
<?php           
                $proposeManager = new ProposeManager($pdo);
                $listeVille = $proposeManager->getVilleDepartTrajet(); 
                foreach ($listeVille as $key => $value) { ?>
                    <option value=<?php echo '"'.$value->getVilNum().'"'; ?>><?php echo $value->getVilNom(); ?></option>  
<?php           } ?>
            </select>
            <input type="submit" value="Valider" class="bouton"/>
        </p>
    </form>
<?php
}else if(!empty($_POST['vildepart']) && empty($_POST['vilarr']) && empty($_POST['depart']) && empty($_POST['precision']) && empty($_POST['heure'])){ 
   $villeManager = new VilleManager($pdo);
   $villeDepart = $villeManager->getVille($_POST['vildepart']);
   $listeVilleArrive = $villeManager->getVilleParcoursArrive($_POST['vildepart']);
    $_SESSION['vildepart'] = $_POST['vildepart']; ?> 
   <form action="index.php?page=10" method="post">
       <table>
           <tr>
               <td>Ville de départ : </td>
               <td><?php echo $villeDepart->getVilNom(); ?></td>
               
               <td><label>Ville d'arrivée : <label></td>
               <td>
                   <select name="vilarr" class="champ">
<?php                   foreach ($listeVilleArrive as $value) { ?>
                        <option value=<?php echo $value->getVilNum() ?>><?php echo $value->getVilNom() ?></option>
<?php                   } ?>
                   </select>
                </td>
           </tr>
           <tr>
               <td><label>Date de départ :</label></td>
               <td> <input type="text" id="depart" name="depart" class="champ" value=<?php echo '"'.date("d/m/Y").'"'; ?>/></td>
               
               <td><label>Précision :</label></td>
               <td>
                   <select name="precision" class="champ">
                       <option value="0">Ce jour</option>
                       <option value="1">+/- 1 jour</option>
                       <option value="2">+/- 2 jour</option>
                       <option value="3">+/- 3 jour</option>
                   </select>
               </td>
           </tr>
           <tr>
               <td><label>A partir de :</label></td>
               <td>
                   <select name="heure" class="champ">
<?php                   for($i=0; $i < 24; $i++){ ?>
                            <option value=<?php echo '"'.$i.'"'; ?>><?php echo $i."h"; ?></option>
<?php                   }?>            
                   </select>
               </td>
           </tr>
       </table>
       <p>
           <input type="submit" value="Valider" class="bouton"/>
       </p>
   </form>
<?php    
}else if(empty($_POST['vildepart']) && !empty($_POST['vilarr']) && !empty($_POST['depart']) && isset($_POST['precision']) && isset($_POST['heure'])){
    $parcoursManager = new ParcoursManager($pdo);
    $parEtSens = $parcoursManager->getParcoursEtSensAvecVilles($_SESSION['vildepart'], $_POST['vilarr']);
    $dateDebut = addJours($_POST['depart'], -$_POST['precision']);
    $dateFin = addJours($_POST['depart'], $_POST['precision']);
    $heure = $_POST['heure'].":00:00";
    
    $proposeManager = new ProposeManager($pdo);
    $liste = $proposeManager->getTrajetWithParam($parEtSens['parcours'], $dateDebut, $dateFin, $heure, $parEtSens['sens']);
    
    $personneManager = new PersonneManager($pdo);
    
    if(empty($liste)){ ?>
    <p>Aucun trajet trouvé</p>    
<?php
    }else{
?>
    <table>
        <tr>
            <th>Ville de départ</th>
            <th>Ville d'arrivée</th>
            <th>Date de départ</th>
            <th>Heure de départ</th>
            <th>Nb place(s)</th>
            <th>Nom du covoitureur</th>
        </tr>
<?php   foreach ($liste as $value) { 
        $personne = $personneManager->getPersonneNum($value->getPer_num()); ?>
        <tr>
            <td><?php echo $_SESSION['vildepart']; ?></td>
            <td><?php echo $_POST['vilarr']; ?></td>
            <td><?php echo getFrenchDate($value->getPro_date()); ?></td>
            <td><?php echo $value->getPro_time(); ?></td>
            <td><?php echo $value->getPro_place(); ?></td>
            <td><?php echo $personne->getPer_nom(); ?></td>
        </tr>
<?php
        } ?>
    </table>
<?php
    }
} ?>
