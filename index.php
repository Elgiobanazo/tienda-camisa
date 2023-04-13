<?php
    session_start();
    // CONTROLADOR FRONTAL
    require_once 'autoload.php';
    require_once 'config/parameters.php';
    require_once 'config/db.php';
    require_once 'helpers/Utils.php';
    require_once 'views/layouts/header.php';
    require_once 'views/layouts/sidebar.php';

    if(isset($_GET['controller'])){
        $controller_name = $_GET['controller'].'controller';
    }else if(!isset($_GET['controller']) && !isset($_GET['action'])){
        $controller_name = controller_default;
    }else{
        echo 'La pagina no existe';
        die();
    }

    if(class_exists($controller_name)){
        $controller = new $controller_name();

        if(isset($_GET['action']) && method_exists($controller, $_GET['action'])){
            $action = $_GET['action'];
            $controller->$action();

        }elseif(!isset($_GET['controller']) && !isset($_GET['action'])){
            $action_default = action_default;
            $controller->$action_default();
        }else{
            echo 'La pagina no existe';
        }
    }else{
        echo 'La pagina no existe';
    }

    require_once 'views/layouts/footer.php'; 
?>
