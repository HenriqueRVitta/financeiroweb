<?php
require_once($_SERVER['DOCUMENT_ROOT']."/includes/funcoes.php");

/*
 *
 * INIT Autoload Classes
 *
 */

function __autoload($class_name){

    $url_class = explode("_", $class_name);

    $file = "/classes/" . $url_class[0] . "/" . $url_class[1] . ".php";

    require_once($_SERVER['DOCUMENT_ROOT'] . $file);

}

/*
 *
 * INIT Functions
 *
 */

$arr_functions = array(
    'vt',
    'alimentacao',
    'alojado'
);

foreach($arr_functions as $load_functions){
    require_once($_SERVER['DOCUMENT_ROOT']."/functions/".$load_functions.".php");
}

require_once($_SERVER['DOCUMENT_ROOT']."/includes/header.php");
require_once($_SERVER['DOCUMENT_ROOT']."/includes/scripts.php");