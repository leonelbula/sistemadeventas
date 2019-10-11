<!-- Content Wrapper. Contains page content -->
<input type="hidden" id="tipoIva" value="1" />
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>
			Nueva factura

		</h1>
		<ol class="breadcrumb">
			<li><a href="<?= URL_BASE ?>frontend/principal"><i class="fa fa-dashboard"></i> Pincipal</a></li>
			<li><a>NuevaVentas</a></li>

		</ol>
    </section>
	<div class="box-body">
		<div class="box-header with-border">
		
			
			<a href="<?=URL_BASE?>ventas/">
				<button class="btn btn-success" >

				Cancelar

			</button>
			</a>

		</div>
	</div>

    <!-- Main content -->
    <section class="invoice">
		<form role="form" method="post" action="<?=URL_BASE?>ventas/actulizarventa" class="formularioVenta">
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
			<div class="cabeceraVenta">
				<?php
				
				while ($row2 = $destallesVenta-> fetch_object()) {
					$idventa = $row2->id;
					$idcliente = $row2->id_cliente;
					$productos = $row2->detalle_venta;
					$sub_total = $row2->sub_total;
					$iva = $row2->iva;
					$total = $row2->total;
				}
				
				$detallesCliente = ClienteController::MostrarClienteId($idcliente);
				while ($row3 = $detallesCliente->fetch_object()):
								
				?>
				<input type="hidden" class="idVenta" name="idVenta" value="<?=$idventa?>"/>
				<div class="col-sm-4 invoice-col">					
					<input type="hidden" class="idclienteventa" value="<?=$row3->id?>"/>
					<input type="hidden" class="precioCliente" value="<?=$row3->precio_fact?>" />
					<input type="hidden" class="Cliente" value="<?=$row3->id?>'" />
				<address>
					<strong> Cliente </strong><br>
					<?=$row3->nombre?><br><?=$row3->direccion?>					
					<br>Telefono:<?=$row3->telefono?>
					Email:<?=$row3->email?>
				</address>
			</div>			
			<div class="col-sm-4 invoice-col">
				C.C o Nit.:<?=$row3->nit?>
				<address>
					<strong>Departamento:<?=$row3->departamento?></strong><br>				
					<strong>Ciudad:<?=$row3->ciudad?></strong><br>
				</address>
				
			</div>
				
				<?php endwhile;?>
			 
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
							<th>Unid</th>
							<th>precio</th>							
							<th>% Descuento</th>
							<th>% Iva</th>
							<th>Subtotal</th>
							<th>Accion</th>
						</tr>
					</thead>
					
					<tbody class="nuevoProducto">
						<?php 
							$listaProducto = json_decode($productos,TRUE);
							
							
							foreach ($listaProducto as $key => $value) {
								$idProdu = $value['id'];
																
								$productoDetl = InventarioController::VerProdutoId($idProdu);
								while ($row4 = $productoDetl ->fetch_object()) {									
									$medida = $row4->medida;
									$stock = $row4->can_inicial;
								}
								echo '<tr>
										<td class="valorivap">'.$value['codigo'].'<input  class="valoriva" type="hidden" name="valoriva"  value="'.$value['impuesto'].'"/></td>
										<td class="costop">'.$value['descripcion'].'<input  class="costo" type="hidden" name="costo"  value="'.$value['costo'].'"/></td>							
										<td class="ingresoCantidad"><input type="number" class="nuevaCantidadProducto" name="nuevaCantidadProducto" stock="'.$stock.'" value="'.$value['cantidad'].'" /></td>
										<td class="medida">'.$medida.'</td>
										<td class="precio"><input type="number" class="precioProducto" name="precioProducto" value="'.$value['precio'].'"/></td>							
										<td class="descuentop"><input type="number" class="descuento" id="descuentoProdu" name="descuento" value="'.$value['descuento'].'"/></td>
										<td class="ivaProdup">'.$value['impuesto'].'<input type="hidden" class="ivaProdu" id="ivaProdu" name="ivaProdu" value="'.$value['impuesto'].'"/></td>
										<td class="nuevototalp"><input type="text" class="nuevototal"  name="nuevototal"  value="'.$value['subtotal'].'" readonly></td>
										<td><button class="btn btn-danger quitarProducto" idProducto="'.$value['id'].'"><i class="fa fa-times"></i></button></td>
										<input  class="nombreProduc" type="hidden" name="nombreProduc" value="'.$value['descripcion'].'"/>
										<input  class="idProductoVenta" type="hidden" name="idProductoVenta" value="'.$value['id'].'"/>
										<input  class="codigo" type="hidden" name="codigo" value="'.$value['codigo'].'"/>
									</tr>';
							}
						?>
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
						<label for="estado">Tipo de ventas</label>						
						<select class="chosen-select form-control seleccionarTipoventa" name="tipoventa" id="form-field-select-3" required="">
							<option value="">Seleciones el Tipo</option>
							<option value="1">Credito</option>
							<option value="0">Contado</option>

						</select>
					</div>
					<div class="form-group">
					<label for="estado">Plazo en Dias</label>					
					<select class="chosen-select form-control plazoVenta" name="plazos" id="form-field-select-3" required>
						<option value="">Seleciones el Tipo</option>
						<?php 
							$plazos = ExtrasController::MostrarPlazos();
							while ($row1 = $plazos->fetch_object()):							
							
							?>
							<option value="<?=$row1->id?>"><?=$row1->decripcion?></option>
						<?php endwhile; ?>

					</select>
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
								<input type="text" class="form-control input-lg nuevoSubtotal" id="nuevoSubtotal" name="nuevoSubtotal" value="<?=$sub_total?>" readonly/>
								<input type="hidden" name="SubVenta" id="SubVenta" value="<?=$sub_total?>">
							</td>
						</tr>
						<tr class="l-iva">
							<th class="iva-t">IVA:</th>
							<td class="iva-v">
								<input type="text" class="form-control input-lg nuevoImpuestoVenta" id="nuevoImpuestoVenta" name="nuevoImpuestoVenta" value="<?=$iva?>" placeholder="0" readonly/>
								<input type="hidden" name="ivaVenta" id="ivaVenta" value="<?=$iva?>">
							</td>
						</tr>						
						<tr class="l-total">
							<th class="total-t">TOTAL:</th>
							<td class="total-v">
								  <input type="hidden" name="totalVenta" id="totalVenta" value="<?=$total?>">
								<input type="text" class="form-control input-lg nuevoTotalVenta" id="nuevoTotalVenta" name="nuevoTotalVenta" value="<?=$total?>" readonly/>
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
					<i class="fa fa-download"></i> Guardar Cambios
				</button>
			</div>
		</div>
		</form>

    </section>
    <div class="clearfix"></div>
</div>
<!-- /.content-wrapper -->
<div id="modalAgregarCliente" class="modal fade" role="dialog">

	<div class="modal-dialog">

		<div class="modal-content">

			<form method="post" action="<?= URL_BASE ?>categoria/registrarcategoria">

				<!--=====================================
				CABEZA DEL MODAL
				======================================-->

				<div class="modal-header" style="background:#3c8dbc; color:white">

					<button type="button" class="close" data-dismiss="modal">&times;</button>

					<h4 class="modal-title">Agregar cliente</h4>

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
								<table class="table table-bordered table-striped dt-responsive  tablaclienteventa">
									<thead>
										<tr>
											<th>#</th>
											<th>codigo</th>
											<th>nombre</th>
											<th>nit</th>
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

					<button type="submit" class="btn btn-primary">Guardar categoría</button>

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

						<div class="col-xs-12 table-responsive modalProduto">
							<table class="table table-bordered table-striped dt-responsive  tablaproductoventa">
								<thead>
									<tr>
										<th>#</th>
										<th>codigo</th>
										<th>nombre</th>
										<th>Precio 1</th>
										<th>Precio 2</th>
										<th>Precio 3</th>
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

<!--=====================================
MODAL AGREGAR CLIENTE
======================================-->

<div id="modalRegistrarCliente" class="modal fade" role="dialog">

	<div class="modal-dialog">

		<div class="modal-content">

			<form role="form" action="<?= URL_BASE ?>cliente/guardar" method="POST" >

				<!--=====================================
				CABEZA DEL MODAL
				======================================-->

				<div class="modal-header" style="background:#3c8dbc; color:white">

					<button type="button" class="close" data-dismiss="modal">&times;</button>

					<h4 class="modal-title">Agregar cliente</h4>

				</div>

				<!--=====================================
				CUERPO DEL MODAL
				======================================-->

				<div class="modal-body">

					<div class="box-body">


						<div class="form-group">
							<label>Nombre:</label>

							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-user"></i>
								</div>
								<input type="text" class="form-control" name="nombre" required>
							</div>
							<!-- /.input group -->
						</div>            

						<div class="form-group">
							<label>Nit - CC:</label>
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-tag"></i>
								</div>
								<input type="text" class="form-control"name="nit" required>
							</div>
							<!-- /.input group -->
						</div>             

						<div class="form-group">
							<label>Direccion:</label>

							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-map-marker"></i>
								</div>
								<input type="text" class="form-control" name="direccion" required>
							</div>
							<!-- /.input group -->
						</div>
						<div class="form-group">
							<label>Departamento:</label>

							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-map-marker"></i>
								</div>
								<input type="text" class="form-control" name="departamento" required>
							</div>
							<!-- /.input group -->
						</div>
						<div class="form-group">
							<label>Ciudad:</label>

							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-map-marker"></i>
								</div>
								<input type="text" class="form-control" name="ciudad" required>
							</div>
							<!-- /.input group -->
						</div>             
						<div class="form-group">
							<label>Telefono:</label>

							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-phone"></i>
								</div>
								<input type="text" class="form-control" name="telefono" data-inputmask='"mask": "(999) 999-9999"' data-mask>
							</div>
							<!-- /.input group -->
						</div>

						<div class="form-group">
							<label>Email:</label>

							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-envelope-o"></i>
								</div>
								<input type="text" class="form-control" name="email" >
							</div>
							<!-- /.input group -->
						</div>   

						<div class="form-group">
							<label>Tipo de Cliente:</label>

							<select class="form-control select2" name="tipo" style="width: 100%;">
								<option selected="selected">Seleciones el tipo</option>
								<option value="1">Por Mayor</option>                
								<option value="0">Cliente Generico</option>				
							</select>
							<!-- /.input group -->
						</div>
						<div class="form-group">
							<label>Precio a facturar:</label>

							<select class="form-control select2" name="precio_fact" style="width: 100%;">
								<option selected="selected">Seleciones una opcion</option>
								<option value="1">Precio 1</option>                  
								<option value="2">Precio 2</option>
								<option value="3">Precio 3</option>		
							</select>
							<!-- /.input group -->
						</div>
						<div class="form-group">
							<label>Se aplica interes por Mora:</label>
							<select class="form-control select2" name="interes" style="width: 100%;">
								<option value="0" selected="selected">Seleciones la opcion</option>
								<option value="0">No se le Aplica Interes</option>
								<?php
								$retencion = ExtrasController::listaIntereses();
								while ($rowR = $retencion->fetch_object()):
									?>
									<option value="<?= $rowR->porcentaje ?>"><?= $rowR->descripcion ?></option>
								<?php endwhile; ?>     
							</select>
						</div>

						<div class="form-group">
							<label>Cuenta Contable:</label>

							<select class="form-control select2" name="cuentacontable" style="width: 100%;">
								<option  value="0" selected="selected">Seleciones Cuenta Contable</option>
								<?php
								$cuentas = CuentasContableController::ListarCuentas();
								while ($row = $cuentas->fetch_object()):
									?>
									<option value="<?= $row->num_cuenta ?>"><?= $row->num_cuenta ?> - <?= $row->descripcion ?></option>
								<?php endwhile; ?>                


							</select>
							<!-- /.input group -->
						</div>
					</div>

				</div>

				<!--=====================================
				PIE DEL MODAL
				======================================-->

				<div class="modal-footer">

					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

					<button type="submit" class="btn btn-primary">Guardar cliente</button>

				</div>

			</form>     

		</div>

	</div>

</div>
