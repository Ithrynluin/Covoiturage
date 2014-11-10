    <h1>Ajouter un parcours</h1>
<?php 
$pdo = new Mypdo();
$villeManager = new VilleManager($pdo);
$parcoursManager = new ParcoursManager($pdo);
if(empty($_POST['vil1']) || empty($_POST['vil2']) || empty($_POST['km'])){ ?>
    <form action="index.php?page=5" method="post">
        <p>
            <label for="vil1">Ville 1 :</label>
            <select name="vil1" id="vil1" class="champ">
<?php       $listVille = $villeManager->getAllVilles();
            foreach ($listVille as $key => $value) { ?>
                <option value=<?php echo "'".$value->getVilNum()."'"; ?>><?php echo $value->getVilNom(); ?></option>
<?php       } ?>        
            </select>
            
            <label for="vil2">Ville 2 :</label>
            <select name="vil2" id="vil2" class="champ">
<?php       foreach ($listVille as $key => $value) { ?>
                <option value=<?php echo "'".$value->getVilNum()."'"; ?>><?php echo $value->getVilNom(); ?></option>
<?php       } ?>        
            </select>
            
            <label for="km">Nombre de Kilomètre(s)</label>
            <input type="text" id="km" name="km" class="champ"/>
        </p>
        
        <p>
            <input type="submit" value="Valider" class="bouton"/>
        </p>
    </form>    
<?php
}else if(!empty($_POST['vil1']) || !empty($_POST['vil2']) || !empty($_POST['km'])){
    $vil1 = $_POST['vil1'];
    $vil2 = $_POST['vil2'];
    $km = $_POST['km'];
    if(!ctype_digit($km)){ ?>
        <p>Erreur : Le nombre de kilomètre n'est pas un entier.</p>
        <p><a href="index.php?page=5">Retour au formulaire</a></p>
<?php
    }else if($parcoursManager->exist($vil1, $vil2)){ ?>
        <p>Le parcour existe déjà.</p>
        <p><a href="index.php?page=5">Retour au formulaire</a></p>
<?php
    }else{
        $parcours = new Parcours(array('par_km' => $_POST['km'], 'vil_num1' => $vil1, 'vil_num2' => $vil2));
        $ligne = $parcoursManager->add($parcours);
        if($ligne == 0 ){ ?>
        <p><img src="image/erreur.png" /> Erreur lors de l'insertion.</p>
<?php   }else{ ?>
        <p><img src="image/valid.png"/> Le parcours a été ajouté.</p>
<?php   }
    }
}?>