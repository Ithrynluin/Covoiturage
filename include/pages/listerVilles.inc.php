<h1>Liste des villes</h1>
<?php
$pdo=new Mypdo();
$listeVilles=new VilleManager(pdo);

$nb=count($listeVilles);
?>
<p>Actuellement	villes <?php echo $nb ?>sont enregistrées</p>
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
			echo $value.getVilNum();
			?>
		</td>
		<td>
			<?php
			echo $value.getVilNom();
			?>
		</td>
		</tr>
		<?php
	}
	?>
</table>