<?php 

/*
ini_set( 'display_errors', 0 );
error_reporting( E_ALL );
*/

session_start();

require_once("../includes/conn.php");
require_once("../includes/db.php");

	// Delete
	if(isset($_POST['idcontasreceberdelete'])) {
		$sql = $db_main->query("delete from contasreceber where id = '".$_POST['idcontasreceberdelete']."'");
		header('Location: ../view/contasreceber/index.php');
		die();
	}


	// Update
	if(isset($_POST['idcontasreceberedit']) && $_POST['idcontasreceberedit'] > 0) {
	
		
		if(!empty($_POST['datapagto'])) { $datapagto = $_POST['datapagto']; } else { $datapagto = "";}
		$datainclusao = date('Y-m-d H:i:s');
		$datavencto = $_POST['datavencto']." 00:00:00";
		$datapagto = $_POST['datapagto']." 00:00:00";

		$valor = $_POST['valor'];
		
		if( strpos($valor, '.')) {
			$valor = $_POST['valor'];
		} else {
			$valor = $_POST['valor'].".00";
		}
		
		if( strpos($valor, ',')) {
			$valor = number_format($valor, 2, ',', '.');	
		}
		
		try {
			
			$insert = array(
			    "datavencto" => $datavencto,
				"cliente" => $_POST['cliente'],
				"historico" => $_POST['historico'],
				"datapagto" => $datapagto,	
				"valor" => $valor,
				"nrodocumento" => $_POST['nrodocumento'],
				"formapagto" => $_POST['formapagto'],		
				"datainclusao" => $datainclusao,
				"usuarioinclusao" => $_SESSION['idusuario'],		
				"unidade" => $_SESSION['idempresa']
			);
			
			$Where = 'id = '.$_POST['idcontasreceberedit'];
			
			$pdo = new conexao_db();
			$pdo->update("contasreceber", $insert, $Where);
			$pdo = null;
			
		} catch (PDOException $err) {// DEVERIA TRATAR EXCEÇÕES PDO
		        echo "ERRO ao tentar gravar dados do usuario.....<br/>";
		        var_dump($err->getMessage());
		        //var_dump($this->conn->errorInfo());
		        //echo '...fim erros PDO....';
		} catch (Exception $err) {// DEVERIA TRATAR OUTRAS EXCEÇÕES (NÃO PDO)
		        echo "ERRO NÃO PDO.....<br/>";
		        var_dump($err);
		}

    	
	}
	
	
	//Insert
	if(isset($_POST['idcontasreceberedit']) && $_POST['idcontasreceberedit'] == 0) {
		
		if(!empty($_POST['datapagto'])) { $datapagto = $_POST['datapagto']; } else { $datapagto = "";}
		$datainclusao = date('Y-m-d H:i:s');
		$datavencto = $_POST['datavencto']." 00:00:00";
		$datapagto = $_POST['datapagto']." 00:00:00";

		$valor = $_POST['valor'];
		
		if( strpos($valor, '.')) {
			$valor = $_POST['valor'];
		} else {
			$valor = $_POST['valor'].".00";
		}
		
		if( strpos($valor, ',')) {
			$valor = number_format($valor, 2, ',', '.');	
		}
		
		
		$documento = "";
		
		$insert = array(
		    "datavencto" => $datavencto,
			"cliente" => $_POST['cliente'],
			"historico" => $_POST['historico'],
			"datapagto" => $datapagto,	
			"valor" => $valor,
			"nrodocumento" => $_POST['nrodocumento'],
			"formapagto" => $_POST['formapagto'],		
			"datainclusao" => $datainclusao,
			"usuarioinclusao" => $_SESSION['idusuario'],		
			"unidade" => $_SESSION['idempresa']
		);
		
		$pdo = new conexao_db();
		$pdo->insert("contasreceber", $insert);
		$pdo = null;
			
	}

	
	echo "<script>window.location = '../view/contasreceber/index.php';</script>";
	
?>

