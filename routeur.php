<?php

include "library/initialisation.php";





$action = empty($_GET["action"]) ? null : $_GET["action"] ;
$class = empty($_GET["class"]) ? null : $_GET["class"];

if ( !$action == null){

    

    $file = "action/action_$action.php";

    if( ! file_exists($file)){

        echo "fichier $file non trouvé";
    }
    include_once "action/_action.php";
    include_once ($file);

    if( ! file_exists("data/data_$class.php")){

        echo "fichier data/data_$class.php non trouvé";
    }
    include_once "library/_model.php";
    include_once "data/data_$class.php";

    if( ! class_exists($class)){

        echo "class $class non trouvée";
    }
    if( ! class_exists($action)){

        echo "class $action non trouvée";
    }

    $action = new $action;
    $action->execute($class);
    
  
}else {
    
}
