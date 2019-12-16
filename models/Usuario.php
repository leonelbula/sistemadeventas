<?php

require_once 'config/DataBase.php';

class Usuario{
	
	public $db;
	private $id_usuario;
	private $nombre;
	private $password;
	private $estado;
	private $tipo;
	
	function getId_usuario() {
		return $this->id_usuario;
	}

	function getNombre() {
		return $this->nombre;
	}

	function getPassword() {
		return $this->password;
	}

	function getEstado() {
		return $this->estado;
	}

	function getTipo() {
		return $this->tipo;
	}

	function setId_usuario($id_usuario) {
		$this->id_usuario = $id_usuario;
	}

	function setNombre($nombre) {
		$this->nombre = $this->db->real_escape_string($nombre);
	}

	function setPassword($password) {
		$this->password = $password;
	}

	function setEstado($estado) {
		$this->estado = $estado;
	}

	function setTipo($tipo) {
		$this->tipo = $tipo;
	}

	public function __construct() {
		$this->db = Database::connect();
	}
	public function MostrarTodos() {
		$sql = "SELECT * FROM usuarios ";
		$resul = $this->db->query($sql);
		return $resul;
	}
	public function MostrarUsuarioId() {
		$sql = "SELECT * FROM usuarios WHERE id_usuario = {$this->getId_usuario()}";
		$resul = $this->db->query($sql);
		return $resul;
	}
	public function save() {
		$sql = "INSERT INTO usuarios VALUE(NULL,'{$this->getNombre()}','{$this->getPassword()}','{$this->getEstado()}','{$this->getTipo()}')";
		$save = $this->db->query($sql);
		
		$resul = false;
		
		if($save){
			 $resul = true;
		}
		return $resul;
	}
	public function Actulizar() {
		$sql = "UPDATE usuarios SET nombre='{$this->getNombre()}',password='{$this->getPassword()}',estado={$this->getEstado()},tipo='{$this->getTipo()}' WHERE id_usuario = {$this->getId_usuario()}";
		$save = $this->db->query($sql);
		
		$resul = false;
		
		if($save){
			 $resul = true;
		}
		return $resul;
	}
	public function Eliminar() {
		$sql = "DELETE FROM usuarios WHERE id_usuario = {$this->getId_usuario()} ";
		$save = $this->db->query($sql);
		
		$resul = false;
		
		if($save){
			 $resul = true;
		}
		return $resul;
	}
	public function Login() {
		$result = FALSE;
		$nombre = $this->nombre;
		$password = $this->password;
			
		$sql = "SELECT * FROM usuarios WHERE nombre = '$nombre'";
		$login = $this->db->query($sql);
		
		if($login && $login->num_rows == 1){
			
			$usuario = $login->fetch_object();
			
			$verify = password_verify($password, $usuario->password);
			
			if($verify){
				$result = $usuario;
			}
		}
		return $result;
	}
}


