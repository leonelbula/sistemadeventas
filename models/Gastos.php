<?php

require_once 'config/DataBase.php';

class Gastos{
	
	public $db;
	private $id;
	private $fecha;
	private $descripcion;
	private $valor;
	
	function getId() {
		return $this->id;
	}

	function getFecha() {
		return $this->fecha;
	}

	function getDescripcion() {
		return $this->descripcion;
	}

	function getValor() {
		return $this->valor;
	}

	function setId($id) {
		$this->id = $id;
	}

	function setFecha($fecha) {
		$this->fecha = $fecha;
	}

	function setDescripcion($descripcion) {
		$this->descripcion = $descripcion;
	}

	function setValor($valor) {
		$this->valor = $valor;
	}

	public function __construct() {
		$this->db = Database::connect();
	}
	public function MostrarGastos() {
		$sql = "SELECT * FROM gastos ORDER BY id DESC";
		$resul = $this->db->query($sql);
		return $resul;
	}
	public function TotalGastos() {
		$sql = "SELECT SUM(valor) as total FROM gastos";
		$resul = $this->db->query($sql);
		return $resul;
	}
	public function MostrarGastoId() {
		$sql = "SELECT * FROM gastos WHERE id = {$this->getId()}";
		$resul = $this->db->query($sql);
		return $resul;
	}
	public function Guardar() {
		$sql = "INSERT INTO gastos VALUES (NULL,'{$this->getFecha()}','{$this->getDescripcion()}',{$this->getValor()})";
		$resul = $this->db->query($sql);
		$respt = FALSE;
		
		if($resul){
			$respt = TRUE;
		}
		return $respt;
	}
	public function Actulizar() {
		$sql = "UPDATE gastos SET fecha='{$this->getFecha()}',descripcion='{$this->getDescripcion()}',valor={$this->getValor()} WHERE id = {$this->getId()}";
		$resul = $this->db->query($sql);
		$respt = FALSE;
		
		if($resul){
			$respt = TRUE;
		}
		return $respt;
	}
	public function Eliminar() {
		$sql = "DELETE FROM gastos WHERE id = {$this->getId()}";
		$resul = $this->db->query($sql);
		$respt = FALSE;
		
		if($resul){
			$respt = TRUE;
		}
		return $respt;
	}
}

