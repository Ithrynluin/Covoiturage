<?php
$pdo = new Mypdo();

if(empty($_POST['nom']) || empty($_POST['tel']) || empty($_POST['prenom']) || empty($_POST['mail']) || empty($_POST['login']) || empty($_POST['mdp']) || empty($_POST['type'])){
	//Vérification que les données ont bien été complètement rempli dans chaque formulaire (seul la zone du téléphone professionnel peut être vide après le 1er formulaire)
	if(empty($_POST['telpro']) && empty($_POST['annee'])) { ?>
		<h1>Ajouter une personne</h1> <!-- titre de la page -->
		
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
		    	<input type="radio" name="type" value="etudiant" />Etudiant
		    	<input type="radio" name="type" value="personnel" />Personnel
		    </p>
		    
		    <input type="submit" value="Valider" class="bouton"/>
		</form>
	
	<?php
	//ajout des données dans la base de données (après avoir rempli tous les formulaires)
	} else {
		//ajout dans la table personne
		$personneManager = new PersonneManager($pdo);
        $existe = $personneManager->getPersonneLogin($_SESSION['pers']->getPer_login());
        if(!$existe){
        	$retour = $personneManager->add($_SESSION['pers']);
        	if($retour == 0){?>
          		<p>Erreur : La personne <?php echo $_POST['nom']; ?> n'a pas été ajoutée.</p>
    		<?php } else {
    			$perNum= $retour;
    			
    			//ajout dans la table étudiant
    			if(!empty($_POST['annee']) && !empty($_POST['departement'])) { ?>
    				<h1>Ajouter un étudiant</h1> <!-- titre de la page -->
    				
    				<?php
    				$etudiant = new Etudiant(array('per_num' => $perNum,'dep_num' => $_POST['departement'], 'div_num' => $_POST['annee']));
    				$etudiantManager = new EtudiantManager($pdo);
    				$retour = $etudiantManager->add($etudiant);
    				if($retour == 0) { ?>
    					<p>Erreur ! L'étudiant n'a pas été ajouté</p>
    				<?php } else { ?>
    					<p>L'étudiant a bien été ajouté</p>
    				<?php }
    		 	}
    		 	
    			//ajout dans la table salrié
    			if(!empty($_POST['telpro']) && !empty($_POST['fonction'])) { ?>
    				<h1>Ajouter un salarié</h1> <!-- titre de la page -->
    				
    				<?php
    				$salarie = new Salarie(array('per_num' => $perNum,'sal_telprof' => $_POST['telpro'], 'fon_num' => $_POST['fonction']));
    				$salarieManager = new SalarieManager($pdo);
    				$retour = $salarieManager->add($salarie);
    				if($retour == 0) { ?>
    					<p>Erreur ! Le salarié n'a pas été ajouté</p>
    				<?php } else { ?>
    					<p>Le salarié a bien été ajouté</p>
    				<?php }
    			}
    	    }
		}else{ ?>
		    <p>Il existe déjà une personne avec se login.</p>
		    <a href="index.php?page=1" >Retour au formulaire</a>
<?php   }
	}
}else{
	$_SESSION['pers'] = new Personne(array('per_nom' => $_POST['nom'], 'per_prenom' => $_POST['prenom'], 'per_tel' => $_POST['tel'], 'per_mail' => $_POST['mail'], 'per_login' => $_POST['login'], 'per_pwd' => sha1($_POST['mdp'].SALT))); 
	       	
	        //Si la perssonne = etudiant
	        if($_POST['type'] == "etudiant") { ?>
	        	<h1>Ajouter un étudiant</h1> <!-- titre de la page -->
	       		
	       		<?php
	       		$divisionManager = new DivisionManager($pdo);
				$departementManager = new DepartementManager($pdo);
	        	?>
	        	
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
	            					$ville=$villeManager->getVille($villeNum); ?>
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
	       	if($_POST['type'] == "personnel") { ?>
	       		<h1>Ajouter un salarié</h1> <!-- titre de la page -->
				 
				<?php
	       		$fonctionManager = new FonctionManager($pdo);
	       		?>
	       		
	       		<form action="index.php?page=1" method="post">
	       			<table>
	       				<tr>
	       					<td><label for="telpro">Téléphone professionnel: </label></td>
	    					<td><input type="text" id="telpro" name="telpro" class="champ"/></td>
	       				</tr>
	       				<tr>
	       					<td><label for='fonction'>Fonction : </label></td>
	       					<td>
	       						<select name="fonction" id="fonction" class="champ">
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
<?php 
			}
} ?>