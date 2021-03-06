<?php 
	
session_start();
	
require_once("../../includes/conn.php");
require_once("../../includes/db.php");
	
require_once '../../includes/header.php';

  $disabled = "";

  if($_SESSION['perfil'] == "Consulta") {
    $disabled = " disabled ";
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
            <h1 class="h3 mb-2 text-gray-800">Contas a Pagar</h1>
            <a href="edit.php?id=0" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm <?php echo $disabled; ?>"><i class="fas fa-newspaper fa-sm text-white-50"></i> Novo Lan&ccedil;amnto</a>
          </div>

	    	<form class="user" name='indextcontaspagar' method='POST' action='#'>
	
			  <div class="row">
			    <div class="col-sm-2">
			      <input type="date" class="form-control" id="datainicial" placeholder="" name="datainicial" value="">
			    </div>
			    <div class="col-sm-2">
			      <input type="date" class="form-control" id="datafinal" placeholder="" name="datafinal" value="">
			    </div>
			    <div class="col-sm-2">
		            <button type="submit" class="btn btn-primary mb-2">Filtrar</button>
		        </div>
			  </div>
	    	</form>
	    			
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Lista das Movimenta&ccedil;&otilde;es</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Data Vencto</th>
                      <th>Fornecedor</th>
                      <th>Hist&oacute;rico</th>
                      <th>Data Pagto</th>
                      <th>Valor</th>
                      <th>Doc</th>
                      <th>Editar</th>
                      <th>Excluir</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Data Vencto</th>
                      <th>Fornecedor</th>
                      <th>Hist&oacute;rico</th>
                      <th>Data Pagto</th>
                      <th>Valor</th>
                      <th>Doc</th>
                      <th>Editar</th>
                      <th>Excluir</th>
                    </tr>
                  </tfoot>
                  <tbody>
                  <?php

                  $tbody = "";
                  $where = "";
                  
                      if(isset($_POST['datainicial']) && !empty($_POST['datainicial'])) {
                        $where = " and datavencto between '".$_POST['datainicial']."' and '".$_POST['datafinal']."'";
                      }
                  	
               		            $sql = $db_main->query("select * from contaspagar where unidade = '".$_SESSION['idempresa']."'".$where);
                              //$dados = $sql->fetch(PDO::FETCH_OBJ);
                              $rows = $sql->rowCount();
                              $valorPago = 0;
                              $valorAPagar = 0;
                              if($rows >= 1) {
                        
                                while($row = $sql->fetch(PDO::FETCH_OBJ)) {

                                  $datapagto = new DateTime($row->datapagto);
                                  $datavencto = new DateTime($row->datavencto);
                                  $vencto = $datavencto->format('d-m-Y');
                                  $pagto = $datapagto->format('d-m-Y');
                                  if($row->datavencto=="0000-00-00 00:00:00") { $vencto = ""; }
                                  if($row->datapagto=="0000-00-00 00:00:00") { $pagto = ""; }
                                  
                                  if($row->datapagto=="0000-00-00 00:00:00") { 
                                    $valorAPagar+=$row->valor; 
                                  } else {
                                    $valorPago+=$row->valor;
                                  }

                                  print "<tt>";
                                  print "<td>".$vencto."</td>";
                                  print "<td>".$row->fornecedor."</td>";
                                  print "<td>".$row->historico."</td>";
                                  print "<td>".$pagto."</td>";
                                  print "<td>".$row->valor."</td>";
                                  
                                  if(!empty($row->tipodocumento)) {
                                    print "<td align='center'>
                                              <a href='imageview.php?id=".$row->id."' class='btn btn-warning btn-circle btn-sm'  target='_blank'>
                                                <i class='fas fa-search'></i>
                                              </a>
                                    </td>";
                                  } else {
                                    print "<td align='center'>
                                    </td>";
                                  }
                                  
                                  print "<td align='center'>
                                            <a href='edit.php?id=".$row->id."' class='btn btn-success btn-circle btn-sm <?php echo $disabled; ?>'>
                                              <i class='fas fa-edit'></i>
                                            </a>
                                  </td>";
                                  print "<td align='center'>
                                            <a href='delete.php?id=".$row->id."' class='btn btn-danger btn-circle btn-sm <?php echo $disabled; ?>'>
                                              <i class='fas fa-trash'></i>
                                            </a>
                                  </td>";
                                  print "</tr>";
                                  }
                                        
                              }
                                            
                                      ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>


          <!-- Totalização -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Totalização:</h6>
            </div>
            <div class="card-body">
                <div class="row">
                  <div class="col-sm-2">
                    Valor Pago:
                    <input type="number" min="0" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control disabled" id="valorpago" placeholder="" name="valorpago" value="<?php echo $valorPago;?>" disabled="">
                  </div>
                  <div class="col-sm-2">
                    Valor Pendente:
                    <input type="number" min="0" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control disabled" id="valorapagar" placeholder="" name="valorapagar" value="<?php echo $valorAPagar;?>" disabled="">
                  </div>
                </div>

            </div>
          </div>

        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->

 <?php 
  require_once '../../includes/footer.php';
 ?>
