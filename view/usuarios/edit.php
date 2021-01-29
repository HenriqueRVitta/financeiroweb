<?php 
	
session_start();
	
require_once("../../includes/conn.php");
require_once("../../includes/db.php");
require_once("../../model/usuariosmodel.php");	
require_once '../../includes/header.php';

$nome = "";
$sobreNome = "";
$email = "";
$senha = "";
$id = 0;
$perfilchecked = "";
$SelectedPerfil = "Selected";
$SelectedAtivo = "Selected";
$ativoChecked = 1;
$solicitasenha = 1;
$divhidden = "hidden='hidden'";

if($_GET['id'] > 0) {
	$titulo = "Edi&ccedil;&atilde;o de dados do usu&aacute;rio";
} else {
	$titulo = "Cadastro de novo usu&aacute;rio";
}


?>

<style>
h1 {
  font-family: 'Tangerine', serif;
  font-size: 15px;
  text-shadow: 4px 4px 4px #aaa;
}  
</style>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-2 text-gray-800"><?php echo $titulo;?></h1>
          </div>
          
			<?php 
       		if ($_GET['id'] > 0) {
			
	       		$sql = $db_main->query("select * from usuarios where id = ".$_GET['id']);
	       		//$dados = $sql->fetch(PDO::FETCH_OBJ);
	       		$dados = $sql->fetchAll(PDO::FETCH_CLASS,"usuarios") or die(print_r($sql->errorInfo(), true));
	      		
					foreach ($dados as $key => $row){
						$nome = $row->getNome();
						$sobreNome = $row->getSobrenome();
						$email = $row->getEmail();
						$senha = $row->getSenha();
						$id = $row->getId();
						$perfilchecked = $row->getPerfil();
						$ativoChecked = $row->getAtivo();
					}
       		}

			?>

	    	<form class="user" name='edituser' method='POST' action='../../controller/usuarioscontroller.php'>
	
			    <div class="form-horizontal">
	                <div class="form-group row">
	                  <div class="col-sm-6 mb-3 mb-sm-0">
	                  	Nome
	                    <input type="text" class="form-control form-control-user" id="nome" name="nome" placeholder="Nome" value="<?php echo $nome;?>" required>
	                  </div>
	                  <div class="col-sm-6">
	                  	Sobre Nome
	                    <input type="text" class="form-control form-control-user" id="sobrenome" name="sobrenome" placeholder="Sobre Nome" value="<?php echo $sobreNome;?>" required>
	                  </div>
	                </div>
				    
	                <div class="form-group row">
	                
	                  <div class="col-sm-6 mb-3 mb-sm-0">
	                  E-mail
	                  <input type="email" class="form-control form-control-user" id="email" placeholder="Email" value="<?php echo $email; ?>" name="email" onblur="ValidaEmailDigitado(document.getElementById('iduseredit').value);" required>
	                  <div class="alert alert-danger" role="alert" id="validaemail" <?php echo $divhidden;?> ></div>
	                  </div>
	                  <div class="col-sm-3">
	                  	Perfil do Usu&aacute;rio
						<select class="browser-default custom-select" title="Informe o perfil do usu&aacute;rio" name="perfil" required>
						  <option value="" selected>Selecione o Perfil</option>
						  <option value="Administrador" <?php if($perfilchecked=="Administrador") { echo $SelectedPerfil; }?> >Administrador</option>
						  <option value="Supervisor" <?php if($perfilchecked=="Supervisor") { echo $SelectedPerfil; }?> >Supervisor</option>
						  <option value="Consulta" <?php if($perfilchecked=="Consulta") { echo $SelectedPerfil; }?> >Consulta</option>
						</select>
	                   </div>
	                  <div class="col-sm-3">
	                  Status
						<select class="browser-default custom-select" title="Informe Ativo ou Inativo" name="status" required>
						  <option value="" selected>Selecione o Status</option>
						  <option value="1" <?php if($ativoChecked=="1") { echo $SelectedAtivo; }?> >Ativo</option>
						  <option value="2"  <?php if($ativoChecked=="2") { echo $SelectedAtivo; }?> >Inativo</option>
						</select>
					  </div>	                   
	                </div>
	
	<?php 
       		if ($_GET['id'] == 0) { ?>
	                <div class="form-group row">
	                  <div class="col-sm-6 mb-3 mb-sm-0">
	                  	Senha
	                    <input type="password" class="form-control form-control-user" id="senha" name="senha" placeholder="Senha" title="Informe a senha" required>
	                  </div>
	                  <div class="col-sm-6">
	                  	Confirma Senha
	                    <input type="password" class="form-control form-control-user" id="confirmasenha" placeholder="Cofirma Senha" title="confirme a senha" required>
	                  </div>
	                </div>
	                
	                <div class="form-group row-left">
						<div class="form-check">
						  <label class="form-check-label">
						    <input type="checkbox" class="form-check-input" id="solicitasenha" name="solicitasenha" value="<?php echo $solicitasenha; ?>" checked>Solicitar senha no primeiro acesso
						  </label>
						</div>	                
	                </div>


    			</div>
	<?php 
       		}
	?>

	
	    		<input type='text' name='iduseredit' id='iduseredit' value="<?php echo $id;?>" hidden='hidden'>
		        <div class="form-actions">
		            <i class="fas fa-save"></i><input type="submit" value="Salvar" class="btn btn-default"/> <a class="btn btn-primary" href="index.php">Voltar a Lista</a>
		        </div>
	    	</form>

    	    
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->

<script language="javascript" type="text/javascript">

function ValidaEmailDigitado(valor){
	
	document.getElementById('validaemail').hidden = true;
	
    var emailatual = $("#email").val();

    
    if(emailatual != "" && valor == 0){

        $.ajax({

            type:"POST",

            url: "js/verificaemail.php",

            dataType:"html",

            data:"email="+emailatual,

            success:function(data){

                $("#validaemail").html(data);

            }

        });

    }

}

</script>

 <?php 
  require_once '../../includes/footer.php';
 ?>
