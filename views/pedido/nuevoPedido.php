<!-- Content Wrapper. Contains page content -->
<input type="hidden" id="tipoIva" value="1" />
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>
			Nuevo Pedido

		</h1>
		<ol class="breadcrumb">
			<li><a href="<?= URL_BASE ?>frontend/principal"><i class="fa fa-dashboard"></i> Pincipal</a></li>
			<li><a>NuevaPedido</a></li>

		</ol>
    </section>
	<div class="box-body">
		<div class="box-header with-border">

			<button class="btn btn-primary agregarMesa" data-toggle="modal" data-target="#modalAgregarMesa">

				Seleccionar mesa

			</button>
			
			
			<a href="<?=URL_BASE?>pedido/">
				<button class="btn btn-success" >

				Cancelar

			</button>
			</a>

		</div>
	</div>

    <!-- Main content -->
    <section class="invoice">
		<form role="form" method="post" action="<?=URL_BASE?>pedido/" class="formularioVenta">
		<!-- title row -->
		<div class="row">
			<div class="col-xs-12">
				<h2 class="page-header">
					<i class="fa fa-globe"></i>Sacv.
					<small class="pull-right">Fecha: <?= date('y-m-d') ?></small>
				</h2>
			</div>
			<!-- /.col -->
		</div>
		<!-- info row -->
		
		<div class="row invoice-info">
			<div class="cabeceraPedido">		
			 
			</div>
			
			<div class="col-sm-4 invoice-col">		
				
				
				
			</div>
			
		</div>
		<!-- /.row -->
		<div class="box-body">
			<div class="box-header with-border">

				<button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProductos">

					Agregar productos

				</button>


			</div>
        </div>
		<!-- Table row -->
		<div class="row">
			<div class="col-xs-12 table-responsive">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>codigo</th>
							<th>Producto detalle</th>
							<th>cantidad</th>							
							<th>precio</th>							
							<th>% Descuento</th>
							<th>% Iva</th>
							<th>Subtotal</th>
							<th>Accion</th>
						</tr>
					</thead>
					
					<tbody class="nuevoProducto">
						<!--<tr>
							<td>1</td>
							<td>Call of Duty</td>
							<td><input type="number" name="cantidad" value="1" /></td>
							<td><input type="number" name="precio" value=""/></td>
							<td><input type="number" name="descuento" value="0"/></td>
							<td>$64.50</td>
							<td><a href="eliminar&id="><button class="btn btn-danger btnEliminarProducto"><i class="fa fa-times"></i></button></a></td>
						</tr>-->
					
					</tbody>
				</table>
				 <input type="hidden" id="listaProductos" name="listaProductos">
				 <input type="hidden" id="clienteVentaN" name="clienteVentaN">
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->

		<div class="row">
			<!-- accepted payments column -->
			<div class="col-xs-6">
				<p class="lead"></p>


				<p class="text-muted well well-sm no-shadow" style="margin-top: 10px;"></p>
				<div class="col-xs-6">
				<div class="form-group">
						<label for="estado">Tipo de pedido</label>						
						<select class="chosen-select form-control "  id="form-field-select-3" required="">
							<option value="">Seleciones el Tipo</option>
							<option value="1">Credito</option>
							<option value="0">Contado</option>
						</select>
					</div>
					<div class="form-group">								
					
				</div>
				</div>
				

		
			</div>
			<!-- /.col -->
			<div class="col-xs-6">


				<div class="table-responsive">
					<table class="table">
						<tr class="l-subtotal">
							<th class="descuento-v" style="width:50%">Subtotal:</th>
							<td class="descuento-v">								
								<input type="text" class="form-control input-lg nuevoSubtotal" id="nuevoSubtotal" name="nuevoSubtotal" value="0" readonly/>
								<input type="hidden" name="SubVenta" id="SubVenta">
							</td>
						</tr>
						<tr class="l-iva">
							<th class="iva-t">IVA:</th>
							<td class="iva-v">
								<input type="text" class="form-control input-lg nuevoImpuestoVenta" id="nuevoImpuestoVenta" name="nuevoImpuestoVenta" placeholder="0" readonly/>
								<input type="hidden" name="ivaVenta" id="ivaVenta">
							</td>
						</tr>						
						<tr class="l-total">
							<th class="total-t">TOTAL:</th>
							<td class="total-v">
								  <input type="hidden" name="totalVenta" id="totalVenta">
								<input type="text" class="form-control input-lg nuevoTotalVenta" id="nuevoTotalVenta" name="nuevoTotalVenta" value="0" readonly/>
							</td>
						</tr>
					</table>
				</div>
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->

		<!-- this row will not appear when printing -->
		<div class="row no-print">
			<div class="col-xs-12">								
				</button>
				<button type="submit" class="btn btn-primary pull-right" style="margin-right: 5px;">
					<i class="fa fa-download"></i> Guardar Pedido
				</button>
			</div>
		</div>
		</form>

    </section>
    <div class="clearfix"></div>
</div>
<!-- /.content-wrapper -->
<div id="modalAgregarMesa" class="modal fade" role="dialog">

	<div class="modal-dialog">

		<div class="modal-content">

			<form method="post" action="<?= URL_BASE ?>categoria/registrarcategoria">

				<!--=====================================
				CABEZA DEL MODAL
				======================================-->

				<div class="modal-header" style="background:#3c8dbc; color:white">

					<button type="button" class="close" data-dismiss="modal">&times;</button>

					<h4 class="modal-title">Agregar mesa</h4>

				</div>

				<!--=====================================
				CUERPO DEL MODAL
				======================================-->

				<div class="modal-body">

					<div class="box-body">

						<!--=====================================
						ENTRADA DEL TITULO DE LA CATEGORÍA
						======================================-->

						<div class="form-group">

							<div class="col-xs-12 table-responsive">
								<table class="table table-bordered table-striped dt-responsive  tablamesa">
									<thead>
										<tr>
											<th>#</th>
											<th>codigo</th>
											<th>nombre</th>											
											<th>accion</th>         

										</tr>
									</thead>            
								</table>
							</div>

						</div>       

					</div>

				</div>

				<!--=====================================
				PIE DEL MODAL
				======================================-->

				<div class="modal-footer">

					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
					

				</div>

			</form>


		</div>

	</div>

</div>

<div id="modalAgregarProductos" class="modal fade modalProduto" role="dialog">

	<div class="modal-dialog modal-lg">

		<div class="modal-content">

			<!--=====================================
			CABEZA DEL MODAL
			======================================-->

			<div class="modal-header" style="background:#3c8dbc; color:white">

				<button type="button" class="close" data-dismiss="modal">&times;</button>

				<h4 class="modal-title">Agregar Prouctos</h4>

			</div>

			<!--=====================================
			CUERPO DEL MODAL
			======================================-->

			<div class="modal-body">

				<div class="box-body">

					<!--=====================================
					ENTRADA DEL TITULO DE LA CATEGORÍA
					======================================-->

					<div class="form-group">

						<div class="col-xs-8 table-responsive modalProduto">
							<table class="table table-bordered table-striped dt-responsive  tablaproductoventa">
								<thead>
									<tr>
										<th>#</th>
										<th>codigo</th>
										<th>nombre</th>
										<th>Precio 1</th>										
										<th>Stop</th>         
										<th>accion</th>   
									</tr>
								</thead>            
							</table>
						</div>

					</div>       

				</div>

			</div>

			<!--=====================================
			PIE DEL MODAL
			======================================-->

			<div class="modal-footer">

				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>



			</div>




		</div>

	</div>

</div>

