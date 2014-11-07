<?php
    require_once("include/functions.inc.php");
    setPagePrecedente("http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ); 
	$_SESSION['utilisateur'] = "";
    header("Location: ".getPagePrecedente("http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ));
?>
