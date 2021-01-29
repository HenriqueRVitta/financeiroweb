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
            <h1 class="h3 mb-2 text-gray-800">Deseja realmente excluir Contas a Pagar ?</h1>
          </div>
          
			<?php 
       		$sql = $db_main->query("select * from contaspagar where id = '".$_GET['id']."'");
       		$dados = $sql->fetch(PDO::FETCH_OBJ);
       		
       		$datavencto = new DateTime($dados->datavencto);
       		
			?>

	<div>
	    <dl class="dl-horizontal">
	        <dt>
	            Data Vencto
	        </dt>
	
	        <dd>
	            <?php echo $datavencto->format('d-m-Y'); ?>
	        </dd>
	
	        <dt>
	            Fornecedor
	        </dt>
	
	        <dd>
	            <?php echo $dados->fornecedor; ?>
	        </dd>
	
	        <dt>
	            Hist&oacute;rico
	        </dt>
	
	        <dd>
	            <?php echo $dados->historico; ?>
	        </dd>
	
	        <dt>
	            Valor
	        </dt>
	
	        <dd>
	            <?php echo $dados->valor; ?>
	        </dd>
	
	    </dl>
    </div>
    
    	<form name='deletecontaspagar' method='POST' action='../../controller/contaspagarcontroller.php'>
    		<input type='text' name='idcontaspagardelete' id='idcontaspagardelete' value='<?php echo $dados->id; ?>' hidden='hidden'>
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
