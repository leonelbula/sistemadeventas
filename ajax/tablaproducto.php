<?php
require_once '../config/DataBase.php';

class ListaInventario {
	
	public $db;
	
	public function __construct() {
		$this->db = Database::connect();
	}	

	public function MostrarProductos() {
		$sql = "SELECT * FROM product";
		$resul = $this->db->query($sql);
		return $resul;
	}
	public function categoriaId($id) {
		$sql = "SELECT * FROM categoria  WHERE id = $id";
		$resul = $this->db->query($sql);
		return $resul;
	}
}

class InventarioAjax {
	public function MostrarProdcutos() {
		$inventario = new ListaInventario();
		$listaproducto = $inventario->MostrarProductos();
		
		
		 $datosJson = '{
		  "data": [';
		 $i = 1;
		 while ($row = $listaproducto->fetch_object()) {		
				
			 $id = $row->id_categoria;
			 $listaCate = $inventario->categoriaId($id);
			 
			 while ($row1 = $listaCate->fetch_object()) {
				 $categoria = $row1->nombre;
			 }

  			if($row->can_inicial< $row->cantidad_min){

  				$stock = "<button class='btn btn-danger'>".$row->can_inicial."</button>";
  			
  			}else{

  				$stock = "<button class='btn btn-success'>".$row->can_inicial."</button>";

  			}

		  	/*=============================================
 	 		TRAEMOS LAS ACCIONES
  			=============================================*/ 

  			

  			$botones =  "<div class='btn-group'><a href='editar&id=".$row->id."'><button class='btn btn-warning btnAgregararticulo'><i class='fa fa-pencil'></i></button></a><a href='eliminar&id=".$row->id."'><button class='btn btn-danger btnEliminarProducto'><i class='fa fa-times'></i></button></a></div>"; 
  			

  			$redir = "href='ver&id=".$row->id."'";

  		

		 
		  	$datosJson .='[
			      "'.($i++).'",
			      "'.$row->codigo.'",
			      "<a '.$redir.'>'.$row->nombre.'</a>",
			      "'.$row->costo.'",
			      "'.$categoria.'",
			      "'.$row->precio_v_iva1.'",				 
			      "'.$row->impuesto.' %",	
			      "'.$stock.'",
			      "'.$botones.'"
			    ],';

		  }

		  $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   '] 

		 }';
		
		echo $datosJson;


	

	}	
}
$productos = new InventarioAjax();
$productos->MostrarProdcutos();
