<?php
require_once '../config/DataBase.php';

class clienteAjax {
	
	public $db;
	
	public function __construct() {
		$this->db = Database::connect();
	}	
	
	public function Mostrarcliente() {
		$sql = "SELECT * FROM cliente ";
		$resul = $this->db->query($sql);
		return $resul;
	}
	
}

class ClienteVentaAjax {
	public function MostrarCliente() {
		$cliente = new clienteAjax();
		$listacliente = $cliente->Mostrarcliente();
				
		 $datosJson = '{
		  "data": [';
		 $i = 1;
		 while ($row = $listacliente->fetch_object()) {		
			 
				
  		$botones = "<button type='button' class='btn btn-primary agregarCliente recuperarBoton' idCliente='".$row->id."'>Agregar</button>";
  				
		 
		  	$datosJson .='[
			      "'.($i+1).'",
			      "'.$row->id.'",
			      "'.$row->nombre.'",
			      "'.$row->nit.'",	   
			      "'.$botones.'"
			    ],';
			
		  }
		  
		  $datosJson = substr($datosJson, 0, -1);
		  
		 $datosJson .=   '] 
			 
		 }';
		
		echo $datosJson;		
	
		
		
		
		 }	
}
$cliente = new ClienteVentaAjax();
$cliente->MostrarCliente();

