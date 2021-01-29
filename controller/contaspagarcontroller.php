<?php 

/*
ini_set( 'display_errors', 0 );
error_reporting( E_ALL );
*/

session_start();

require_once("../includes/conn.php");
require_once("../includes/db.php");

	// Delete
	if(isset($_POST['idcontaspagardelete'])) {
		$sql = $db_main->query("delete from contaspagar where id = '".$_POST['idcontaspagardelete']."'");
		header('Location: ../view/contaspagar/index.php');
		die();
	}


	// Update
	if(isset($_POST['idcontaspagaredit']) && $_POST['idcontaspagaredit'] > 0) {
	
		$documento = "";
		$tipodocumento = "";


		if (count($_FILES) > 0) {

			//recupera os dados enviados atraves do formulário
			//NOME TEMPORÁRIO
			$file_tmp = $_FILES["file"]["tmp_name"];
			 //NOME DO ARQUIVO NO COMPUTADOR
			$file_name = $_FILES["file"]["name"];
			//lemos o  conteudo do arquivo usando afunção do PHP  file_get_contents
			$binario = file_get_contents($file_tmp);
			// evitamos erro de sintaxe do MySQL
			//$binario = mysql_real_escape_string($binario);
			
			$b64Doc = chunk_split(base64_encode(file_get_contents($file_tmp)));
			
			$tipodocumento = $_FILES["file"]["type"];
			$documento = $b64Doc; //$binario;
			
		}
		
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
				"fornecedor" => $_POST['fornecedor'],
				"historico" => $_POST['historico'],
				"datapagto" => $datapagto,	
				"valor" => $valor,
				"nrodocumento" => $_POST['nrodocumento'],
				"formapagto" => $_POST['formapagto'],		
				"datainclusao" => $datainclusao,
				"documento" => $documento,
				"usuarioinclusao" => $_SESSION['idusuario'],		
				"unidade" => $_SESSION['idempresa'],
				"tipodocumento" => $tipodocumento
			);
			
			$Where = 'id = '.$_POST['idcontaspagaredit'];
			
			$pdo = new conexao_db();
			$pdo->update("contaspagar", $insert, $Where);
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
	if(isset($_POST['idcontaspagaredit']) && $_POST['idcontaspagaredit'] == 0) {
		
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
			"fornecedor" => $_POST['fornecedor'],
			"historico" => $_POST['historico'],
			"datapagto" => $datapagto,	
			"valor" => $valor,
			"nrodocumento" => $_POST['nrodocumento'],
			"formapagto" => $_POST['formapagto'],		
			"datainclusao" => $datainclusao,
			"documento" => $documento,
			"usuarioinclusao" => $_SESSION['idusuario'],		
			"unidade" => $_SESSION['idempresa']
		);
		
		$pdo = new conexao_db();
		$pdo->insert("contaspagar", $insert);
		$pdo = null;
			
	}

	
	echo "<script>window.location = '../view/contaspagar/index.php';</script>";
	
?>

