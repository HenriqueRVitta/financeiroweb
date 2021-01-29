<?php 
	
session_start();
	
require_once("../../includes/conn.php");
require_once("../../includes/db.php");
require_once("../../model/usuariosmodel.php");	
require_once '../../includes/header.php';


$divhidden = "hidden='hidden'";

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
            <h1 class="h3 mb-2 text-gray-800">Altera senha de acesso</h1>
          </div>
          
			<?php 
			
	       		$sql = $db_main->query("select * from usuarios where id = ".$_GET['id']);
	       		//$dados = $sql->fetch(PDO::FETCH_OBJ);
	       		$dados = $sql->fetchAll(PDO::FETCH_CLASS,"usuarios") or die(print_r($sql->errorInfo(), true));
	      		
					foreach ($dados as $key => $row){
						$id = $row->getId();
					}
			?>

	    	<form class="user" name='alterasenha' method='POST' action='../../controller/usuarioscontroller.php'>
	
			    <div class="form-horizontal">


	                <div class="form-group row">
	                
	                  <div class="col-sm-3">
	                  	Senha Atual
	                    <input type="password" class="form-control form-control-user" id="senhaatual" name="senhaatual" placeholder="" title="Informe a senha nova senha" onblur="ValidaSenhaAtual(this.value,0);" required>
						<div class="alert alert-danger" role="alert" id="validasenha" <?php echo $divhidden;?> ></div>

	                  </div>
	                </div>


	                <div class="form-group row">
	                  <div class="col-sm-3">
	                  	Nova Senha
	                    <input type="password" class="form-control form-control-user" id="novasenha" name="novasenha" placeholder="" title="Informe a senha nova senha" required>
	                  </div>
	                </div>


	                <div class="form-group row">
	                  <div class="col-sm-3">
	                  	Confirma Senha
	                    <input type="password" class="form-control form-control-user" id="confirmasenha" name="confirmasenha" placeholder="" title="confirme a nova senha" onblur="Confirmasenha(this.value)" required>
	                  </div>
	                </div>

    			</div>

	    		<input type='text' name='idalterasenha' id='idalterasenha' value="<?php echo $id;?>" hidden='hidden'>
		        <div class="form-actions">
		            <i class="fas fa-save"></i><input type="submit" value="Salvar" class="btn btn-default" id="btnsalvar"/>
		        </div>
	    	</form>

    	    
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->


<script language="javascript" type="text/javascript">

function ValidaSenhaAtual(valor){

	document.getElementById('validasenha').hidden = true;
	
    var senhaatual = $("#senhaatual").val();

    if(senhaatual != ""){

        $.ajax({

            type:"POST",

            url: "js/senhaatual.php",

            dataType:"html",

            data:"senha="+senhaatual,

            success:function(data){

                $("#validasenha").html(data);

            }

        });

    }

}

function Confirmasenha(valor){

    var novasenha = $("#novasenha").val();
    var confirmasenha = $("#confirmasenha").val();

	if(confirmasenha != "") {
	    if(novasenha != confirmasenha){

	    	alert("Nova senha incorreta, favor digitar novamente.");
	    	document.getElementById('confirmasenha').value="";
	    } 
	}

}

</script>

 <?php 
  require_once '../../includes/footer.php';
 ?>
