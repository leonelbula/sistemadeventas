<?php

require_once 'models/Inventario.php';
require_once 'models/VentaProducto.php';
require_once 'models/CompraCliente.php';
require_once 'models/Parametros.php';
require_once 'models/Venta.php';
require_once 'models/Plazo.php';
require_once 'models/Cliente.php';
require_once 'models/InicarVenta.php';
require_once 'models/Gastos.php';
require_once 'models/AbonosCliente.php';

class VentasController {

	public function listarventas() {
		require_once 'views/layout/menu.php';

		if (isset($_GET["fechaInicial"])) {

			$fechaInicial = $_GET["fechaInicial"];
			$fechaFinal = $_GET["fechaFinal"];

			$ventas = new Venta();
			$listaVentas = $ventas->ReportesVentas($fechaInicial, $fechaFinal);
		} else {
			$ventas = new Venta();
			$listaVentas = $ventas->MostrarVentas();
		}

		require_once 'views/ventas/listaventas.php';
		require_once 'views/layout/copy.php';
	}

	public function inicarventas() {
		require_once 'views/layout/menu.php';
		$iniciarventas = new InicarVenta();
		$detalles = $iniciarventas->ventasActivas();
		$listacierres = $iniciarventas->MostrarCierres();
		require_once 'views/ventas/iniciarVentas.php';
		require_once 'views/layout/copy.php';
	}

	public function vercierre() {
		require_once 'views/layout/menu.php';
		if ($_GET['id']) {
			$id = $_GET['id'];
			$cierre = new InicarVenta();
			$cierre->setId($id);
			$detalles = $cierre->VerCierres();
			require_once 'views/ventas/ver.php';
		} else {
			echo'<script>

					swal({
						  type: "error",
						  title: "¡No se puede mostrar cierre de  venta !",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "inicarventas";

							}
						})

			  	</script>';
		}

		require_once 'views/layout/copy.php';
	}

	public function guardarinicioventa() {
		if ($_POST['basecaja']) {
			$fechainicio = date('Y-m-d');
			$fechacierre = date('Y-m-d');
			$basecaja = $_POST['basecaja'];
			$totalingresos = 0;
			$totalgastos = 0;
			$montoentregado = 0;
			$diferencia = 0;
			$estado = 1;

			$inicioventa = new InicarVenta();

			$inicioventa->setFechainicio($fechainicio);
			$inicioventa->setFechacierre($fechacierre);
			$inicioventa->setBasecaja($basecaja);
			$inicioventa->setTotalingresos($totalingresos);
			$inicioventa->setTotalgastos($totalgastos);
			$inicioventa->setMontoentregado($montoentregado);
			$inicioventa->setDiferencia($diferencia);
			$inicioventa->setEstado($estado);
			$resp = $inicioventa->InicarVenta();

			if ($resp) {
				echo'<script>

					swal({
						  type: "success",
						  title: "Punto Venta iniciado  Correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "inicarventas";

							}
						})

					</script>';
			} else {
				echo'<script>

					swal({
						  type: "error",
						  title: "¡No se pudo inicar punto de venta !",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "inicarventas";

							}
						})

			  	</script>';
			}
		} else {
			echo'<script>

					swal({
						  type: "error",
						  title: "¡No a Elegido una venta !",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "inicarventas";

							}
						})

			  	</script>';
		}
	}

	public function guardarcierreventa() {
		require_once 'views/layout/menu.php';
		if ($_POST['caja']) {

			$fechacierre = date('Y-m-d');
			$montoentregado = (int) $_POST['caja'];


			$cerrarventa = new InicarVenta();

			$detalles = $cerrarventa->ventasActivas();

			while ($row = $detalles->fetch_object()) {
				$id = $row->id;
				$basecaja = (int) $row->basecaja;
				$fechainicio = $row->fecha_inicio;
			}

			$ventas = new Venta();
			$totalVentas = $ventas->Ventas($fechainicio, $fechacierre);
			while ($row1 = $totalVentas->fetch_object()) {
				$ventatotal = (int) $row1->total;
			}

			$abonos = new AbonosCliente();
			$totalAbonos = $abonos->AbonosDiarios($fechainicio, $fechacierre);

			while ($row3 = $totalAbonos->fetch_object()) {
				$valorAbonos = $row3->total;
			}

			$gastos = new Gastos();
			$totalGastos = $gastos->Gastos($fechainicio, $fechacierre);
			while ($row2 = $totalGastos->fetch_object()) {
				$gastoGenerado = (int) $row2->total;
			}

			$resultado1 = $montoentregado + $gastoGenerado;
			$montoDiario = $ventatotal + $valorAbonos;
			$diferencia = $resultado1 - $montoDiario;

			$resp = TRUE;


			require_once 'views/ventas/confirmarcierre.php';
			require_once 'views/layout/copy.php';
		} else {
			echo'<script>

					swal({
						  type: "error",
						  title: "¡No a Elegido una venta !",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "inicarventas";

							}
						})

			  	</script>';
		}
	}

	public function guardarcierre() {
		if ($_POST['id']) {
			$id = $_POST['id'];
			$fechacierre = date('Y-m-d');
			$totalingresos = $_POST['ventatotal'];
			$totalgastos = $_POST['gastototal'];
			$montoentregado = $_POST['montoentregado'];
			$diferencia = $_POST['diferencia'];
			$estado = 0;

			$cierre = new InicarVenta();

			$cierre->setId($id);
			$cierre->setFechacierre($fechacierre);
			$cierre->setTotalingresos($totalingresos);
			$cierre->setMontoentregado($montoentregado);
			$cierre->setTotalgastos($totalgastos);
			$cierre->setDiferencia($diferencia);
			$cierre->setEstado($estado);

			$resp = $cierre->CerrarVenta();

			if ($resp) {
				echo'<script>

					swal({
						  type: "success",
						  title: "Punto Venta cerrado Correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "inicarventas";

							}
						})

					</script>';
			} else {
				echo'<script>

					swal({
						  type: "error",
						  title: "¡No se pudo generar ciere de venta !",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "inicarventas";

							}
						})

			  	</script>';
			}
		} else {
			echo'<script>

					swal({
						  type: "error",
						  title: "¡En cierre de venta !",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "inicarventas";

							}
						})

			  	</script>';
		}
	}

	public function Nuevaventa() {
		require_once 'views/layout/menu.php';
		require_once 'views/ventas/nuevaVenta.php';
		require_once 'views/layout/copy.php';
	}

	public function EditarVenta() {
		if (isset($_GET['id']) && !empty($_GET['id'])) {
			require_once 'views/layout/menu.php';
			$id = $_GET['id'];
			$ventas = new Venta();
			$ventas->setId($id);
			$destallesVenta = $ventas->VerVenta();
			require_once 'views/ventas/editarVenta.php';
			require_once 'views/layout/copy.php';
		} else {
			echo'<script>

					swal({
						  type: "error",
						  title: "¡No a Elegido una venta !",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "listarventas";

							}
						})

			  	</script>';
		}
	}

	public function GuardarVenta() {

		if (isset($_POST['clienteVentaN']) && !empty($_POST['clienteVentaN'])) {

			$datosParramentros = new Parametros();
			$detallesParrametros = $datosParramentros->MostrarParrametro();

			while ($row1 = $detallesParrametros->fetch_object()) {
				$estadoIva = $row1->iva_incluido;
				$numFactura = $row1->num_inicio_factura;
			}

			$venta = new Venta();
			$ultimaventa = $venta->VerUltimaVenta();

			if ($ultimaventa->num_rows == 1) {
				while ($row2 = $ultimaventa->fetch_object()) {
					$ultinoNumFact = $row2->codigo;
				}
				$codigo = $ultinoNumFact + 1;
			} else {
				$codigo = $numFactura + 1;
			}

			$listaProductos = json_decode($_POST["listaProductos"], true);

			$UtilidadP = 0;
			foreach ($listaProductos as $key => $value) {

				//array_push($totalProductosComprados, $value["cantidad"]);
				$costo = $value['costo'];
				$cantidadV = $value['cantidad'];
				$subTotal = $value['subtotal'];
				$impuestoItem = $value['impuesto'];
				$fechaventa = date('Y-m-d');

				$producto = new Inventario();
				$id_producto = $value["id"];

				$producto->setId_producto($id_producto);
				$respuest = $producto->VercantidadProducto();
				while ($row = $respuest->fetch_object()) {
					$cantidad = $row->can_inicial;
				}

				$nuevCantidad = $cantidad - $cantidadV;

				$producto->setCantidad_Inicial($nuevCantidad);
				$producto->ActulizarStock();

				$productoVenta = new VentaProduto();
				$productoVenta->setId_producto($id_producto);
				$productoVenta->setCantidad($cantidadV);
				$productoVenta->setNum_factura($codigo);
				$productoVenta->setFecha($fechaventa);

				$productoVenta->VentaProductoRealizada();

				if ($estadoIva == 1) {
					$ivaValor = $impuestoItem;

					$ValorCalculo = (100 + $ivaValor) / 100;
					(int) $subTotalSI = $subTotal / $ValorCalculo;

					$costoTotalProducto = $costo * $cantidadV;
					$UtilidadP = (int) $subTotalSI - $costoTotalProducto;

					$array[] = array('idProducto' => $id_producto, 'valor' => $UtilidadP);
				} else {
					$costoTotalProducto = $costo * $cantidadV;
					$UtilidadP = $subTotal - $costoTotalProducto;
					$array[] = array('idProducto' => $id_producto, 'valor' => $UtilidadP);
				}
			}
			$valorUtilida = array_column($array, 'valor');
			$TotalUtilidad = array_sum($valorUtilida);

			$subTotalVenta = (int) $_POST['SubVenta'];
			$impuesto = (int) $_POST['ivaVenta'];
			$valorVenta = (int) $_POST['totalVenta'];
			$detalle_venta = $_POST["listaProductos"];

			$id_cliente = (int) $_POST['clienteVentaN'];

			$compraCliente = new CompraCliente();
			$compraCliente->setId_cliente($id_cliente);
			$compraCliente->setValor($valorVenta);
			$compraCliente->setFecha($fechaventa);
			$compraCliente->setNum_factura($codigo);
			$compraCliente->NuevaCompraRealizada();



			$tipo = (int) $_POST['tipoventa'];

			if ($tipo == 1) {
				$id_plazo = $_POST['plazos'];

				$plazoinf = new Plazo();
				$plazoinf->setId($id_plazo);
				$detallesPlazo = $plazoinf->MostrarPlazoId();

				while ($row3 = $detallesPlazo->fetch_object()) {
					$dias = $row3->num_dias;
				}

				$fecha = date('Y-m-d');
				$fechaActual = strtotime('+' . $dias . ' day', strtotime($fecha));
				$fecha_vencimiento = date('Y-m-d', $fechaActual);
				$saldo = $valorVenta;
			} else {
				$fecha = date('Y-m-d');
				$fecha_vencimiento = date('Y-m-d');
				$id_plazo = 0;
				$saldo = $valorVenta;
			}
			date_default_timezone_set('America/Bogota');

			$fechaActualFact = date('Y-m-d');
			$horaFactura = date('H:i:s');
			$venta->setCodigo($codigo);
			$venta->setFecha($fechaActualFact);
			$venta->setHora($horaFactura);
			$venta->setTipo($tipo);
			$venta->setId_plazo($id_plazo);
			$venta->setFecha_vencimiento($fecha_vencimiento);
			$venta->setId_cliente($id_cliente);
			$venta->setDetalle_venta($detalle_venta);
			$venta->setSub_total($subTotalVenta);
			$venta->setIva($impuesto);
			$venta->setTotal($valorVenta);
			$venta->setSaldo($saldo);
			$venta->setUtilidad($TotalUtilidad);
			//var_dump($venta);

			$resp = $venta->GuardarVenta();
			
			if ($resp && $tipo != 1) {
				echo'<script>

					swal({
						  type: "success",
						  title: "Venta Guardada Correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "cobrarVenta&id='.$resp.'";

							}
						})

					</script>';
			} else {
				if ($resp) {
					echo'<script>

					swal({
						  type: "success",
						  title: "Venta Guardada Correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "listarventas";

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

							window.location = "listarventas";

							}
						})

			  	</script>';
				}
			}
		} else {
			echo'<script>

					swal({
						  type: "error",
						  title: "¡No se puede guardar la ventas si seleccionar el cliente!",
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

	public function cobrarVenta() {
		require_once 'views/layout/menu.php';
		require_once 'views/ventas/pagoventa.php';
		require_once 'views/layout/copy.php';
	}
	public function pagarFactura() {
		if(isset($_POST['id'])){
			
			$id = $_POST['id'];
			$valor = $_POST['valor'];
			
			$venta = new Venta();
			$venta->setId($id);
			$detalles = $venta->MostrarVentasId();
			
			while ($row = $detalles->fetch_object()) {
				$valorfactura = (int)$row->total;
			}
			if($valor >= $valorfactura){
				$nuevoSaldo = 0;
			}else{
				$nuevoSaldo = $valorfactura - (int)$valor;
			}
			
			$venta->setSaldo($nuevoSaldo);
			$resp = $venta-> Abonar();
			if ($resp) {
				echo'<script>

					swal({
						  type: "success",
						  title: "Venta cobrada Correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "listarventas";

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

							window.location = "listarventas";

							}
						})

			  	</script>';
			}
		}
	}
	static public function valorventa($id) {
		$venta = new Venta();
		$venta->setId($id);
		$detalles = $venta->MostrarVentasId();
		return $detalles;
	}
	public function ActulizarVenta() {

		if ($_POST['idVenta']) {
			//var_dump($_POST);

			$datosParramentros = new Parametros();
			$detallesParrametros = $datosParramentros->MostrarParrametro();

			while ($row1 = $detallesParrametros->fetch_object()) {
				$estadoIva = $row1->iva_incluido;
				$numFactura = $row1->num_inicio_factura;
			}
			$id_venta = $_POST['idVenta'];
			//ver la venta anterios
			$ventAnt = new Venta();
			$ventAnt->setId($id_venta);
			$ventaAn = $ventAnt->VerVenta();

			while ($row = $ventaAn->fetch_object()) {
				$listProductos = $row->detalle_venta;
				$num_factura = $row->codigo;
			}
			//eliminar los productos de la venta a modificar
			$ventaProd = new VentaProduto();
			$ventaProd->setNum_factura($num_factura);
			$ventaProd->EliminarV();

			//actulizando la compra del cliente
			$valor = (int) $_POST['totalVenta'];
			$compraCliente = new CompraCliente();
			$compraCliente->setNum_factura($num_factura);
			$compraCliente->setValor($valor);
			$compraCliente->ActulizarCompraRealizada();

			$listaProductos = json_decode($listProductos, true);
			//actulizamos los productos modidicados
			foreach ($listaProductos as $key => $value) {

				$producto = new Inventario();
				$id_producto = $value["id"];

				$producto->setId_producto($id_producto);
				$respuest = $producto->VercantidadProducto();

				while ($row = $respuest->fetch_object()) {
					$cantidad = $row->can_inicial;
				}
				$nuevCantidad = $cantidad + $value['cantidad'];

				$producto->setCantidad_Inicial($nuevCantidad);
				$producto->ActulizarStock();
			}
			//fin de actulizar productos
			if ($_POST["listaProductos"] == '') {
				$detalle_venta = $listProductos;
			} else {
				$detalle_venta = $_POST["listaProductos"];
			}
			$listaProductos = json_decode($detalle_venta, true);
			//modificando las cantidades de los productos		
			$UtilidadP = 0;
			foreach ($listaProductos as $key => $value) {

				$costo = $value['costo'];
				$cantidadV = $value['cantidad'];
				$subTotal = $value['subtotal'];
				$impuestoItem = $value['impuesto'];
				$fechaventa = date('y-m-d');

				$producto = new Inventario();
				$id_producto = $value["id"];

				$producto->setId_producto($id_producto);
				$respuest = $producto->VercantidadProducto();
				while ($row = $respuest->fetch_object()) {
					$cantidad = $row->can_inicial;
				}

				$nuevCantidad = $cantidad - $cantidadV;

				$producto->setCantidad_Inicial($nuevCantidad);
				$producto->ActulizarStock();

				$productoVenta = new VentaProduto();
				$productoVenta->setId_producto($id_producto);
				$productoVenta->setCantidad($cantidadV);
				$productoVenta->setNum_factura($num_factura);
				$productoVenta->setFecha($fechaventa);

				$productoVenta->VentaProductoRealizada();

				if ($estadoIva == 1) {
					$ivaValor = $impuestoItem;

					$ValorCalculo = (100 + $ivaValor) / 100;
					(int) $subTotalSI = $subTotal / $ValorCalculo;

					$costoTotalProducto = $costo * $cantidadV;
					$UtilidadP = (int) $subTotalSI - $costoTotalProducto;

					$array[] = array('idProducto' => $id_producto, 'valor' => $UtilidadP);
				} else {
					$costoTotalProducto = $costo * $cantidadV;
					$UtilidadP = $subTotal - $costoTotalProducto;
					$array[] = array('idProducto' => $id_producto, 'valor' => $UtilidadP);
				}
			}
			$valorUtilida = array_column($array, 'valor');
			$TotalUtilidad = array_sum($valorUtilida);

			$subTotalVenta = (int) $_POST['SubVenta'];
			$impuesto = (int) $_POST['ivaVenta'];
			$valorVenta = (int) $_POST['totalVenta'];


			$tipo = (int) $_POST['tipoventa'];

			if ($tipo == 1) {
				$id_plazo = $_POST['plazos'];

				$plazoinf = new Plazo();
				$plazoinf->setId($id_plazo);
				$detallesPlazo = $plazoinf->MostrarPlazoId();

				while ($row3 = $detallesPlazo->fetch_object()) {
					$dias = $row3->num_dias;
				}

				$fecha = date('Y-m-d');
				$fechaActual = strtotime('+' . $dias . ' day', strtotime($fecha));
				$fecha_vencimiento = date('Y-m-d', $fechaActual);
				$saldo = $valorVenta;
			} else {
				$fecha = date('Y-m-d');
				$fecha_vencimiento = date('Y-m-d');
				$id_plazo = 0;
				$saldo = 0;
			}
			date_default_timezone_set('America/Bogota');
			$fechaActualFact = date('Y-m-d H:i:s');
			$horaFactura = date('H:i:s');

			$venta = new Venta();
			$venta->setId($id_venta);
			$venta->setFecha($fechaActualFact);
			$venta->setHora($horaFactura);
			$venta->setTipo($tipo);
			$venta->setId_plazo($id_plazo);
			$venta->setFecha_vencimiento($fecha_vencimiento);
			$venta->setDetalle_venta($detalle_venta);
			$venta->setSub_total($subTotalVenta);
			$venta->setIva($impuesto);
			$venta->setTotal($valorVenta);
			$venta->setUtilidad($TotalUtilidad);
			$resp = $venta->Actulizar();

			if ($resp) {
				echo'<script>

					swal({
						  type: "success",
						  title: "Venta Actulizada Correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "listarventas";

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

							window.location = "listarventas";

							}
						})

			  	</script>';
			}
		}
	}

	public function EliminarVenta() {
		if (isset($_GET['id'])) {
			$datosParramentros = new Parametros();
			$detallesParrametros = $datosParramentros->MostrarParrametro();

			while ($row1 = $detallesParrametros->fetch_object()) {
				$estadoIva = $row1->iva_incluido;
			}
			$id_venta = $_GET['id'];
			//ver la venta anterios
			$ventAnt = new Venta();
			$ventAnt->setId($id_venta);
			$ventaAn = $ventAnt->VerVenta();

			while ($row = $ventaAn->fetch_object()) {
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

				while ($row = $respuest->fetch_object()) {
					$cantidad = $row->can_inicial;
				}
				$nuevCantidad = $cantidad + $value['cantidad'];

				$producto->setCantidad_Inicial($nuevCantidad);
				$producto->ActulizarStock();
			}
			$venta = new Venta();
			$venta->setId($id_venta);
			$resp = $venta->EliminarVenta();
			if ($resp) {
				echo'<script>

					swal({
						  type: "success",
						  title: "Venta Eliminada Correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "listarventas";

							}
						})

					</script>';
			} else {
				echo'<script>

					swal({
						  type: "error",
						  title: "¡Registro no Eliminado !",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "listarventas";

							}
						})

			  	</script>';
			}
		}
	}

	static public function Verventa($codigo) {
		$cod = $codigo;
		$verVenta = new Venta();
		$verVenta->setCodigo($codigo);
		$datoventa = $verVenta->VerVentaCodigo();
		return $datoventa;
	}

	public function ReporteVentas() {
		require_once 'views/layout/menu.php';

		if (isset($_GET["fechaInicial"])) {

			$fechaInicial = $_GET["fechaInicial"];
			$fechaFinal = $_GET["fechaFinal"];

			$ventas = new Venta();
			$listaVentas = $ventas->ReportesVentas($fechaInicial, $fechaFinal);
		} else {
			$ventas = new Venta();
			$listaVentas = $ventas->MostrarVentas();
		}


		require_once 'views/ventas/reporteVenta.php';
		require_once 'views/layout/copy.php';
	}

	static public function TotalVentas() {
		$ventas = new Venta();
		$TotalVentas = $ventas->MostrarSumaVentas();
		return $TotalVentas;
	}

	static public function VerVentaId($id) {
		$venta = new Venta();
		$venta->setId($id);
		$detalles = $venta->MostrarVentasId();
		return $detalles;
	}

}
