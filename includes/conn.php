<?php
date_default_timezone_set('America/Sao_Paulo');

$dbhost     = "localhost";
$dbname     = "hrvinfor_adm";
$dbuser     = "root";
$dbpass     = "vitta";
$dbname_main = "hrvinfor_adm";


// database connection
try {
    $db = new PDO(
        "mysql:host=$dbhost;port=3306;dbname=$dbname",
        $dbuser,
        $dbpass,
        array(
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
        )
    );
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

    $db_main = new PDO(
        "mysql:host=$dbhost;port=3306;dbname=$dbname",
        $dbuser,
        $dbpass,
        array(
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
        )
    );
    $db_main->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
}

catch(PDOException $e) {
    echo "Erro de Conexão: ".$e->getMessage();
}
