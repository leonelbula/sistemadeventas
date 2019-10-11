<?php
require_once 'models/Inventario.php';
require_once 'models/CompraProducto.php';
require_once 'models/CompraProveedor.php'; 
require_once 'models/Parametros.php'; 
require_once 'models/Compra.php'; 
require_once 'models/Plazo.php';
require_once 'models/Proveedor.php';


class ComprasController{
	public function Compras() {
		require_once 'views/layout/menu.php';
		if(isset($_GET["fechaInicial"])){
			
			$fechaInicial = $_GET["fechaInicial"];
            $fechaFinal = $_GET["fechaFinal"];
			
			$compra = new Compra();
			$listaCompra =$compra->ReportesCompras($fechaInicial,$fechaFinal);	
		}else{
			$compra = new Compra();
			$listaCompra = $compra->MostrarCompras();	
		}		
		require_once 'views/compras/listacompra.php';
		require_once 'views/layout/copy.php';
	}
	public function Nuevacompra() {
		require_once 'views/layout/menu.php';
		require_once 'views/compras/nuevaCompra.php';		
		require_once 'views/layout/copy.php';
		
	}
	public function Editarcompra() {
		if(isset($_GET['id']) && !empty($_GET['id'])){
			require_once 'views/layout/menu.php';
			$id = $_GET['id'];
			$compra = new Compra();
			$compra->setId($id);
			$destallesCompra = $compra->VerCompra();
			
			require_once 'views/compras/editarCompra.php';		
			require_once 'views/layout/copy.php';
		}else{
			echo'<script>

					swal({
						  type: "error",
						  title: "¡No a Elegido una venta !",
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
	public function GuardarCompra() {
		
		if(isset($_POST['proveedorCompraN'])&& !empty($_POST['proveedorCompraN'])){
			
			$datosParramentros  = new Parametros();
			$detallesParrametros = $datosParramentros->MostrarParrametro();			
			
			while ($row1 = $detallesParrametros-> fetch_object()) {
				$estadoIva = $row1->iva_incluido;				
			}
					
			
			$codigo = $_POST['numFactura'];
				
			
			$listaProductos = json_decode($_POST["listaProductos"], true);
					
			
			foreach ($listaProductos as $key => $value) {

			   //array_push($totalProductosComprados, $value["cantidad"]);
				$costo = $value['precio'];				
				$cantidadC = $value['cantidad'];
				$subTotal = $value['subtotal'];
				$impuestoItem = $value['impuesto'];
				$fechacompra = date('Y-m-d');
				
				$producto = new Inventario();
				$id_producto = $value["id"];
				
				$producto->setId_producto($id_producto);
				$respuest = $producto->VercantidadProducto();
				while ($row = $respuest-> fetch_object()) {
					$cantidad = $row->can_inicial;
				}
				
				$nuevCantidad = $cantidad + $cantidadC;
				
				$producto->setCantidad_Inicial($nuevCantidad);
				$producto->ActulizarStock();
				
				$productoCompra = new CompraProduto();
				$productoCompra->setId_producto($id_producto);
				$productoCompra->setCantidad($cantidadC);
				$productoCompra->setNum_factura($codigo);
				$productoCompra->setFecha($fechacompra);
				
				$productoCompra->CompraProductoRealizada();
								
							
			}
			
			
			$subTotalCompra = (int)$_POST['SubCompra'];
			$impuesto = (int)$_POST['ivaVenta'];			
			$valorCompra = (int)$_POST['totalCompra'];
			$detalle_compra = $_POST["listaProductos"];
			
			$id_proveedor = (int)$_POST['proveedorCompraN'];
			
			$compraProveedor = new CompraProveedor();
			$compraProveedor->setId_Proveedor($id_proveedor);
			$compraProveedor->setValor($valorCompra);
			$compraProveedor->setFecha($fechacompra);
			$compraProveedor->setNum_factura($codigo);
			$compraProveedor->NuevaCompraRealizada();
			
			
			
			$tipo = (int)$_POST['tipoventa'];
			
			if($tipo == 1){
				$id_plazo = (int)$_POST['plazos'];
				
				$plazoinf = new Plazo();
				$plazoinf->setId($id_plazo);
				$detallesPlazo = $plazoinf->MostrarPlazoId();
				
				while ($row3 = $detallesPlazo->fetch_object()) {
					$dias = $row3->num_dias;
				}
				
				$fecha = date('Y-m-d');
				$fechaActual = strtotime('+'.$dias.' day', strtotime($fecha));
				$fecha_vencimiento = date('Y-m-d', $fechaActual);
				
				$saldo = $valorCompra;
				
			} else {
				$fecha = date('Y-m-d');
				$fecha_vencimiento = date('Y-m-d');					
				$id_plazo = 0;
				$saldo = 0;
			}
			$compra = new Compra();
			
			date_default_timezone_set('America/Bogota');
			
			$fechaActualFact = date('Y-m-d');
			$horaFactura = date('H:i:s');
			$compra->setCodigo($codigo);
			$compra->setFecha($fechaActualFact);
			$compra->setHora($horaFactura);
			$compra->setTipo($tipo);
			$compra->setId_plazo($id_plazo);			
			$compra->setFecha_vencimiento($fecha_vencimiento);
			$compra->setId_proveedor($id_proveedor);
			$compra->setDetalle_compra($detalle_compra);			
			$compra->setSub_total($subTotalCompra);
			$compra->setIva($impuesto);
			$compra->setTotal($valorCompra);
			$compra->setSaldo($saldo);
			
			
			
			$resp = $compra->GuardarCompra();
			
			if($resp){
				echo'<script>

					swal({
						  type: "success",
						  title: "Compra Guardada Correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "compras";

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
						  title: "¡No se puede guardar la Compra si seleccionar el cliente!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "nuevaventa";

							}
						})

		</script>';
		}
	}
	public function ActulizarCompra() {
		
		if($_POST['idCompra']){
			//var_dump($_POST);
			
			$datosParramentros  = new Parametros();
			$detallesParrametros = $datosParramentros->MostrarParrametro();			
			
			while ($row1 = $detallesParrametros-> fetch_object()) {
				$estadoIva = $row1->iva_incluido;
				
			}
			$id_compra = $_POST['idCompra'];
			//ver la venta anterios
			$compAnt = new Compra();
			$compAnt->setId($id_compra);
			$compAn = $compAnt->VerCompra();
			
			while ($row =$compAn->fetch_object()) {
				$listProductos = $row->detalle_compra;
				$num_factura = $row->numero_factura;
			}
			//eliminar los productos de la venta a modificar
			$compraProd = new CompraProduto();
			$compraProd->setNum_factura($num_factura);
			$compraProd->EliminarC();
			
			//actulizando la compra del cliente
			$valor =(int)$_POST['totalCompra'];
			$compraProveedor = new CompraProveedor();
			$compraProveedor->setNum_factura($num_factura);
			$compraProveedor->setValor($valor);
			$compraProveedor->ActulizarCompraRealizada();
		
			$listaProductos = json_decode($listProductos, true);
			//actulizamos los productos modidicados
			foreach ($listaProductos as $key => $value) {
				
				$producto = new Inventario();
				$id_producto = $value["id"];
				
				$producto->setId_producto($id_producto);
				$respuest = $producto->VercantidadProducto();
				
				while ($row = $respuest-> fetch_object()) {
					$cantidad = $row->can_inicial;
				}				
				$nuevCantidad = $cantidad - $value['cantidad'];
				
				$producto->setCantidad_Inicial($nuevCantidad);				
				$producto->ActulizarStock();				
				
			}
			//fin de actulizar productos
			if($_POST["listaProductos"] == ''){
				$detalle_compra = $listProductos;
			}else{
				$detalle_compra = $_POST["listaProductos"];
			}
			$listaProductos = json_decode($detalle_compra, true);
			//modificando las cantidades de los productos		
			$UtilidadP = 0;
			foreach ($listaProductos as $key => $value) {
			  
				$costo = $value['precio'];				
				$cantidadC = $value['cantidad'];
				$subTotal = $value['subtotal'];
				$impuestoItem = $value['impuesto'];
				$fechaventa = date('y-m-d');
				
				$producto = new Inventario();
				$id_producto = $value["id"];
				
				$producto->setId_producto($id_producto);
				$respuest = $producto->VercantidadProducto();
				while ($row = $respuest-> fetch_object()) {
					$cantidad = $row->can_inicial;
				}
				
				$nuevCantidad = $cantidad + $cantidadC;
				
				$producto->setCantidad_Inicial($nuevCantidad);
				$producto->ActulizarStock();
				
				$productoCompra = new CompraProduto();
				$productoCompra->setId_producto($id_producto);
				$productoCompra->setCantidad($cantidadC);
				$productoCompra->setNum_factura($num_factura);
				$productoCompra->setFecha($fechaventa);
				
				$productoCompra->CompraProductoRealizada();
								
							
			}
			
			
			$subTotalCompra = (int)$_POST['SubCompra'];
			$impuesto = (int)$_POST['ivaVenta'];			
			$valorCompra = (int)$_POST['totalCompra'];		
			
			
			$tipo = (int)$_POST['tipoventa'];
			
			if($tipo == 1){
				$id_plazo = $_POST['plazos'];
				
				$plazoinf = new Plazo();
				$plazoinf->setId($id_plazo);
				$detallesPlazo = $plazoinf->MostrarPlazoId();
				
				while ($row3 = $detallesPlazo->fetch_object()) {
					$dias = $row3->num_dias;
				}
				
				$fecha = date('Y-m-d');
				$fechaActual = strtotime('+'.$dias.' day', strtotime($fecha));
				$fecha_vencimiento = date('Y-m-d', $fechaActual);
				
			} else {
				$fecha = date('Y-m-d');
				$fecha_vencimiento = date('Y-m-d');					
				$id_plazo = 0;
			}
			date_default_timezone_set('America/Bogota');
			$fechaActualFact = date('Y-m-d H:i:s');
			$horaFactura = date('H:i:s');
			
			$compra= new Compra();
			$compra->setId($id_compra);			
			$compra->setFecha($fechaActualFact);
			$compra->setHora($horaFactura);
			$compra->setTipo($tipo);
			$compra->setId_plazo($id_plazo);			
			$compra->setFecha_vencimiento($fecha_vencimiento);			
			$compra->setDetalle_compra($detalle_compra);			
			$compra->setSub_total($subTotalCompra);
			$compra->setIva($impuesto);
			$compra->setTotal($valorCompra);
			
			$resp = $compra->Actulizar();
			
			if($resp){
				echo'<script>

					swal({
						  type: "success",
						  title: "Compra Actulizada Correctamente",
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
			
		}
	}
	public function EliminarCompra() {
		if(isset($_GET['id'])){
			$datosParramentros  = new Parametros();
			$detallesParrametros = $datosParramentros->MostrarParrametro();			
			
			while ($row1 = $detallesParrametros-> fetch_object()) {
				$estadoIva = $row1->iva_incluido;				
			}
			$id_venta = $_GET['id'];
			//ver la venta anterios
			$ventAnt = new Venta();
			$ventAnt->setId($id_venta);
			$ventaAn = $ventAnt->VerVenta();
			
			while ($row =$ventaAn->fetch_object()) {
				$listProductos = $row->detalle_venta;
				$num_factura = $row->codigo;
			}
			//eliminar los productos de la venta a modificar
			$ventaProd = new VentaProduto();
			$ventaProd->setNum_factura($num_factura);
			$ventaProd->EliminarV();
			
			//eliminando la compra del cliente			
			$compraCliente = new CompraCliente();
			$compraCliente->setNum_factura($num_factura);			
			$compraCliente->EliminarVenta();
		
			$listaProductos = json_decode($listProductos, true);
			
			foreach ($listaProductos as $key => $value) {
				
				$producto = new Inventario();
				$id_producto = $value["id"];
				
				$producto->setId_producto($id_producto);
				$respuest = $producto->VercantidadProducto();
				
				while ($row = $respuest-> fetch_object()) {
					$cantidad = $row->can_inicial;
				}				
				$nuevCantidad = $cantidad + $value['cantidad'];
				
				$producto->setCantidad_Inicial($nuevCantidad);				
				$producto->ActulizarStock();				
				
			}
			$venta = new Venta();
			$venta->setId($id_venta);
			$resp = $venta->EliminarVenta();
			if($resp){
				echo'<script>

					swal({
						  type: "success",
						  title: "Venta Eliminada Correctamente",
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
						  title: "¡Registro no Eliminado !",
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
	static public function VerCompra($codigo) {
		$cod = $codigo;
		$verVenta = new Venta();
		$verVenta->setCodigo($codigo);
		$datoventa = $verVenta->VerVentaCodigo();
		return $datoventa;
	}	
	public function ReporteCompra() {
		require_once 'views/layout/menu.php';
		if(isset($_GET["fechaInicial"])){
			
			$fechaInicial = $_GET["fechaInicial"];
            $fechaFinal = $_GET["fechaFinal"];
			
			$compra = new Compra();
			$listaCompra =$compra->ReportesCompras($fechaInicial,$fechaFinal);	
		}else{
			$compra = new Compra();
			$listaCompra = $compra->MostrarCompras();	
		}		

		require_once 'views/compras/reportes.php';		
		require_once 'views/layout/copy.php';
	}
	static public function VerComparaId($id) {
		$compra = new Compra();
		$compra->setId($id);
		$detalles = $compra->MostrarComprasId();
		return $detalles;
	}
}