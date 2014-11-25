<?php
$pdo=new Mypdo();
$personneManager=new PersonneManager($pdo);
$listePersonnes=$personneManager->getAllPersonne();
$nb=count($listePersonnes);


if(!empty($_GET['num'])) {
	if($personneManager->isEtudiant($_GET['num'])) {
	?>
	<h1>Détail sur l'étudiant <?php echo $personneManager->getPersonneNum($_GET['num'])->getPer_nom() ?></h1>
	<table>
		<tr>
			<th>Prénom</th>
			<th>Mail</th>
			<th>Tel</th>
			<th>Département</th>
			<th>Ville</th>
		</tr>
		<tr>
			<td>
				<?php echo $personneManager->getPersonneNum($_GET['num'])->getPer_prenom() ?>
			</td>
			<td>
				<?php echo $personneManager->getPersonneNum($_GET['num'])->getPer_mail() ?>
			</td>
			<td>
				<?php echo $personneManager->getPersonneNum($_GET['num'])->getPer_tel() ?>
			</td>
			<td>
				<?php
				$departementManager = new DepartementManager($pdo);
				$etudiantManager = new EtudiantManager($pdo);
				echo $departementManager->getDepartement($etudiantManager->getEtudiantNum($_GET['num'])->getDep_num())->getDep_nom()
				?>
			</td>
			<td>
				<?php
				$villeManager = new VilleManager($pdo);
				echo $villeManager->getVille($departementManager->getDepartement($etudiantManager->getEtudiantNum($_GET['num'])->getDep_num())->getVil_num())->getVilNom();
				?>
			</td>
		</tr>
	</table>
	<?php
	} else {
		?>
		<h1>Détail sur le salarié <?php echo $personneManager->getPersonneNum($_GET['num'])->getPer_nom() ?></h1>
		<table>
			<tr>
				<th>Prénom</th>
				<th>Mail</th>
				<th>Tel</th>
				<th>Tel pro</th>
				<th>Fonction</th>
			</tr>
			<tr>
				<td>
					<?php echo $personneManager->getPersonneNum($_GET['num'])->getPer_prenom() ?>
				</td>
				<td>
					<?php echo $personneManager->getPersonneNum($_GET['num'])->getPer_mail() ?>
				</td>
				<td>
					<?php echo $personneManager->getPersonneNum($_GET['num'])->getPer_tel() ?>
				</td>
				<td>
					<?php
					$salarieManager = new SalarieManager($pdo);
					echo $salarieManager->getSalarieNum($_GET['num'])->getSal_telprof();
					?>
				</td>
				<td>
					<?php
					$fonctionManager = new FonctionManager($pdo);
					echo $fonctionManager->getFonction($salarieManager->getSalarieNum($_GET['num'])->getFon_num())->getFon_libelle();
					?>
				</td>
			</tr>
		</table>
		<?php
	}
} else {
?>
<h1>Liste des personnes enregistrées</h1>
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
			<a href="index.php?page=2&num=<?php echo $value->getPer_num() ?>">
			<?php
			echo $value->getPer_num();
			?></a>
		</td>
		<td>
			<?php
			echo $value->getPer_nom();
			?>
		</td>
		<td>
			<?php
			echo $value->getPer_prenom();
			?>
		</td>
	</tr>
	<?php
	}
	?>
</table>
<?php
} ?>