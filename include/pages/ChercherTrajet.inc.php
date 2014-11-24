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
               
               <td><label>Ville d'arrivée : <label>+</td>
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
               <td> <input type="date" id="depart" name="depart" class="champ" value=<?php echo '"'.date("d/m/Y").'"'; ?>/></td>
               
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
    
    $proposeManager = new ProposeManager($pdo);
    $liste = $proposeManager->getTrajetWithParam($parEtSens['parcours'], $dateDebut, $dateFin, $_POST['heure'], $parEtSens['sens']);
    echo "<pre>";var_dump($liste);echo "</pre>";
} ?>
