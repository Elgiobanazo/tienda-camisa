<?php 
    function controllersAutoload($class){
        return include "controllers/$class.php";
    }

    spl_autoload_register('controllersAutoload');

?>