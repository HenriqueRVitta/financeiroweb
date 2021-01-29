<?php
@ob_start();
@session_start();

@header('Content-Type: text/html; charset=utf-8');

if(!isset($_SESSION['idusuario'])){
    echo "<script>alert(\"Você precisa estar logado!\"); window.location = '/financeiro/login.php';</script>";
    exit;
}else{
    /***
     *
     * Constantes de configurações do sistema
     *
     */

    // Constante para root do sistema.
    define("rootPath", "/");

    // Constante para ano de início do sistema.
    define("YEAR_INIT", "2014");
    
    // Constante para data de corte 1
    define("DT_CORTE_1_INICIO", "2016-04-27");
    define("DT_CORTE_1_FIM", "2016-05-26");

    $nome_sistema = "moses";

    $teste = "0";

    if($teste === "1"){
        ini_set('display_errors',1);
        ini_set('display_startup_erros',1);
        error_reporting(E_ALL);
    }

    // Arquivos de conexão
    require_once($_SERVER['DOCUMENT_ROOT']."/includes/conn.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/class/conn_db/class.db.php");

    if(isset($_GET['type'])){
        $type = $_GET['type'];
    }
    if(isset($_POST['type'])){
        $type = $_POST['type'];
    }
    if(isset($_GET['typeValue'])){
        $typeValue = $_GET['typeValue'];
    }
    if(isset($_POST['typeValue'])){
        $typeValue = $_POST['typeValue'];
    }

    //Verificando permissões
    $sqlPermissoes = $db_main->query("SELECT * FROM funcionario WHERE matricula = '" . $_SESSION["matricula"] . "'");

    while($dadosPermissoes = $sqlPermissoes->fetch(PDO::FETCH_OBJ)){
        unset($_SESSION['permissaoMenu']);
        unset($_SESSION['permissaoModulos']);
        unset($_SESSION['permissaoActions']);
        unset($_SESSION['adm']);

        $_SESSION['permissaoMenu'] = json_decode($dadosPermissoes->permissaoMenu);
        $_SESSION['permissaoModulos'] = json_decode($dadosPermissoes->permissaoModulos);
        $_SESSION['permissaoActions'] = json_decode($dadosPermissoes->permissaoActions);
        $_SESSION['adm'] = $dadosPermissoes->adm;
    }
}

require_once($_SERVER['DOCUMENT_ROOT']."/includes/includes.php");
?>