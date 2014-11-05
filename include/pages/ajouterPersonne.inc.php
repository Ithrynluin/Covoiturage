<h1>Ajouter une personne</h1>
<?php  
if(empty($_POST['nom']) || empty($_POST['tel']) || empty($_POST['prenom']) || empty($_POST['mail']) || empty($_POST['login']) || empty($_POST['mdp'])){ ?>
<form action="index.php?page=1" method="post">
    <table>
    	<tr>
    		<td><label for="nom">Nom : </label></td>
    		<td><input type="text" id="nom" name="nom" class="champ"/></td>
    		<td><label for="prenom">Prenom : </label></td>
    		<td><input type="text" id="prenom" name="prenom" class="champ"/></td>
    	</tr>
    	<tr>
    		<td><label for="tel">Téléphone : </label></td>
    		<td><input type="text" id="tel" name="tel" class="champ"/></td>
    		<td><label for="mail">Mail : </label></td>
    		<td><input type="email" id="mail" name="mail" class="champ"/></td>
    	</tr>
    	<tr>
    		<td><label for="login">Login : </label></td>
    		<td><input type="text" id="login" name="login" class="champ"/></td>
    		<td><label for="mdp">Mot de passe : </label></td>
    		<td><input type="password" id="mdp" name="mdp" class="champ"/></td>
    	</tr>
    </table>
    <p>
    	<label for="categorie">Catégorie : </label>
    	<input type="radio" name="etudiant" value="etudiant" />Etudiant
    	<input type="radio" name="personnel" value="personnel" />Personnel
    </p>
    
    <input type="submit" value="Valider" class="bouton"/>
</form>
<?php
}else{
    $pdo = new Mypdo(); 
    $personneManager = new PersonneManager($pdo);
    if(!empty($_POST['nom']) && !empty($_POST['tel']) && !empty($_POST['prenom']) & !empty($_POST['mail']) && !empty($_POST['login']) && !empty($_POST['mdp'])){
        $pers = new Personne(array('per_nom' => $_POST['nom'], 'per_prenom' => $_POST['prenom'], 'per_tel' => $_POST['tel'], 'per_mail' => $_POST['mail'], 'per_login' => $_POST['login'], 'per_pwd' => $_POST['mdp']));
		//faire de meme avec les autres variables
        $retour = $personneManager->add($pers);
        if($retour == 0){?>
            <p>Erreur : La personne <?php echo $_POST['nom']; ?> n'a pas été ajoutée.</p>
<?php   }else{ ?>
            <p>La personne <strong>"<?php echo $_POST['nom']; ?>"</strong> a été ajoutée.</p>
<?php   }
    }
} ?>