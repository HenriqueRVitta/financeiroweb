<?php

session_start();

require_once("../../../includes/conn.php");
require_once("../../../includes/db.php");


    
/**
* Executa a consulta no banco de dados.
*/

$DataDia = date('Y-m-d')." 00:00:00";

$sql = $db_main->query("Select id,nome FROM usuarios WHERE id <> " . $_SESSION['idusuario'] . " and email = '" . $_POST['email'] . "'");

$dados = $sql->fetch(PDO::FETCH_OBJ);

if(!empty($dados->id)) {	

	echo "<script>document.getElementById('validaemail').hidden = false;</script>";
    echo 'E-mail ja possui cadastro...';
   	//echo "<script>document.getElementById('email').value ='';</script>";
    
}
