
<?php
date_default_timezone_set('America/Sao_Paulo');

$teste = 0;

if(isset($_POST['FirstName']) && !empty($_POST['FirstName'])) {

  $nome = $_POST['FirstName'];
  $sobrenome = $_POST['LastName'];
  $email = $_POST['InputEmail'];
  $senha = $_POST['InputPassword'];
  $assunto = "Acesso ao Financeiro WEB";
  $data_envio = date('d/m/Y');
  $hora_envio = date('H:i:s');


  // Corpo do e-mail
  $arquivo = "
  <style type='text/css'>
  body {
  margin:0px;
  font-family:Verdane;
  font-size:14px;
  color: #666666;
  }
  a{
  color: #666666;
  text-decoration: none;
  }
  a:hover {
  color: #FF0000;
  text-decoration: none;
  }
  </style>
    <html>
        <table width='510' border='1' cellpadding='1' cellspacing='1'>
            <tr>
              <td>DADOS PARA TESTE NO FINANCEIRO WEB</td>
            <tr>
              <td width='500'>Nome: $nome</td>
              </tr>
              <tr>
              <td width='320'>SobreNome:<b> $sobrenome</b></td>
      </tr>
       <tr>
                  <td width='320'>Email:<b> $email</b></td>
        </tr>
       <tr>
                  <td width='320'>Senha: $senha</td>
                </tr>
                <tr>
                  <td width='320'>Mensagem: $assunto</td>
                </tr>
            </td>
          </tr>
          <tr>
            <td>Este e-mail foi enviado em <b>$data_envio</b> as <b>$hora_envio</b></td>
          </tr>
        </table>
    </html>
  ";

// emails para quem será enviado o formulário
$emailenviar = "suporte@hrvinformatica.com.br";
$destino = $emailenviar;
$assunto = "Contato pelo Site - Acesso Financeiro WEB";

// Indicando que o formato do e-mail é html
$headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= 'From: <$nome> <$sobrenome> <$email>';


$enviaremail = mail($destino, $assunto, $arquivo, $headers);
if($enviaremail){
$mgm = "E-MAIL ENVIADO COM SUCESSO! <br> O link será enviado para o e-mail fornecido no formulário";
echo " <meta http-equiv='refresh' content='10;URL=register.php'>";
} else {
$mgm = "ERRO AO ENVIAR E-MAIL!";
echo "";
}

}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Meu Financeiro - Registro</title>
  <link rel="icon" href="../img/hrv.ico" type="image/x-icon">

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
        <div class="col-lg-6 d-none d-lg-block bg-login-image"><p align="center" style="font-size:22px; font-weight: bold;" >Minhas Finan&ccedil;as</p></div>
          <div class="col-lg-6">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Solicitar Avaliação do Sistema</h1>
              </div>
              <form class="user" method="post" action="register.php">
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="FirstName" name="FirstName" placeholder="Primeiro nome" required>
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" id="LastName" name="LastName" placeholder="Último nome" required>
                  </div>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-user" id="InputEmail" name="InputEmail" placeholder="Email" required>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user" id="InputPassword" name="InputPassword" placeholder="Senha" required>
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user" id="RepeatPassword" name="RepeatPassword" placeholder="Repetir Senha" required>
                  </div>
                </div>
                <input type="submit" value="Solicitar Acesso" name="acesso" id="acesso"  class="btn btn-primary btn-user btn-block"/>
                <hr>
              </form>
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
