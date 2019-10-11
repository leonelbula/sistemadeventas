<?php

require_once 'config/DataBase.php';

class Mesa{
	
	public $db;
	
	private $nombre;
	
	function getNombre() {
		return $this->nombre;
	}

	function setNombre($nombre) {
		$this->nombre = $nombre;
	}

	public function __construct() {
		$this->db = Database::connect();
	}
	public function ListarMesas() {
		$sql = "SELECT * FROM mesa ";
		$resul = $this->db->query($sql);
		return $resul;
	
	}
	public function Guardar() {
		$sql = "INSERT INTO mesa VALUES (NULL,'{$this->getNombre()}')";
		$resul = $this->db->query($sql);		
		$respt = FALSE;		
		if($resul){
			$respt = TRUE;
		}
		return $respt;
	}
}