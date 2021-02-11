<?php 

session_start();

require_once("../includes/conn.php");
require_once("../includes/db.php");

$divhidden = "hidden='hidden'";

	if(isset($_POST['login']) && isset($_POST['email'])) {

		// Recupera a senha, a criptografando em MD5
		$senha = md5(trim($_POST["password"]));
		 
		$sql = $db_main->query("select u.*,c.razao from usuarios u join cadastro_unidades c on c.idunidade = u.unidade where u.email = '".$_POST['email']."'");

		if($sql > '0'){
			
			$dados = $sql->fetch(PDO::FETCH_OBJ);
			if(isset($dados->senha)){

				$sen = strcmp($senha,$dados->senha);
				
				if($sen == 0) {

						$divhidden = "hidden='hidden'";
						
						$_SESSION['idusuario'] = $dados->id;
						$_SESSION['nomeusuario'] = $dados->nome." ".$dados->sobrenome;
						$_SESSION['perfil'] = $dados->perfil;
						$_SESSION['razaosocial'] = $dados->razao;
						$_SESSION['idempresa'] = $dados->unidade;
						
						if($dados->solicitasenha == 0) {
							
							header('Location: ../index.php');
							exit;
							
						} else {

							header('Location: usuarios/alterasenha.php?id='.$_SESSION['idusuario']);
							exit;
							
						}
						
												
					} else {
						$divhidden = "";						
					}
								
			}
			
		}
	}
	
	
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Meu Financeiro - Login</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <!-- <link href="../css/sb-admin-2.min.css" rel="stylesheet"> -->
  <link href="../css/sb-admin-2.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"><p align="center" style="font-size:22px; font-weight: bold;" >Minhas Finan&ccedil;as</p></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Bem vindo !</h1>
                  </div>

					<div class="alert alert-danger" role="alert" <?php echo $divhidden; ?> >
					  Usu&aacute;rio ou senha inv&aacute;lida
					</div>
                  
                  <form class="user" method="post" action="login.php">
                    <div class="form-group">
                      <input type="email" class="form-control form-control-user" id="email" name="email" aria-describedby="emailHelp" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Senha" required>
                    </div>
                    
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Lembrar-me</label>
                      </div>
                    </div>
                    
                    <input type="submit" value="ENTRAR" id="login" name="login" class="btn btn-primary btn-user btn-block">
                    <!-- <a href="../index.php" class="btn btn-primary btn-user btn-block">
                      Login
                    </a>-->
                    
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="forgot-password.html">Esqueceu a Senha ?</a>
                  </div>
                  <div class="text-center">
                    <a class="small" href="register.html">Solicitar acesso para avalia&ccedil;&atilde;o !</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin-2.min.js"></script>

</body>

</html>

