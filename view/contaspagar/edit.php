<?php 
	
session_start();
	
require_once("../../includes/conn.php");
require_once("../../includes/db.php");
require_once("../../model/contaspagarmodel.php");	
require_once '../../includes/header.php';

$id = 0;
$datainclusao = date('Y-m-d H:i:s');
$usuarioinclusao = $_SESSION['idusuario']; 
$fornecedor = "";
$historico = "";
$datavencto = date('Y-m-d');
$datapagto = "";
$valor = 0.00;
$documento = "";
$formapagto = "";
$nrodocumento = "";
$unidade = $_SESSION['idempresa'];
  

if($_GET['id'] > 0) {
	$titulo = "Edi&ccedil;&atilde;o de dados do Contas a Pagar";
} else {
	$titulo = "Novo Lan&ccedil;amento do Contas a Pagar";
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
			
	       		$sql = $db_main->query("select * from contaspagar where id = ".$_GET['id']);
	       		//$dados = $sql->fetch(PDO::FETCH_OBJ);
	       		$dados = $sql->fetchAll(PDO::FETCH_CLASS,"contaspagar") or die(print_r($sql->errorInfo(), true));
	      		
					foreach ($dados as $key => $row){

						$datapagto = new DateTime($row->getDatapagto());
						$datavencto = new DateTime($row->getDatavencto());
						
						$id = $row->getId();
						$datainclusao = $row->getDatainclusao();
						$usuarioinclusao = $row->getUsuarioinclusao();
						$fornecedor = $row->getFornecedor();
						$historico = $row->getHistorico();
						//$datavencto = $row->getDatavencto();
						$datavencto = $datavencto->format('Y-m-d');
												
						//$datapagto = $row->getDatapagto();
						$datapagto = $datapagto->format('Y-m-d');
						$valor = $row->getValor();
						$documento = $row->getDocumento();
						$formapagto = $row->getFormapagto();
						$nrodocumento = $row->getNrodocumento();
						$unidade = $row->getUnidade();
						
						
					}
       		}

			?>

	    	<form class="user" name='editcontaspagar' enctype="multipart/form-data" method='POST' action='../../controller/contaspagarcontroller.php'>
	
			  <div class="row">
			    <div class="col-sm-2">
			    Data Vencto
			      <input type="date" class="form-control" id="datavencto" placeholder="" name="datavencto" value="<?php echo $datavencto;?>" required>
			    </div>
			    <div class="col-sm-4">
			    Fornecedor
			      <input type="text" class="form-control" id="fornecedor" placeholder="" name="fornecedor" value="<?php echo $fornecedor;?>" required>
			    </div>
			    <div class="col-sm-6">
			    Hist&oacute;rico
			      <input type="text" class="form-control" id="historico" placeholder="" name="historico" value="<?php echo $historico;?>" required>
			    </div>
			  </div>

			  <div class="row">
			    <div class="col-sm-2">
			    Data Pagto
			      <input type="date" class="form-control" id="datapagto" placeholder="" name="datapagto" value="<?php echo $datapagto;?>">
			    </div>
			    <div class="col-sm-2">
			    Valor
			      <input type="number" min="0" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control" id="valor" placeholder="" name="valor" value="<?php echo $valor;?>">
			    </div>
			    <div class="col-sm-3">
			    Nro Documento
			      <input type="text" class="form-control" id="nrodocumento" placeholder="" name="nrodocumento" value="<?php echo $nrodocumento;?>">
			    </div>
			    <div class="col-sm-5">
			    Forma de Pagto
			      <input type="text" class="form-control" id="formapagto" placeholder="" name="formapagto" value="<?php echo $formapagto;?>">
			    </div>
			  </div>

			<hr>

			 <div class="row">
			    <div class="col-sm-6" id="customFile">
					Arquivo: <input id="file" name="file" type="file" >
			    </div>
		    </div>  	
			
			<hr>
	
	    		<input type='text' name='idcontaspagaredit' id='idcontaspagaredit' value="<?php echo $id;?>" hidden='hidden'>
		        <div class="form-actions">
		            <i class="fas fa-save"></i><input type="submit" value="Salvar" class="btn btn-default"/> <a class="btn btn-primary" href="index.php">Voltar a Lista</a>
		        </div>
	    	</form>

    	    
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->

 <?php 
  require_once '../../includes/footer.php';
 ?>
