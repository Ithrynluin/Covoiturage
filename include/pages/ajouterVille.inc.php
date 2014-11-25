<h1>Ajouter une ville</h1>
<?php  
if(empty($_POST['nom'])){ ?>

<form action="index.php?page=7" method="post">
    <p>
        <label for="nom">Nom : </label>
        <input type="text" id="nom" name="nom" class="champ"/>
        <input type="submit" value="Envoyer" class="bouton"/>
    </p>
</form>
<?php
}else{
    $pdo = new Mypdo(); 
    $villeManager = new VilleManager($pdo);
    if(!empty($_POST['nom'])){
        if($villeManager->exist($_POST['nom'])){ ?>
            <p>Erreur la ville existe déjà</p>
<?php   }else{
            $ville = new Ville(array('vil_nom' => $_POST['nom']));
            $retour = $villeManager->add($ville);
            if($retour == 0){?>
                <p><img src="image/erreur.png" /> Erreur : La ville <?php echo $_POST['nom']; ?> n'a pas été ajoutée.</p>
<?php       }else{ ?>
                <p><img src="image/valid.png"/> La ville <strong>"<?php echo $_POST['nom']; ?>"</strong> a été ajoutée.</p>
<?php       }
        }
        
    }
} ?>