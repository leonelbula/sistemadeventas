<?php

require_once 'ModeloBase.php';

class Categoria extends ModeloBase{
	private $id_categoria;
	private $nombre;
			
	function getId_categoria() {
		return $this->id_categoria;
	}

	function getNombre() {
		return $this->nombre;
	}

	function setId_categoria($id_categoria) {
		$this->id_categoria = $id_categoria;
	}

	function setNombre($nombre) {
		$this->nombre = $nombre;
	}

	public function __construct() {
		parent::__construct();
	}
	public function MostrarCategoria() {
		$sql = "SELECT * FROM categoria";
		$resul = $this->db->query($sql);
		return $resul;
	}
	public function MostrarCategoriaId() {
		$sql = "SELECT * FROM categoria  WHERE id = {$this->getId_categoria()}";
		$resul = $this->db->query($sql);
		return $resul;
	}
	public function GuardarCategoria() {
		$sql = "INSERT INTO categoria VALUES (NULL,'{$this->getNombre()}')";
		$resul = $this->db->query($sql);
		$respt=FALSE;
		if($resul){
			$respt=TRUE;
		}
		return $respt;
	}
	public function EditarCategoria() {
		$sql = "UPDATE categoria SET nombre='{$this->getNombre()}' WHERE id = {$this->getId_categoria()}";
		$resul = $this->db->query($sql);
		$respt = FALSE;
		if($resul){
			$respt = TRUE;
		}
		return $respt;
	}
	public function EliminarCategoria() {
		$sql = "DELETE FROM categoria WHERE id = {$this->getId_categoria()}";
		$resul = $this->db->query($sql);
		$respt = FALSE;
		if($resul){
			$respt = TRUE;
		}
		return $respt;
	}
}