<h1>Liste des villes</h1>
<?php
$pdo=new Mypdo();
$villeManager=new VilleManager($pdo);
$listeVilles=$villeManager->getAllVilles();

$nb=count($listeVilles);
?>
<p>Actuellement	<?php echo $nb ?> villes sont enregistrées</p>
<table>
	<tr>
		<th>Numéro</th>
		<th>Nom</th>
	</tr>
	<?php
	foreach ($listeVilles as $value) {
		?>
		<tr>
		<td>
			<?php
			echo $value->getVilNum();
			?>
		</td>
		<td>
			<?php
			echo $value->getVilNom();
			?>
		</td>
		</tr>
		<?php
	}
	?>
</table>