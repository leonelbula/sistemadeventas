<?php

require_once 'config/DataBase.php';

class InicarVenta {

	public $db;
	
	private $id;
	private $fechainicio;
	private $fechacierre;
	private $basecaja;
	private $totalingresos;
	private $totalgastos;
	private $montoentregado;
	private $diferencia;
	private $estado;
	
	function getId() {
		return $this->id;
	}

	function getFechainicio() {
		return $this->fechainicio;
	}

	function getFechacierre() {
		return $this->fechacierre;
	}

	function getBasecaja() {
		return $this->basecaja;
	}

	function getTotalingresos() {
		return $this->totalingresos;
	}

	function getTotalgastos() {
		return $this->totalgastos;
	}

	function getMontoentregado() {
		return $this->montoentregado;
	}
	function getDiferencia() {
		return $this->diferencia;
	}

	function getEstado() {
		return $this->estado;
	}
	function setId($id) {
		$this->id = $id;
	}

	function setFechainicio($fechainicio) {
		$this->fechainicio = $fechainicio;
	}

	function setFechacierre($fechacierre) {
		$this->fechacierre = $fechacierre;
	}

	function setBasecaja($basecaja) {
		$this->basecaja = $basecaja;
	}

	function setTotalingresos($totalingresos) {
		$this->totalingresos = $totalingresos;
	}

	function setTotalgastos($totalgastos) {
		$this->totalgastos = $totalgastos;
	}

	function setMontoentregado($montoentregado) {
		$this->montoentregado = $montoentregado;
	}
	function setDiferencia($diferencia) {
		$this->diferencia = $diferencia;
	}

	function setEstado($estado) {
		$this->estado = $estado;
	}

	public function __construct() {
		$this->db = Database::connect();
	}
	
	public function MostrarCierres() {
		$sql = "SELECT * FROM iniciar_punto_venta  WHERE estado = 0";
		$resul = $this->db->query($sql);
		return $resul;
	}
	public function VerCierres() {
		$sql = "SELECT * FROM iniciar_punto_venta  WHERE id = {$this->getId()}";
		$resul = $this->db->query($sql);
		return $resul;
	}
	public function ventasActivas() {
		$sql = "SELECT * FROM iniciar_punto_venta  WHERE estado = 1";
		$resul = $this->db->query($sql);
		return $resul;
	}
	public function InicarVenta() {
		$sql = "INSERT INTO iniciar_punto_venta VALUES (NULL,'{$this->getFechainicio()}','{$this->getFechacierre()}',{$this->getBasecaja()},{$this->getTotalingresos()},"
		. "{$this->getTotalgastos()},{$this->getMontoentregado()},{$this->getDiferencia()},{$this->getEstado()})";
		$resul = $this->db->query($sql);
		$respt = FALSE;
		if($resul){
			$respt = TRUE;
		}
		return $respt;
	}
	public function CerrarVenta() {
		$sql = "UPDATE iniciar_punto_venta SET fecha_cierre='{$this->getFechacierre()}',totalingresos={$this->getTotalingresos()},totalgastos={$this->getTotalgastos()},"
		. "montoentregado={$this->getMontoentregado()},diferencia={$this->getDiferencia()}, estado={$this->getEstado()} WHERE id = {$this->getId()}";
		$resul = $this->db->query($sql);
		$respt = FALSE;
		if($resul){
			$respt = TRUE;
		}
		return $respt;
	}
}
