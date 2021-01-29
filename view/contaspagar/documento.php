<?php 
	
session_start();
	
require_once("../../includes/conn.php");
require_once("../../includes/db.php");
require_once("../../model/contaspagarmodel.php");	
//require_once '../../includes/header.php';


       		if ($_GET['id'] > 0) {
			
	       		$sql = $db_main->query("select documento,tipodocumento from contaspagar where id = ".$_GET['id']);
				while($row = $sql->fetch(PDO::FETCH_OBJ)) {
						$documento = $row->documento;
						$tipodocumento = $row->tipodocumento;
				}

				/*
	       		$dados = $sql->fetchAll(PDO::FETCH_CLASS,"contaspagar") or die(print_r($sql->errorInfo(), true));
	      		
					foreach ($dados as $key => $row){

						$documento = $row->getDocumento();
						$tipodocumento = $row->getTipodocumento();
						
						
					}
				*/
	       		

				$header = "Content-type: " .$tipodocumento;
				header($header);
				echo base64_decode($documento);

        					
       		}
       		