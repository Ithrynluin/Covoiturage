<h1>Supprimer des personnes enregistrées</h1>
<?php
$pdo = new Mypdo();
$personneManager = new PersonneManager($pdo);
$listePersonnes = $personneManager -> getAllPersonne();
if(empty($_POST['supp'])){ ?>
<form action="index.php?page=4" method="post">
	<table border=>
		<tr>
			<th>Numéro</th>
			<th>Nom</th>
			<th>Prénom</th>
			<th></th>
		</tr>
		<?php
        foreach ($listePersonnes as $value){
		?>
		<tr>
			<td><?php
            echo $value -> getPer_num();
		  ?></td>
			<td><?php
            echo $value -> getPer_nom();
		  ?></td>
			<td><?php
            echo $value -> getPer_prenom();
             ?></td>
		      <td>
		          <button name="supp" type="submit" class="bouton" value=<?php echo '"'.$value->getPer_num().'"'; ?>>Supprimer</button>
		      </td>
		</tr>
		<?php
        }
    ?>
	</table>
</form>
<?php
}else if(!empty($_POST['supp'])){
    $num = $_POST['supp'];
    if($personneManager->isEtudiant($num)){
        $etudiantManager = new EtudiantManager($pdo);
        $retour = $etudiantManager->delete($num);
    }else{
        $salarieManager = new SalarieManager($pdo);
        $retour = $salarieManager->delete($num);
    }
    
	if($retour != 0) {
		$parcoursManager = new ParcoursManager($pdo);
		$retour = $parcoursManager->delete($num);
	} else { ?>
        <p><img src="image/erreur.png" /> Erreur lors de la suppression de la personne (table étudiant/salarié)</p>
	<?php		
	}
	
    if($retour != 0){
        $retour = $personneManager->delete($num);
    }else{ ?>
        <p><img src="image/erreur.png" /> Erreur lors de la suppression de la personne (table propose)</p>
	<?php
    }
    
    if($retour != 0){
        header("Location: http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
    }else{ ?>
        <p><img src="image/erreur.png" /> Erreur lors de la suppression de la personne (table personne)</p>
<?php
    }
    
}
