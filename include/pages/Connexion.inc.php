<h1>Pour vous connecter</h1>
<?php 
if(empty($_POST['user']) || empty($_POST['pass']) || empty($_POST['resultat'])){
?>
<form action="index.php?page=11" method="post">
	<p>
		<label fo="user">Nom d'utilisateur : </label>
		<input type="text" id="user" name="user" class="champ"/>
	</p>
	<p>
		<label for="pass">Mot de passe : </label>
		<input type="password" id="pass" name="pass" class="champ"/>
	</p>
	<p>
		<?php
        $nb1 = rand(1, 9);
        $nb2 = rand(1, 9);
        $_SESSION['nb1'] = $nb1;
        $_SESSION['nb2'] = $nb2;
		?>
		<label for="resultat"><img src=<?php echo '"image/nb/'.$nb1.'.jpg""' ?> /> + <img src=<?php echo '"image/nb/'.$nb2.'.jpg""' ?> /> = </label>
		<input type="text" id="resultat" name="resultat" class="champ"/>
	</p>
	<p>
		<input type="submit" value="Valider" class="bouton"/>
	</p>
</form>
<?php 
}else if(!empty($_POST['user']) || !empty($_POST['pass']) || !empty($_POST['resultat'])){
    
    $bonneRep = $_SESSION['nb1'] + $_SESSION['nb2'];
    if($bonneRep != $_POST['resultat']){ ?>
        <p>La réponse n'est corecte</p>
        <p><a href="index.php?page=11">Retour connexion</a></p>
<?php
    }else{
        $pdo = new Mypdo();
        $personneManager = new PersonneManager($pdo);
        $personne = $personneManager->getPersonneLogin($_POST['user']);
    
        if(!$personne){?>
        <p>
    	   Le nom d'utilisateur est invalide
        </p>
        <p>
    	   <a href="index.php?page=11">Retour connexion</a>
        </p>
<?php
        }else{
            $pwd = $_POST['pass'];
            $pwd = sha1($pwd.SALT);
            if($pwd != $personne->getPer_pwd()){ ?>
                <p>Le nom de la personne et/ou le mot de passe sont incorrecte</p>
                <p><a href="index.php?page=11">Retour connexion</a></p>
<?php       }else{ 
                $_SESSION['utilisateur'] = $_POST['user']; ?>
                <p>Connexion effectué</p>
<?php       }
            
        }
    
    }
    
}
?>
