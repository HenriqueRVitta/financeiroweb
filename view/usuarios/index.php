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
            <h1 class="h3 mb-2 text-gray-800">Usu&aacute;rios do Sistema</h1>
            <a href="edit.php?id=0" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-newspaper fa-sm text-white-50"></i> Novo Usu&aacute;rio</a>
          </div>

		
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Lista de usu&aacute;rios cadastrados</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Nome</th>
                      <th>Perfil</th>
                      <th>Email</th>
                      <th>Pessoa/Empresa</th>
                      <th>status</th>
                      <th>Editar</th>
                      <th>Excluir</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Nome</th>
                      <th>Perfil</th>
                      <th>Email</th>
                      <th>Pessoa/Empresa</th>
                      <th>Status</th>
                      <th>Editar</th>
                      <th>Excluir</th>
                    </tr>
                  </tfoot>
                  <tbody>
                  <?php

                  $tbody = "";
                  
               		$sql = $db_main->query("select u.*,c.razao from usuarios u join cadastro_unidades c on c.idunidade = u.unidade where u.unidade = '".$_SESSION['idempresa']."'");
               		//$dados = $sql->fetch(PDO::FETCH_OBJ);
               		$rows = $sql->rowCount();
               		
					if($rows >= 1) {
		
						while($row = $sql->fetch(PDO::FETCH_OBJ)) {
							
							if($row->ativo == 1) { $ativo = "Ativo"; } else { $ativo = "Inativo"; }
							
							print "<tt>";
							print "<td>".$row->nome."</td>";
							print "<td>".$row->perfil."</td>";
							print "<td>".$row->email."</td>";
							print "<td>".$row->razao."</td>";
							print "<td>".$ativo."</td>";
							
							print "<td align='center'>
			                  <a href='edit.php?id=".$row->id."' class='btn btn-success btn-circle btn-sm'>
			                    <i class='fas fa-edit'></i>
			                  </a>
							</td>";
							print "<td align='center'>
			                  <a href='delete.php?id=".$row->id."' class='btn btn-danger btn-circle btn-sm'>
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

        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->

 <?php 
  require_once '../../includes/footer.php';
 ?>
