<?php

require_once 'models/Mesa.php';

class MesaController{
	public function index() {
		require_once 'views/layout/menu.php';
		$mesa = new Mesa();
		$listarMesa = $mesa->ListarMesas();
		require_once 'views/mesa/listarMesas.php';
		require_once 'views/layout/copy.php';
	}
	public function RegistrarMesa() {
		if($_POST){
			$nombre = isset($_POST['nombre']) ? $_POST['nombre']:FALSE;
			if($nombre){
				$mesa = new Mesa();
				$mesa->setNombre($nombre);
				
				$resp = $mesa->Guardar();
				
				if($resp){
					echo'<script>

					swal({
						  type: "success",
						  title: "Registro Guardada Correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "index";

							}
						})

					</script>';
				} else {
					echo'<script>

					swal({
						  type: "error",
						  title: "¡Registro no Guardado !",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "index";

							}
						})

			  	</script>';
				}
			}
		}
	}
}
