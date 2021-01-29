<?php 
	
	session_start();
	
	if(!isset($_SESSION['idusuario'])){
		header('Location: view/login.php');
		exit;
	}

require_once("includes/conn.php");
require_once("includes/db.php");	
require_once 'includes/header.php';
	
?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Receitas no M&ecirc;s</div>
					<?php 
					$lnTotalReceita = 0.00;
					$dtInicio = date('Y-m')."-01";
					$mes = date("m"); // Mês desejado, pode ser por ser obtido por POST, GET, etc.
					$ano = date("Y"); // Ano atual
					$ultimo_dia = date("t", mktime(0,0,0,$mes,'01',$ano)); // Mágica, plim!
					$dtFim = date('Y-m')."-".$ultimo_dia;					
					$sql = $db_main->query("select sum(valor) as total from contasreceber where datapagto between '".$dtInicio."' and '".$dtFim."'");
		       		$dados = $sql->fetch(PDO::FETCH_OBJ);
		       		$lnTotalReceita = $dados->total;
					?>

                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo "R$ ".$lnTotalReceita;?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Despesas no M&ecirc;s</div>
                      
					<?php 
					$lnTotalDespesa = 0.00;					
					$sql = $db_main->query("select sum(valor) as total from contaspagar where datapagto between '".$dtInicio."' and '".$dtFim."'");
		       		$dados = $sql->fetch(PDO::FETCH_OBJ);
		       		$lnTotalDespesa = $dados->total;
					?>
                      
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo "R$ ".$lnTotalDespesa;?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
			<?php 
			$lnPagarPendente = 0.00;					
			$sql = $db_main->query("select sum(valor) as total from contaspagar where datapagto = '0000-00-00 00:00:00'");
       		$dados = $sql->fetch(PDO::FETCH_OBJ);
       		$lnPagarPendente = $dados->total;
			?>
            
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">A Pagar - Pendente</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">R$ <?php echo $lnPagarPendente; ?></div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
			<?php 
			$lnReceberPendente = 0.00;					
			$sql = $db_main->query("select sum(valor) as total from contasreceber where datapagto = '0000-00-00 00:00:00'");
       		$dados = $sql->fetch(PDO::FETCH_OBJ);
       		$lnReceberPendente = $dados->total;
			?>
            
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">A Receber - Pendente</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">R$ <?php echo $lnReceberPendente; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Content Row -->

          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Vis&atilde;o Geral das Despesas</h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Dropdown Header:</div>
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                  </div>
                </div>
                <?php 
                 $nvalJan = 0;
                 $nvalFev = 0;
                 $nvalMar = 0;
                 $nvalAbr = 0;
                 $nvalMai = 0;
                 $nvalJun = 0;
                 $nvalJul = 0;
                 $nvalAgo = 0;
                 $nvalSet = 0;
                 $nvalOut = 0;
                 $nvalNov = 0;
                 $nvalDez = 0;

                $inicio = date("y")."-01-01";
                $fim = date("y")."-12-31";
	       		$sql = $db_main->query("SELECT month(datapagto) as mes,sum(valor) as valor FROM contaspagar where datapagto between '".$inicio."' and '".$fim."' group by month(datapagto)");
	       		$dados = $sql->fetchAll() or die(print_r($sql->errorInfo(), true));
	      		
					foreach ($dados as $key => $row) {
						
					if($row["mes"] == 1) { $nvalJan = $row["valor"]; }
					if($row["mes"] == 2) { $nvalFev = $row["valor"]; }
					if($row["mes"] == 3) { $nvalMar = $row["valor"]; }
					if($row["mes"] == 4) { $nvalAbr = $row["valor"]; }
					if($row["mes"] == 5) { $nvalMai = $row["valor"]; }
					if($row["mes"] == 6) { $nvalJun = $row["valor"]; }
					if($row["mes"] == 7) { $nvalJul = $row["valor"]; }
					if($row["mes"] == 8) { $nvalAgo = $row["valor"]; }
					if($row["mes"] == 9) { $nvalSet = $row["valor"]; }
					if($row["mes"] == 10) { $nvalOut = $row["valor"]; }
					if($row["mes"] == 11) { $nvalNov = $row["valor"]; }
					if($row["mes"] == 12) { $nvalDez = $row["valor"]; }
					
							
					}
					
                 ?>

                <input type="hidden" class="form-control" id="janeiro" name="janeiro" value="<?php echo $nvalJan;?>" >
                <input type="hidden" class="form-control" id="fevereiro" name="fevereiro" value="<?php echo $nvalFev;?>" >
                <input type="hidden" class="form-control" id="marco" name="marco" value="<?php echo $nvalMar;?>" >
                <input type="hidden" class="form-control" id="abril" name="abril" value="<?php echo $nvalAbr;?>" >
                <input type="hidden" class="form-control" id="maio" name="maio" value="<?php echo $nvalMai;?>" >
                <input type="hidden" class="form-control" id="junho" name="junho" value="<?php echo $nvalJun;?>" >
                <input type="hidden" class="form-control" id="julho" name="julho" value="<?php echo $nvalJul;?>" >
                <input type="hidden" class="form-control" id="agosto" name="agosto" value="<?php echo $nvalAgo;?>" >
                <input type="hidden" class="form-control" id="setembro" name="setembro" value="<?php echo $nvalSet;?>" >
                <input type="hidden" class="form-control" id="outubro" name="outubro" value="<?php echo $nvalOut;?>" >
                <input type="hidden" class="form-control" id="novembro" name="novembro" value="<?php echo $nvalNov;?>" >
                <input type="hidden" class="form-control" id="dezembro" name="dezembro" value="<?php echo $nvalDez;?>" >
                
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Fontes de Receita</h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Dropdown Header:</div>
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                  </div>
                </div>

                <?php 

                $primeiro = "";
                $segundo  = "";
                $terceiro = "";
                
                $nvalPri = 0;
                $nvalSeg = 0;
                $nvalTer = 0;

                $inicio = date("y")."-01-01";
                $fim = date("y")."-12-31";
	       		$sql = $db_main->query("SELECT Upper(substr(formapagto,1,10)) as receita,count(*) as total FROM contasreceber where datapagto between '".$inicio."' and '".$fim."' group by substr(formapagto,1,5) limit 3");
	       		$dados = $sql->fetchAll() or die(print_r($sql->errorInfo(), true));
	      		
	       			$x = 0;
					foreach ($dados as $key => $row) {
						
						if($x == 0) {
							$primeiro = $row["receita"];
							$nvalPri = $row["total"];
						}

						if($x == 1) {
							$segundo = $row["receita"];
							$nvalSeg = $row["total"];
						}

						if($x == 2) {
							$terceiro = $row["receita"];
							$nvalTer = $row["total"];
						}
						
						$x++;
					}
					
                 ?>

                <input type="hidden" class="form-control" id="primeiro" name="primeiro" value="<?php echo $primeiro;?>" >
                <input type="hidden" class="form-control" id="segundo" name="segundo" value="<?php echo $segundo;?>" >
                <input type="hidden" class="form-control" id="terceiro" name="terceiro" value="<?php echo $terceiro;?>" >
                <input type="hidden" class="form-control" id="nvalPri" name="nvalPri" value="<?php echo $nvalPri;?>" >
                <input type="hidden" class="form-control" id="nvalSeg" name="nvalSeg" value="<?php echo $nvalSeg;?>" >
                <input type="hidden" class="form-control" id="nvalTer" name="nvalTer" value="<?php echo $nvalTer;?>" >
                
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-pie pt-4 pb-2">
                    <canvas id="myPieChart"></canvas>
                  </div>
                  <div class="mt-4 text-center small">
                    <span class="mr-2">
                      <i class="fas fa-circle text-primary"></i> <?php echo $primeiro;?>
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-success"></i> <?php echo $segundo;?>
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-info"></i> <?php echo $terceiro;?>
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>


        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

 
 <?php 
  require_once 'includes/footer.php';
 ?>
 