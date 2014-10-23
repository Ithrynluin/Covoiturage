    <h1>Liste des parcours proposés</h1>
<?php
$db = new Mypdo();
$parcoursManager = new ParcoursManager($db);
$listPar = $parcoursManager->getAllParcours();
$nb = count($listPar);

$villeManager = new VilleManager($db);
?>
    <p>Actuellement <?php echo $nb ?> parcours sont enregistrés</p>
    
    <table>
        <tr>
            <th>Numéro</th>
            <th>Nom cille</th>
            <th>Nom ville</th>
            <th>Nombre de Km</th>
        </tr>
<?php
    foreach ($listPar as $key => $value) { 
        $vil1 = $villeManager->getVille($value->getVil_num1());
        $vil2 = $villeManager->getVille($value->getVil_num2()); ?>
        <tr>
            <td><?php echo $value->getPar_num(); ?></td>
            <td><?php echo $vil1->getVilNom(); ?></td>
            <td><?php echo $vil2->getVilNom(); ?></td>
            <td><?php echo $value->getPar_km(); ?></td>
        </tr>
<?php
    } ?>

    </table>