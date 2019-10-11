<?php

require_once 'config/DataBase.php';

class Parametros{
	
	public $db;
	
	private $id; 
	private $num_inicio_factura; 
	private $resolucion_dian; 
	private $impuesto_ventas; 
	private $iva_incluido; 
	private $num_nota_credito; 
	private $num_nota_debito;
	private $id_iva; 
	private $id_retefuente_compra; 
	private $generar_codigo;
	private $codigo_prod;
			
	function getId() {
		return $this->id;
	}

	function getNum_inicio_factura() {
		return $this->num_inicio_factura;
	}

	function getResolucion_dian() {
		return $this->resolucion_dian;
	}

	function getImpuesto_ventas() {
		return $this->impuesto_ventas;
	}

	function getIva_incluido() {
		return $this->iva_incluido;
	}

	function getNum_nota_credito() {
		return $this->num_nota_credito;
	}

	function getNum_nota_debito() {
		return $this->num_nota_debito;
	}

	function getId_iva() {
		return $this->id_iva;
	}

	function getId_retefuente_compra() {
		return $this->id_retefuente_compra;
	}

	function getGenerar_codigo() {
		return $this->generar_codigo;
	}
	function getCodigo_prod() {
		return $this->codigo_prod;
	}

	function setId($id) {
		$this->id = $id;
	}

	function setNum_inicio_factura($num_inicio_factura) {
		$this->num_inicio_factura = $num_inicio_factura;
	}

	function setResolucion_dian($resolucion_dian) {
		$this->resolucion_dian = $resolucion_dian;
	}

	function setImpuesto_ventas($impuesto_ventas) {
		$this->impuesto_ventas = $impuesto_ventas;
	}

	function setIva_incluido($iva_incluido) {
		$this->iva_incluido = $iva_incluido;
	}

	function setNum_nota_credito($num_nota_credito) {
		$this->num_nota_credito = $num_nota_credito;
	}

	function setNum_nota_debito($num_nota_debito) {
		$this->num_nota_debito = $num_nota_debito;
	}

	function setId_iva($id_iva) {
		$this->id_iva = $id_iva;
	}

	function setId_retefuente_compra($id_retefuente_compra) {
		$this->id_retefuente_compra = $id_retefuente_compra;
	}

	function setGenerar_codigo($generar_codigo) {
		$this->generar_codigo = $generar_codigo;
	}
	function setCodigo_prod($codigo_prod) {
		$this->codigo_prod = $codigo_prod;
	}

	public function __construct() {
		$this->db = Database::connect();
	}
	public function MostrarParrametro() {
		$sql = "SELECT * FROM parametros";
		$resul = $this->db->query($sql);
		return $resul;
	}
	
	public function ActualizarConfig() {
		$sql = "UPDATE parametros SET num_inicio_factura={$this->getNum_inicio_factura()},resolucion_dian='{$this->getResolucion_dian()}',"
				. "impuesto_ventas={$this->getImpuesto_ventas()},iva_incluido={$this->getIva_incluido()},num_nota_credito={$this->getNum_nota_credito()},"
				. "`num_nota_debito`={$this->getNum_nota_debito()},generar_codigo={$this->getGenerar_codigo()},codigo_prod={$this->getCodigo_prod()} WHERE id = {$this->getId()}";
		$resp = $this->db->query($sql);
		$result = FALSE;
		if($resp){
			$result = TRUE;
		}
		return $result;
	}
}