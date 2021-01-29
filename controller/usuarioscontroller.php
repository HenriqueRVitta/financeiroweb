<?php 

session_start();

require_once("../includes/conn.php");
require_once("../includes/db.php");

	// Delete
	if(isset($_POST['iduserdelete'])) {
		$sql = $db_main->query("delete from usuarios where id = '".$_POST['iduserdelete']."'");
		header('Location: ../view/usuarios/index.php');
		die();
	}


	// Update
	if(isset($_POST['iduseredit']) && $_POST['iduseredit'] > 0) {
	
	//print_r($_POST);
	//break;
	
		try {
			
			$sql = $db_main->query("UPDATE usuarios SET nome = '".$_POST['nome']."', sobrenome = '".$_POST['sobrenome']."', email = '".$_POST['email']."', ativo = ".$_POST['status'].", perfil = '".$_POST['perfil']."', unidade =".$_SESSION['idempresa']." WHERE id = '".$_POST['iduseredit']."'");
			
		} catch (PDOException $err) {// DEVERIA TRATAR EXCEÇÕES PDO
		        echo "ERRO ao tentar gravar dados do usuario.....<br/>";
		        var_dump($err->getMessage());
		        //var_dump($this->conn->errorInfo());
		        //echo '...fim erros PDO....';
		} catch (Exception $err) {// DEVERIA TRATAR OUTRAS EXCEÇÕES (NÃO PDO)
		        echo "ERRO NÃO PDO.....<br/>";
		        var_dump($err);
		}

		/*
    	if($sql > 0){
			echo "<script>alert('Alteração realizada com sucesso!'); window.location = '../view/usuarios/index.php';</script>";
    	}
    	*/
    	
	}
	
	
	//Insert
	if(isset($_POST['iduseredit']) && $_POST['iduseredit'] == 0) {
	
		$senha = md5($_POST['senha']);
		
		if(isset($_POST['solicitasenha'])){
			$solicitasenha = $_POST['solicitasenha']	;
		} else {
			$solicitasenha = 0;
		}
		
		
		$insert = array(
		    "senha" => $senha,
			"nome" => $_POST['nome'],
			"sobrenome" => $_POST['nome'],
			"email" => $_POST['email'],	
			"ativo" => $_POST['status'],
			"perfil" => $_POST['perfil'],
			"unidade" => $_SESSION['idempresa'],
			"solicitasenha" => $solicitasenha
		);
		
		$pdo = new conexao_db();
		$pdo->insert("usuarios", $insert);
		$pdo = null;
			
	}

	// Altera Senha do usuario
	if(isset($_POST['idalterasenha']) && $_POST['idalterasenha'] > 0) {
	
		$senha = md5($_POST['novasenha']);

		try {
			
		$sql = $db_main->query("UPDATE usuarios SET senha = '".$senha."', solicitasenha = 0 WHERE id = '".$_POST['idalterasenha']."'");
			
		} catch (PDOException $err) {// DEVERIA TRATAR EXCEÇÕES PDO
		        echo "ERRO ao tentar alterar senha do usuario.....<br/>";
		        var_dump($err->getMessage());
		        //var_dump($this->conn->errorInfo());
		        //echo '...fim erros PDO....';
		} catch (Exception $err) {// DEVERIA TRATAR OUTRAS EXCEÇÕES (NÃO PDO)
		        echo "ERRO NÃO PDO.....<br/>";
		        var_dump($err);
		}
		
		echo "<script>alert('Senha alterada com sucesso!');</script>";

			
	}

	
	echo "<script>window.location = '../view/usuarios/index.php';</script>";
	
?>

