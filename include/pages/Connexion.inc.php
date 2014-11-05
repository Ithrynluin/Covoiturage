<h1>Pour vous connecter</h1>
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
?>
        <label for="resultat"><img src=<?php echo '"image/nb/'.$nb1.'.jpg""' ?> /> + <img src=<?php echo '"image/nb/'.$nb2.'.jpg""' ?> /> = </label>
        <input type="text" id="resultat" name="resultat" class="champ"/>
    </p>
    <p>
        <input type="button" value="Valider" class="bouton"/>
    </p>
</form>
