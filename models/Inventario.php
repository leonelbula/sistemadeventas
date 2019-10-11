<?php

//require_once 'ModeloBase.php';
require_once 'config/DataBase.php';

class Inventario {
	
	public $db;
	
	private $id_producto;
	private $codigo;
	private $nombre;
	private $costo;
	private $precio1;	
	private $utilidad1;	
	private $id_categoria;		
	private $cantidad_Inicial;	
	private $impuesto;
	private $precio_max_iva1;	
	private $imagen;
	private $codigo_vendedor;
	private $cantidad_minima;
	private $id_proveedor;

	function getId_producto() {
		return $this->id_producto;
	}

	function getCodigo() {
		return $this->codigo;
	}

	function getNombre() {
		return $this->nombre;
	}

	function getCosto() {
		return $this->costo;
	}

	function getPrecio1() {
		return $this->precio1;
	}

	function getUtilidad1() {
		return $this->utilidad1;
	}

	function getId_categoria() {
		return $this->id_categoria;
	}

	function getCantidad_Inicial() {
		return $this->cantidad_Inicial;
	}

	function getImpuesto() {
		return $this->impuesto;
	}

	function getPrecio_max_iva1() {
		return $this->precio_max_iva1;
	}

	function getImagen() {
		return $this->imagen;
	}

	function getCodigo_vendedor() {
		return $this->codigo_vendedor;
	}

	function getCantidad_minima() {
		return $this->cantidad_minima;
	}

	function getId_proveedor() {
		return $this->id_proveedor;
	}

	function setId_producto($id_producto) {
		$this->id_producto = $id_producto;
	}

	function setCodigo($codigo) {
		$this->codigo = $codigo;
	}

	function setNombre($nombre) {
		$this->nombre = $nombre;
	}

	function setCosto($costo) {
		$this->costo = $costo;
	}

	function setPrecio1($precio1) {
		$this->precio1 = $precio1;
	}

	function setUtilidad1($utilidad1) {
		$this->utilidad1 = $utilidad1;
	}

	function setId_categoria($id_categoria) {
		$this->id_categoria = $id_categoria;
	}

	function setCantidad_Inicial($cantidad_Inicial) {
		$this->cantidad_Inicial = $cantidad_Inicial;
	}

	function setImpuesto($impuesto) {
		$this->impuesto = $impuesto;
	}

	function setPrecio_max_iva1($precio_max_iva1) {
		$this->precio_max_iva1 = $precio_max_iva1;
	}

	function setImagen($imagen) {
		$this->imagen = $imagen;
	}

	function setCodigo_vendedor($codigo_vendedor) {
		$this->codigo_vendedor = $codigo_vendedor;
	}

	function setCantidad_minima($cantidad_minima) {
		$this->cantidad_minima = $cantidad_minima;
	}

	function setId_proveedor($id_proveedor) {
		$this->id_proveedor = $id_proveedor;
	}	


	public function __construct() {
		$this->db = Database::connect();
	}
	public function MostrarProductosId() {
		$sql = "SELECT * FROM product WHERE id = {$this->getId_producto()}";
		$resul = $this->db->query($sql);
		return $resul;
	}
	public function TotalProductos() {
		$sql = "SELECT COUNT(id) as total FROM product ";
		$resul = $this->db->query($sql);
		return $resul;
	}
	public function MostrarProductos() {
		$sql = "SELECT * FROM product ORDER by ventas DESC ";
		$resul = $this->db->query($sql);
		return $resul;
	}
	public function MostrarUltimoProductos() {
		$sql = "SELECT p.id , p.codigo FROM product p ORDER by id DESC LIMIT 1";
		$resul = $this->db->query($sql);
		return $resul;
	}
	public function Guardar() {
		$sql = "INSERT INTO product VALUES(NULL,{$this->getId_proveedor()}, '{$this->getCodigo()}','{$this->getNombre()}',{$this->getCosto()},"
		. "{$this->getPrecio1()},{$this->getUtilidad1()},{$this->getId_categoria()},{$this->getCantidad_Inicial()},"
		. "{$this->getImpuesto()},'{$this->getImagen()}','{$this->getCodigo_vendedor()}',{$this->getCantidad_minima()},{$this->getPrecio_max_iva1()}"
		. ")";
		$resp = $this->db->query($sql);
		$resul = FALSE;
		if($resp){
			$resul = TRUE;
		}
		return $resul;
	}
	public function Actulizar() {
		$sql = "UPDATE product SET id_vendor = {$this->getId_proveedor()}, codigo='{$this->getCodigo()}',nombre='{$this->getNombre()}',costo={$this->getCosto()},"
		. "precio_1={$this->getPrecio1()},utilidad_1={$this->getUtilidad1()},id_categoria={$this->getId_categoria()},can_inicial={$this->getCantidad_Inicial()},"
		. "impuesto={$this->getImpuesto()},imagen='{$this->getImagen()}',codigo_fabr='{$this->getCodigo_vendedor()}',cantidad_min={$this->getCantidad_minima()},precio_v_iva1={$this->getPrecio_max_iva1()} WHERE id = {$this->getId_producto()}";
		$resp = $this->db->query($sql);
		$resul = FALSE;
		if($resp){
			$resul = TRUE;
		}
		return $resul;

	}
	public function Eliminar() {
		$sql = "DELETE FROM product WHERE id = {$this->getId_producto()}";
		$resp = $this->db->query($sql);
		$resul = FALSE;
		if($resp){
			$resul = TRUE;
		}
		return $resul;
	}
	public function VercantidadProducto() {
		$sql = "SELECT can_inicial FROM product WHERE id = {$this->getId_producto()}";
		$resp = $this->db->query($sql);		
		return $resp;
	}
	public function ActulizarStock() {
		$sql = "UPDATE product SET can_inicial={$this->getCantidad_Inicial()}  WHERE id = {$this->getId_producto()}";
		$resp = $this->db->query($sql);
		$resul = FALSE;
		if($resp){
			$resul = TRUE;
		}
		return $resul;
	}
	public function VentaProductos() {
		$sql = "SELECT p.nombre, COUNT(v.cantidad) AS cantidad FROM vanta_producto v INNER JOIN product p ON v.id_producto=p.id GROUP BY v.id_producto";
		$resp = $this->db->query($sql);		
		return $resp;
	}
	public function ValorInventario() {
		$sql = "SELECT SUM(costo*can_inicial) as resultado FROM product";
		$resp = $this->db->query($sql);		
		return $resp;
	}
}