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
        //Si la perssonne = etudiant
        $divisionManager = new DivisionManager($pdo);
		$departementManager = new DepartementManager($pdo);
        if(!empty($_POST['etudiant'])) { ?>
        	<form action="index.php?page=1" method="post">
        		<table>
        			<tr>
        				<td><label for='annee'>Année : </label></td>
        				<td>
        					<select name="annee" id="annnee" class="champ">
							<?php $listDivision = $divisionManager->getAllDivisions();
            				foreach ($listDivision as $key => $value) { ?>
                			<option value=<?php echo "'".$value->getDiv_num()."'"; ?>><?php echo $value->getDiv_nom(); ?></option>
							<?php } ?>        
            				</select>
        				</td>
        			</tr>
        			<tr>
        				<td><label for='departement'>Département : </label></td>
        				<td>
        					<select name="departement" id="departement" class="champ">
							<?php $listDepartement = $departementManager->getAllDepartements();
							$villeManager = new VilleManager($pdo);
            				foreach ($listDepartement as $key => $value) { 
            					$villeNum = $value->getVil_num();
            					$ville=$villeManager->getVille($villeNum);?>
                				<option value=<?php echo "'".$value->getDep_num()."'"; ?>><?php echo $value->getDep_nom()." (".$ville->getVilNom().")"; ?></option>
							<?php } ?>        
            				</select>
        				</td>
        			</tr>
        		</table>
            	
            	<input type="submit" value="Valider" class="bouton"/>
        	</form>
       <?php }
        
        //Si la personne = salarie
        $fonctionManager = new FonctionManager($pdo);
       	if(!empty($_POST['personnel'])) { ?>
       		<form action="index.php?page=1" method="post">
       			<table>
       				<tr>
       					<td><label for="tel">Téléphone : </label></td>
    					<td><input type="text" id="tel" name="tel" class="champ"/></td>
       				</tr>
       				<tr>
       					<td><label for='fonction'>Fonction : </label></td>
       					<td>
       						<select name="fonction" id="focntion" class="champ">
								<?php $listeFonctions = $fonctionManager->getAllFonctions();
            					foreach ($listeFonctions as $key => $value) { ?>
                					<option value=<?php echo "'".$value->getFon_num()."'"; ?>><?php echo $value->getFon_libelle() ?></option>
								<?php } ?>
       						</select>
       					</td>
       				</tr>
       			</table>
       			
       			<input type="submit" value="Valider" class="bouton"/>
       		</form>
       	<?php }
		/*
        $pers = new Personne(array('per_nom' => $_POST['nom'], 'per_prenom' => $_POST['prenom'], 'per_tel' => $_POST['tel'], 'per_mail' => $_POST['mail'], 'per_login' => $_POST['login'], 'per_pwd' => $_POST['mdp']));
        $retour = $personneManager->add($pers);
        if($retour == 0){?>
            <p>Erreur : La personne <?php echo $_POST['nom']; ?> n'a pas été ajoutée.</p>
<?php   }else{ ?>
            <p>La personne <strong>"<?php echo $_POST['nom']; ?>"</strong> a été ajoutée.</p>
<?php }*/
    }
} ?>