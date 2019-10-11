<?php
require_once 'models/Usuario.php';

class UsuarioController{
	
	public function Index() {
		$usuarios = new Usuario();
		$listaUsuario = $usuarios->MostrarTodos();
		require_once 'views/layout/menu.php';
		require_once 'views/usuario/listausuario.php';
	}
	public function Login() {
		if($_POST){
			
			$nombre = $_POST['nombre'];
			$password = $_POST['password'];			
			if($nombre && $password){
				
				$usuario = new Usuario();
				$usuario->setNombre($nombre);
				$usuario->setPassword($password);
				
				$identity = $usuario->Login();
				
				if ($identity && is_object($identity)) {
					
					$_SESSION['identity'] = $identity;
					
					if($_SESSION['identity']->estado == 1){
						echo'<script>

						swal({
							  type: "success",
							  title: "Acces exitoso",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
								if (result.value) {

								window.location = "'. URL_BASE .'frontend/principal";

								}
							})

						</script>';
						//header("location:" . URL_BASE . "frontend/principal");
					} else {
						echo'<script>

								swal({
									  type: "error",
									  title: "¡Credenciales de acceso incorrectas !",
									  showConfirmButton: true,
									  confirmButtonText: "Cerrar"
									  }).then(function(result){
										if (result.value) {

										window.location = "'. URL_BASE.'";

										}
									})

							</script>';
					}
					
				} else {

					echo'<script>

								swal({
									  type: "error",
									  title: "¡Credenciales de acceso incorrectas !",
									  showConfirmButton: true,
									  confirmButtonText: "Cerrar"
									  }).then(function(result){
										if (result.value) {

										window.location = "'. URL_BASE.'";

										}
									})

							</script>';
				}
			}
		}else{
			echo'<script>

								swal({
									  type: "error",
									  title: "¡Credenciales de acceso incorrectas !",
									  showConfirmButton: true,
									  confirmButtonText: "Cerrar"
									  }).then(function(result){
										if (result.value) {

										window.location = "'. URL_BASE.'";

										}
									})

							</script>';
		}
	}
	public function Guardar() {
		if (isset($_POST)) {
			
			$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
			$pass = isset($_POST['password']) ? $_POST['password'] : false;
			$tipo = isset($_POST['tipo']) ? $_POST['tipo'] : false;
			$estado = isset($_POST['estado']) ? $_POST['estado'] : false;
			
			if($nombre && $pass && $tipo && $estado){
				
				$usuario = new Usuario();
				
				$usuario->setNombre($nombre);
				
				$password = password_hash($pass, PASSWORD_BCRYPT, ['cost' => 4]);
				$usuario->setPassword($password);
				$usuario->setTipo($tipo);
				$usuario->setEstado($estado);
											
				
				$save = $usuario ->save();
				
				//var_dump($save);
				
				if($save){
					
					echo'<script>

					swal({
						  type: "success",
						  title: "Usuario ha sido guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "index";

							}
						})

					</script>';
					
				}else{
					echo'<script>

					swal({
						  type: "error",
						  title: "¡No se puedo registrar Usuario!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "registro";

							}
						})

			  	</script>';

			  	return;
				}
				
			}			
			//header('location:index');
			
		}
	}
	public function Salir() {
		if(isset($_SESSION['identity'])){
			unset($_SESSION['identity']);
		}
		//header('Location:'.URL_BASE);
		echo'<script>
				window.location="' . URL_BASE .'";
			</script>';
	}
}