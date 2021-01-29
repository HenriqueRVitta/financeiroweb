<?php 
	
session_start();
	
require_once("../../includes/conn.php");
require_once("../../includes/db.php");
	
require_once '../../includes/header.php';
	
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
            <h1 class="h3 mb-2 text-gray-800">Deseja realmente excluir o usu&aacute;rio ?</h1>
          </div>
          
			<?php 
       		$sql = $db_main->query("select * from usuarios where id = '".$_GET['id']."'");
       		$dados = $sql->fetch(PDO::FETCH_OBJ);
			?>

	<div>
	    <dl class="dl-horizontal">
	        <dt>
	            Nome do Usuario
	        </dt>
	
	        <dd>
	            <?php echo $dados->nome." ".$dados->sobrenome; ?>
	        </dd>
	
	        <dt>
	            Perfil
	        </dt>
	
	        <dd>
	            <?php echo $dados->perfil; ?>
	        </dd>
	
	        <dt>
	            E-mail
	        </dt>
	
	        <dd>
	            <?php echo $dados->email; ?>
	        </dd>
	
	
	    </dl>
    </div>
    
    	<form name='deleteuser' method='POST' action='../../controller/usuarioscontroller.php'>
    		<input type='text' name='iduserdelete' id='iduserdelete' value='<?php echo $dados->id; ?>' hidden='hidden'>
	        <div class="form-actions">
	            <i class="fas fa-trash"></i><input type="submit" value="Excluir" class="btn btn-default"/> <a class="btn btn-primary" href="index.php">Voltar a Lista</a>
	        </div>
    	</form>
    	    
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->

 <?php 
  require_once '../../includes/footer.php';
 ?>
