<h1>Modifier des personnes enregistrées</h1>
<?php
$pdo = new Mypdo();
$personneManager = new PersonneManager($pdo);
$listePersonnes = $personneManager -> getAllPersonne();
if(empty($_POST['mod']) && empty($_POST['nom']) && empty($_POST['tel']) && empty($_POST['prenom']) 
    && empty($_POST['mail']) && empty($_POST['login']) && empty($_POST['mdpNew']) && empty($_POST['mdpConf'])
    && empty($_POST['mdp'])){ ?>
<form action="index.php?page=3" method="post">
    <table>
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
                  <button name="mod" type="submit" class="bouton" value=<?php echo '"'.$value->getPer_num().'"'; ?>>Modifier</button>
              </td>
        </tr>
        <?php
        }
    ?>
    </table>
</form>
<?php
}else if(!empty($_POST['mod']) && empty($_POST['nom']) && empty($_POST['tel']) && empty($_POST['prenom']) 
    && empty($_POST['mail']) && empty($_POST['login']) && empty($_POST['mdpNew']) && empty($_POST['mdpConf'])
    && empty($_POST['mdp'])){
    $personne = $personneManager->getPersonneNum($_POST['mod']);
    $_SESSION['mod'] = $_POST['mod']; ?>
    <form action="index.php?page=3" method="post">
        <p>
            <label for="nom">Nom* :</label>
            <input type="text" id="nom" name="nom" class="champ" value=<?php echo '"'.$personne->getPer_nom().'"'; ?> />
        </p>
        <p>
            <label for="nom">Prénom* :</label>
            <input type="text" id="prenom" name="prenom" class="champ" value=<?php echo '"'.$personne->getPer_prenom().'"'; ?> />
        </p>
        <p>
            <label for="tel">Téléphone* : </label>
            <input type="text" id="tel" name="tel" class="champ" value=<?php echo '"'.$personne->getPer_tel().'"'; ?>/>
        </p>
        <p>
            <label for="mail">Mail* : </label>
            <input type="text" id="mail" name="mail" class="champ" value=<?php echo '"'.$personne->getPer_mail().'"'; ?>/>
        </p>
        <p>
            <label for="login">Login* : </label>
            <input type="text" id="login" name="login" class="champ" value=<?php echo '"'.$personne->getPer_login().'"'; ?>/>
        </p>
        <p>
            <label for="mdpNew">Nouveau mot de passe : </label>
            <input type="password" id="mdpNew" name="mdpNew" class="champ"/>
        </p>
        <p>
            <label for="mdpConf">Confirmer mot de passe : </label>
            <input type="password" id="mdpConf" name="mdpConf" class="champ"/>
        </p>
        <p>
            <label for="mdp">Mot de passe actuel* : </label>
            <input type="password" id="mdp" name="mdp" class="champ"/>
        </p>
        <p>
            <input type="submit" value="Valider" class="bouton"/>
        </p>       
    </form>
<?php    
}else if(empty($_POST['mod']) && !empty($_POST['nom']) && !empty($_POST['tel']) && !empty($_POST['prenom']) 
    && !empty($_POST['mail']) && !empty($_POST['login']) && !empty($_POST['mdp'])){
         
    $personne = $personneManager->getPersonneNum($_SESSION['mod']);
    $pwd = $_POST['mdp'];
    $pwd = sha1($pwd.SALT);
    if($pwd != $personne->getPer_pwd()){ ?>
        <p>Le mot de passe est incorrecte</p>
        <p><a href="index.php?page=3">Retour modification</a></p>
<?php
    }else{
        $r = $personneManager->getPersonneLogin($_POST['login']);   
        if($_POST['mdpNew'] != $_POST['mdpConf']){ ?>
            <p>Le mot de passe de confirmation ne correspond pas au nouveau mot de passe.</p>
            <p><a href="index.php?page=3">Retour modification</a></p>
<?php   }else if(($_POST['login'] != $personne->getPer_login() && !$r) || $_POST['login' ] == $personne->getPer_login()){
            if(empty($_POST['mdpNew'])){
                $mdp = sha1($_POST['mdp'].SALT);
            }else{
                $mdp = sha1($_POST['mdpNew'].SALT);
            }
            $personne = new Personne(array(
                 'per_nom' => $_POST['nom'], 
                 'per_prenom' => $_POST['prenom'], 'per_tel' => $_POST['tel'], 
                 'per_mail' => $_POST['mail'], 'per_login' => $_POST['login'], 
                 'per_pwd' => $mdp, "per_num" => $_SESSION['mod']));
            $retour = $personneManager->update($personne);
                 
            if($retour == 0){ ?>
                 <p>Erreur lors de la mise à jour.</p>
                 <p><a href="index.php?page=3">Retour modification</a></p>
<?php        }else{ ?>
                <p>La mise a bien été effectué</p>
<?php        }
        }else{ ?>
            <p>Il existe déjà une personne avec se login.</p>
            <a href="index.php?page=3" >Retour au formulaire</a>
<?php   }
    }
}else{ ?>
    <p>Tous les champs obligatoire ne sont pas rempli</p>
<?php
} ?>
