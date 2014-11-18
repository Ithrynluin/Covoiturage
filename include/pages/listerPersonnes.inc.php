<h1>Liste des personnes enregistrées</h1>
<?php
$pdo=new Mypdo();
$personneManager=new PersonneManager($pdo);
$listePersonnes=$personneManager->getAllPersonne();

$nb=count($listePersonnes);
?>
<p>Actuellement <?php echo $nb ?> personnes enregistrées</p>

<table>
	<tr>
		<th>Numéro</th>
		<th>Nom</th>
		<th>Prénom</th>
	</tr>
	<?php
	foreach ($listePersonnes as $value) {
	?>
	<tr>
		<td>
			<?php
			if($personneManager->isEtudiant($value->getPer_num())) {
				echo $value->getPer_num()." ok ";
			} else {
				echo $value->getPer_num();
			}
			?>
		</td>
		<td>
			<?php
			echo $value->getPer_prenom();
			?>
		</td>
		<td>
			<?php
			echo $value->getPer_nom();
			?>
		</td>
	</tr>
	<?php
	}
	?>
</table>