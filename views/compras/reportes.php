<div class="content-wrapper">

	<section class="content-header">

		<h1>

			Reportes de Compras
		</h1>

		<ol class="breadcrumb">

			<li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

			<li class="active">Reportes de Compras</li>

		</ol>

	</section>

	<section class="content">

		<div class="box">

			<div class="box-header with-border">

				<div class="input-group">

					<button type="button" class="btn btn-default" id="daterange-btn3">

						<span>
							<i class="fa fa-calendar"></i> Rango de fecha
						</span>

						<i class="fa fa-caret-down"></i>

					</button>

				</div>


			</div>

			<div class="box-body">

				<div class="row">

					<div class="col-xs-12">
						<?php
						error_reporting(0);

						$arrayFechas = array();
						$arrayVentas = array();
						$sumaPagosMes = array();



						while ($row = $listaCompra->fetch_object()) {

							#Capturamos sólo el año y el mes
							$fecha = substr($row->fecha, 0, 7);

							#Introducir las fechas en arrayFechas
							array_push($arrayFechas, $fecha);

							#Capturamos las ventas
							$arrayVentas = array($fecha => $row->total);

							#Sumamos los pagos que ocurrieron el mismo mes
							foreach ($arrayVentas as $key => $value) {

								$sumaPagosMes[$key] += $value;
							}
						}


						$noRepetirFechas = array_unique($arrayFechas);
						?>


						<div class="box box-solid bg-teal-gradient">

							<div class="box-header">

								<i class="fa fa-th"></i>

								<h3 class="box-title">Gráfico de Compras</h3>

							</div>

							<div class="box-body border-radius-none nuevoGraficoVentas">

								<div class="chart" id="line-chart-ventas" style="height: 250px;"></div>

							</div>

						</div>



					</div>
					<script>

						var line = new Morris.Line({
							element: 'line-chart-ventas',
							resize: true,
							data: [

<?php
if ($noRepetirFechas != null) {

	foreach ($noRepetirFechas as $key) {

		echo "{ y: '" . $key . "', ventas: " . $sumaPagosMes[$key] . " },";
	}

	echo "{y: '" . $key . "', ventas: " . $sumaPagosMes[$key] . " }";
} else {

	echo "{ y: '0', ventas: '0' }";
}
?>

							],
							xkey: 'y',
							ykeys: ['ventas'],
							labels: ['ventas'],
							lineColors: ['#efefef'],
							lineWidth: 2,
							hideHover: 'auto',
							gridTextColor: '#fff',
							gridStrokeWidth: 0.4,
							pointSize: 4,
							pointStrokeColors: ['#efefef'],
							gridLineColor: '#efefef',
							gridTextFamily: 'Open Sans',
							preUnits: '$',
							gridTextSize: 10
						});

					</script>
					

					<div class="col-md-6 col-xs-12">

						<button class="btn  btn-primary  btn-lg " data-toggle="modal" data-target="#modalComprasPeriodo">

							Compras por Periodo

						</button>
						&nbsp;&nbsp;&nbsp;
						<button class="btn  btn-primary  btn-lg " data-toggle="modal" data-target="#modalComprasProveedor">

							Compras por Proveedor

						</button>	


					</div>

					<div class="col-md-6 col-xs-12">

						<button class="btn  btn-primary  btn-lg " data-toggle="modal" data-target="#modalProdCompra">

							Compras por Productos 

						</button>

					</div>

				</div>

			</div>

		</div>

	</section>

</div>




<div id="modalComprasPeriodo" class="modal fade" role="dialog">

	<div class="modal-dialog">

		<div class="modal-content">

			<form role="form" action="<?= URL_BASE ?>extensiones/tcpdf/pdf/comprasporperiodo.php" method="GET" target="_blank" >

				<!--=====================================
				CABEZA DEL MODAL
				======================================-->

				<div class="modal-header" style="background:#3c8dbc; color:white">

					<button type="button" class="close" data-dismiss="modal">&times;</button>

					<h4 class="modal-title">Compras por periodo</h4>

				</div>

				<!--=====================================
				CUERPO DEL MODAL
				======================================-->

				<div class="modal-body">

					<div class="box-body">


						<div class="form-group">
							<label>Fecha Inicial:</label>

							<div class="input-group date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="date" class="form-control" name="fechaInicial">
							</div>
							<!-- /.input group -->
						</div>  
						<div class="form-group">
							<label>Fecha Final:</label>

							<div class="input-group date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="date" class="form-control" name="fechaFinal" >
							</div>
							<!-- /.input group -->
						</div>

					</div>

				</div>

				<!--=====================================
				PIE DEL MODAL
				======================================-->

				<div class="modal-footer">

					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

					<button type="submit" class="btn btn-primary">Mostrar</button>

				</div>

			</form>     

		</div>

	</div>

</div>

<div id="modalProdCompra" class="modal fade" role="dialog">

	<div class="modal-dialog">

		<div class="modal-content">

			<form role="form" action="<?= URL_BASE ?>extensiones/tcpdf/pdf/productoscompra.php" method="GET" target="_blank" >

				<!--=====================================
				CABEZA DEL MODAL
				======================================-->

				<div class="modal-header" style="background:#3c8dbc; color:white">

					<button type="button" class="close" data-dismiss="modal">&times;</button>

					<h4 class="modal-title">Compras por Productos</h4>

				</div>

				<!--=====================================
				CUERPO DEL MODAL
				======================================-->

				<div class="modal-body">

					<div class="box-body">


						<div class="form-group">
							<label>Fecha Inicial:</label>

							<div class="input-group date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="date" class="form-control" name="fechaInicial">
							</div>
							<!-- /.input group -->
						</div>  
						<div class="form-group">
							<label>Fecha Final:</label>

							<div class="input-group date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="date" class="form-control" name="fechaFinal" >
							</div>
							<!-- /.input group -->
						</div>

					</div>

				</div>

				<!--=====================================
				PIE DEL MODAL
				======================================-->

				<div class="modal-footer">

					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

					<button type="submit" class="btn btn-primary">Mostrar</button>

				</div>

			</form>     

		</div>

	</div>

</div>

<div id="modalComprasProveedor" class="modal fade" role="dialog">

	<div class="modal-dialog">

		<div class="modal-content">

			<form role="form" action="<?= URL_BASE ?>extensiones/tcpdf/pdf/comprasproveedor.php" method="GET" target="_blank" >

				<!--=====================================
				CABEZA DEL MODAL
				======================================-->

				<div class="modal-header" style="background:#3c8dbc; color:white">

					<button type="button" class="close" data-dismiss="modal">&times;</button>

					<h4 class="modal-title">Compras por Proveedor</h4>

				</div>

				<!--=====================================
				CUERPO DEL MODAL
				======================================-->

				<div class="modal-body">

					<div class="box-body">


						<div class="form-group">
							<label>Fecha Inicial:</label>

							<div class="input-group date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="date" class="form-control" name="fechaInicial">
							</div>
							<!-- /.input group -->
						</div>  
						<div class="form-group">
							<label>Fecha Final:</label>

							<div class="input-group date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="date" class="form-control" name="fechaFinal" >
							</div>
							<!-- /.input group -->
						</div>

					</div>

				</div>

				<!--=====================================
				PIE DEL MODAL
				======================================-->

				<div class="modal-footer">

					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

					<button type="submit" class="btn btn-primary">Mostrar</button>

				</div>

			</form>     

		</div>

	</div>

</div>