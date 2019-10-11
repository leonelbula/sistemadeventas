<?php

require_once 'config/DataBase.php';

class Venta{
	
	public $db;
	
	private $id;	
	private $codigo;
	private $fecha;
	private $hora;
	private $tipo;
	private $id_plazo;
	private $fecha_vencimiento;
	private $id_cliente;
	private $detalle_venta;
	private $sub_total;
	private $iva;
	private $total;
	private $saldo;
	private $utilidad;
	
	function getId() {
		return $this->id;
	}

	function getCodigo() {
		return $this->codigo;
	}

	function getFecha() {
		return $this->fecha;
	}
	function getHora() {
		return $this->hora;
	}

	function getTipo() {
		return $this->tipo;
	}

	function getId_plazo() {
		return $this->id_plazo;
	}

	function getFecha_vencimiento() {
		return $this->fecha_vencimiento;
	}

	function getId_cliente() {
		return $this->id_cliente;
	}

	function getDetalle_venta() {
		return $this->detalle_venta;
	}

	function getSub_total() {
		return $this->sub_total;
	}

	function getIva() {
		return $this->iva;
	}

	function getTotal() {
		return $this->total;
	}
	function getSaldo() {
		return $this->saldo;
	}

	function getUtilidad() {
		return $this->utilidad;
	}

	function setId($id) {
		$this->id = $id;
	}

	function setCodigo($codigo) {
		$this->codigo = $codigo;
	}

	function setFecha($fecha) {
		$this->fecha = $fecha;
	}
	function setHora($hora) {
		$this->hora = $hora;
	}

	function setTipo($tipo) {
		$this->tipo = $tipo;
	}

	function setId_plazo($id_plazo) {
		$this->id_plazo = $id_plazo;
	}

	function setFecha_vencimiento($fecha_vencimiento) {
		$this->fecha_vencimiento = $fecha_vencimiento;
	}

	function setId_cliente($id_cliente) {
		$this->id_cliente = $id_cliente;
	}

	function setDetalle_venta($detalle_venta) {
		$this->detalle_venta = $detalle_venta;
	}

	function setSub_total($sub_total) {
		$this->sub_total = $sub_total;
	}

	function setIva($iva) {
		$this->iva = $iva;
	}

	function setTotal($total) {
		$this->total = $total;
	}
	function setSaldo($saldo) {
		$this->saldo = $saldo;
	}

	function setUtilidad($utilidad) {
		$this->utilidad = $utilidad;
	}

	public function __construct() {
		$this->db = Database::connect();
	}
	public function MostrarVentas() {
		$sql = "SELECT * FROM venta  ORDER BY id DESC";
		$resul = $this->db->query($sql);
		return $resul;
	}	
	public function TotalVentas() {
		$sql = "SELECT SUM(total) as total FROM venta";
		$resul = $this->db->query($sql);
		return $resul;
	}
	public function TotalUtilidad() {
		$sql = "SELECT SUM(utilidad) as total FROM venta";
		$resul = $this->db->query($sql);
		return $resul;
	}
	public function MostrarVentasCliente() {
		$sql = "SELECT id_cliente, SUM(total) AS total,SUM(saldo) AS saldo FROM venta GROUP BY id_cliente";
		$resul = $this->db->query($sql);
		return $resul;
	}
	public function MostrarComprasCliente() {
		$sql = "SELECT * FROM venta WHERE id_cliente = {$this->getId_cliente()}";
		$resul = $this->db->query($sql);
		return $resul;
	}
	public function MostrarVentasId() {
		$sql = "SELECT * FROM venta WHERE id = {$this->getId()}";
		$resul = $this->db->query($sql);
		return $resul;
	}
	public function GuardarVenta() {
		$sql = "INSERT INTO venta VALUES (NULL,{$this->getCodigo()},'{$this->getFecha()}','{$this->getHora()}',{$this->getTipo()},"
		. "{$this->getId_plazo()},'{$this->getFecha_vencimiento()}',{$this->getId_cliente()},'{$this->getDetalle_venta()}',"
		. "{$this->getSub_total()},{$this->getIva()},{$this->getTotal()},{$this->getSaldo()},{$this->getUtilidad()})";
		$resp = $this->db->query($sql);
		$resul = FALSE;
		if($resp){
			$resul = TRUE;
		}
		return $resul;
	}
	public function VerUltimaVenta() {
		$sql = "SELECT * FROM venta ORDER BY id DESC LIMIT 1";
		$resp = $this->db->query($sql);
		return $resp;
	}
	public function VerVenta() {
		$sql = "SELECT * FROM venta WHERE id = {$this->getId()}";
		$resp = $this->db->query($sql);
		return $resp;
	}
	public function Actulizar() {
		$sql = "UPDATE venta SET fecha='{$this->getFecha()}',hora='{$this->getHora()}',tipo={$this->getTipo()},id_plazo={$this->getId_plazo()},"
		. "fecha_vencimiento='{$this->getFecha_vencimiento()}',detalle_venta='{$this->getDetalle_venta()}',"
		. "sub_total={$this->getSub_total()},iva={$this->getIva()},total={$this->getTotal()},saldo={$this->getSaldo()},utilidad={$this->getUtilidad()} WHERE id = {$this->getId()}";
		$resp = $this->db->query($sql);
		$resul = FALSE;
		if($resp){
			$resul = TRUE;
		}
		return $resul;
	}
	public function EliminarVenta() {
		$sql = "DELETE FROM venta WHERE id = {$this->getId()}";
		$resp = $this->db->query($sql);
		$resul = FALSE;
		if($resp){
			$resul = TRUE;
		}
		return $resul;
	}
	public function VerVentaCodigo() {
		$sql = "SELECT * FROM venta WHERE codigo = {$this->getCodigo()}";
		$resul = $this->db->query($sql);
		return $resul;
	}
	public function ReportesVentas($fechaInicial,$fechaFinal) {
		
		
		if($fechaInicial == $fechaFinal){
			
			$sql = "SELECT * FROM venta WHERE fecha like '%$fechaFinal%'";
			
		} else {
			
			$fechaActual = new DateTime();
			$fechaActual->add(new DateInterval("P1D"));
			$fechaActualMasUno = $fechaActual->format("Y-m-d");

			$fechaFinal2 = new DateTime($fechaFinal);
			$fechaFinal2->add(new DateInterval("P1D"));
			$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

			if ($fechaFinalMasUno == $fechaActualMasUno) {

				$sql = "SELECT * FROM venta WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'";
			} else {

				$sql = "SELECT * FROM venta WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal'";
			}
		}
		
		
		$resul = $this->db->query($sql);
		return $resul;
	}
	public function MostrarSumaVentas(){
		$sql = "SELECT SUM(total) as total FROM venta";
		$resul = $this->db->query($sql);
		return $resul;
		
	}
	public function Abonar() {
		$sql = "UPDATE venta SET saldo = {$this->getSaldo()} WHERE id = {$this->getId()}";
		$resp = $this->db->query($sql);
		$result = FALSE;
		if($resp){
			$result = TRUE;
		}
		return $result;
	}
}

