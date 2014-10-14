<?php
    function __autoload($class){
        $rep="classes/";
        require($rep.$class.".inc.php");
    }
?>