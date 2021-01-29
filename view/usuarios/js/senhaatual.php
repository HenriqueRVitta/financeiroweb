<?php

session_start();

require_once("../../../includes/conn.php");
require_once("../../../includes/db.php");


    
/**
* Executa a consulta no banco de dados.
*/

$senha = md5($_POST['senha']);

$DataDia = date('Y-m-d')." 00:00:00";

$sql = $db_main->query("Select id,nome FROM usuarios WHERE id = '" . $_SESSION['idusuario'] . "'" . " and senha = '". $senha . "'");

$dados = $sql->fetch(PDO::FETCH_OBJ);

if(empty($dados->id)) {	

	echo "<script>document.getElementById('validasenha').hidden = false;</script>";
    echo 'Senha atual incorreta...';
   	//echo "<script>document.getElementById('senhaatual').value ='';</script>";
    
}
