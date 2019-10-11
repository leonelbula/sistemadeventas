<?php

require_once 'models/Inventario.php';
require_once 'models/Parametros.php';

class InventarioController {

	public function Index() {

		require_once 'views/layout/menu.php';
		$productos = new Inventario();
		require_once 'views/inventario/inventario.php';
		require_once 'views/layout/copy.php';
	}
	static public function ListaParrametros() {
		$par = new Parametros();
		$listaParra = $par->MostrarParrametro();
		return $listaParra;
	}
	static public function ListaProductos() {
		$productos = new Inventario();
		$listaProducto = $productos->MostrarProductos();
		return $listaProducto;
	}
	static public function VerProdutoId($id) {
		$producto = new Inventario();
		$producto->setId_producto($id);
		$resp = $producto->MostrarProductosId();
		return$resp;
	}
	public function registrar() {
		require_once 'views/layout/menu.php';
		require_once 'views/inventario/registrar.php';
		require_once 'views/layout/copy.php';
	}	
	public function GuardarProducto() {
		if(isset($_POST)){
			$codigoD = isset($_POST['codigo']) ? $_POST['codigo']:FALSE;
			$costo = isset($_POST['costo']) ? $_POST['costo']:FALSE;
			$nombre = isset($_POST['nombre']) ? $_POST['nombre']:FALSE;			
			$utilidad1 = isset($_POST['Utilidad1'])? $_POST['Utilidad1']:FALSE;				
			$id_categoria = isset($_POST['idcategoria'])? $_POST['idcategoria']:FALSE;
			$cantidad_minima = isset($_POST['cantidamin'])? $_POST['cantidamin']:FALSE;			
			$cantidainicial = isset($_POST['cantidainicial'])? $_POST['cantidainicial']:FALSE;			
			$medida = isset($_POST['sevende'])? $_POST['sevende']:FALSE;
			$impuesto = isset($_POST['impuesto'])? $_POST['impuesto']:FALSE;	
			$codigo_vendedor = isset($_POST['codigo_vendedor'])? $_POST['codigo_vendedor']:FALSE;						
			$id_proveedor = isset($_POST['id_vendedor'])? $_POST['id_vendedor']:FALSE;
				
			if($costo && $nombre && $utilidad1){
				$par = new Parametros();
				$listaParra = $par->MostrarParrametro();
				while ($row = $listaParra->fetch_object()) {
					$estadoCodigo = $row->generar_codigo;
					$codigo = $row->codigo_prod;
				}
				if($estadoCodigo == 1){
					$producto = new Inventario();
					$ultimoproducto = $producto->MostrarUltimoProductos();
					while ($row1 = $ultimoproducto-> fetch_object()) {
						$utilimoCodigo = $row1->codigo;
					}					
					$codigoprod = $utilimoCodigo + 1;
					
				}else{
					$codigoprod = $codigoD;
				}
				$precio_1 = ($costo + ($costo * $utilidad1/100));				
				
				if($impuesto != 0){
					$precio_max_iva1 = ($precio_1 + ($precio_1 * $impuesto/100));
					
					
				}else{
					$precio_max_iva1 = $precio_1;
					
				}
				$producto = new Inventario();
				$producto->setCodigo($codigoprod);				
				$producto->setCosto($costo);
				$producto->setNombre(strtolower($nombre));
				$producto->setPrecio1(intval($precio_1));			
				$producto->setUtilidad1($utilidad1);				
				$producto->setId_categoria($id_categoria);				
				$producto->setCantidad_Inicial($cantidainicial);
				$producto->setImpuesto($impuesto);
				$producto->setCantidad_minima($cantidad_minima);
				$producto->setCodigo_vendedor($codigo_vendedor);
				$producto->setPrecio_max_iva1(intval($precio_max_iva1));
				$producto->setId_proveedor($id_proveedor);
				
				
				$file = $_FILES['foto'];
				$type = $file['type'];
				$nomImg = $file['name'];
				
				$dir = 'imagen/producto';
				if ($nomImg != '') {
					if ($type == 'image/png' || $type == 'image/jpg' || $type == 'image/jpeg') {
						if (!is_dir($dir)) {
							mkdir($dir, 0777, TRUE);
						}
						$producto->setImagen($nomImg);
						move_uploaded_file($file['tmp_name'], $dir . '/' . $nomImg);
					}
				}else{
					$imagen = '';
					$producto->setImagen($imagen);
				}
				$resp = $producto->Guardar();
				
				if($resp){
					echo'<script>

					swal({
						  type: "success",
						  title: "Producto Guardado Correctamente",
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
				
			}else{
				echo'<script>

					swal({
						  type: "error",
						  title: "¡Debe llenar los campos Obligatorios!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "index";

							}
						})

			  	</script>';
			}
			
			
		}else{
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
	public function Editar() {
		if($_GET['id']){
			require_once 'views/layout/menu.php';
			$id_producto = $_GET['id'];
			$producto = new Inventario();
			$producto->setId_producto($id_producto);
			$detallesProductos = $producto->MostrarProductosId();
			
			require_once 'views/inventario/editar.php';
			require_once 'views/layout/copy.php';
		} else {
			echo'<script>

					swal({
						  type: "error",
						  title: "¡No A seleccionado un producto !",
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
	public function ActualizarProducto() {
		if($_POST['id_producto']){
			$id_producto = $_POST['id_producto'];
			$codigoD = isset($_POST['codigo']) ? $_POST['codigo']:FALSE;
			$costo = isset($_POST['costo']) ? $_POST['costo']:FALSE;
			$nombre = isset($_POST['nombre']) ? $_POST['nombre']:FALSE;			
			$utilidad1 = isset($_POST['Utilidad1'])? $_POST['Utilidad1']:FALSE;
			$id_categoria = isset($_POST['idcategoria'])? $_POST['idcategoria']:FALSE;
			$cantidad_minima = isset($_POST['cantidamin'])? $_POST['cantidamin']:FALSE;			
			$cantidainicial = isset($_POST['cantidainicial'])? $_POST['cantidainicial']:FALSE;			
			$impuesto = isset($_POST['impuesto'])? $_POST['impuesto']:FALSE;	
			$codigo_vendedor = isset($_POST['codigo_vendedor'])? $_POST['codigo_vendedor']:FALSE;					
			$id_proveedor = isset($_POST['id_vendedor'])? $_POST['id_vendedor']:FALSE;
			
			if($costo && $nombre ){
				$par = new Parametros();
				$listaParra = $par->MostrarParrametro();
				while ($row = $listaParra->fetch_object()) {
					$estadoCodigo = $row->generar_codigo;
					$codigo = $row->codigo_prod;
				}
				if($estadoCodigo == 1){
					$codigoprod = $codigo + 1;
				}else{
					$codigoprod = $codigoD;
				}
				$precio_1 = ($costo + ($costo * $utilidad1/100));				
				
				if($impuesto != 0){
					$precio_max_iva1 = ($precio_1 + ($precio_1 * $impuesto/100));
					
					
				}else{
					$precio_max_iva1 = $precio_1;
					
				}
				$producto = new Inventario();
				$producto->setId_producto($id_producto);
				$producto->setCodigo($codigoprod);				
				$producto->setCosto($costo);
				$producto->setNombre(strtolower($nombre));
				$producto->setPrecio1(intval($precio_1));				
				$producto->setUtilidad1($utilidad1);				
				$producto->setId_categoria($id_categoria);				
				$producto->setCantidad_Inicial($cantidainicial);
				$producto->setImpuesto($impuesto);
				$producto->setCantidad_minima($cantidad_minima);
				$producto->setCodigo_vendedor($codigo_vendedor);
				$producto->setPrecio_max_iva1(intval($precio_max_iva1));
				$producto->setId_proveedor($id_proveedor);
				
				$file = $_FILES['foto'];
				$type = $file['type'];
				$nomImg = $file['name'];
				
				$dir = 'imagen/producto';
				if ($nomImg != '') {
					if ($type == 'image/png' || $type == 'image/jpg' || $type == 'image/jpeg') {
						if (!is_dir($dir)) {
							mkdir($dir, 0777, TRUE);						
						}
						if (!empty($_POST['actualfoto'])){
							unlink($dir.'/'.$_POST['actualfoto']);
						}
						$producto->setImagen($nomImg);
						move_uploaded_file($file['tmp_name'], $dir . '/' . $nomImg);
					}
				} else {
					$imagen = $_POST['actualfoto'];
					$producto->setImagen($imagen);
				}
				$resp = $producto->Actulizar();
				
				if ($resp) {
					echo'<script>

					swal({
						  type: "success",
						  title: "Producto Editado Correctamente",
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
			} else {
				echo'<script>

					swal({
						  type: "error",
						  title: "¡Debe llenar los campos Obligatorios!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "index";

							}
						})

			  	</script>';
			}
		} else {
			echo'<script>

					swal({
						  type: "error",
						  title: "¡No A seleccionado un producto !",
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
	public function Eliminar() {
		if ($_GET['id']){
			$id_producto = $_GET['id'];
			$producto = new Inventario();
			$producto->setId_producto($id_producto);
			$detalles = $producto->MostrarProductosId();
			while ($row = $detalles->fetch_object()) {
				$imagen = $row->imagen;
			}
			$dir = 'imagen/producto';
			
			if(!empty($imagen)){
				unlink($dir.'/'.$imagen);
			}
			$resp = $producto->Eliminar();
			
			if($resp){
				echo'<script>

					swal({
						  type: "success",
						  title: "Producto Eliminado Correctamente",
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
						  title: "¡Al Eliminar producto !",
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
	public function Ver() {
		require_once 'views/layout/menu.php';
		if($_GET['id']){
			$id_producto = $_GET['id'];
			$productos = new Inventario();
			$productos->setId_producto($id_producto);
			$detallesPro = $productos->MostrarProductosId();
			require_once 'views/inventario/ver.php';
		}else{
			echo'<script>

					swal({
						  type: "error",
						  title: "¡Al Ver producto !",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "index";

							}
						})

			  	</script>';
		}
				
		require_once 'views/layout/copy.php';
	}
}
