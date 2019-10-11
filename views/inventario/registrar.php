<div class="content-wrapper">
	<section class="content-header">

		<h1>
			Registrar Nuevo Producto
		</h1>

		<ol class="breadcrumb">

			<li><a href="<?= URL_BASE ?>frontend/principal"><i class="fa fa-dashboard"></i> Inicio</a></li>

			<li class="active">Registrar Nuevo Producto</li>

		</ol>

	</section>
	<section class="content">

		<div class="box">

			<div class="box-header with-border">
				<a href="<?= URL_BASE ?>inventario/">
					<button class="btn btn-primary">

						Cancelar

					</button>
				</a>
			</div>


			<div class="box-body">
				<div class="col-md-8">
					<form class="formularioVenta" action="<?= URL_BASE ?>inventario/guardarproducto" enctype="multipart/form-data" method="POST">
						<div class="row">
							<div class="col-xs-6">
								<div class="form-group">
									<label for="codigo">Codigo:</label>
									<?php
										$detallesParrametros = InventarioController::ListaParrametros();
										while ($row1 = $detallesParrametros->fetch_object()) {
											$estado = $row1->generar_codigo;
										}
										?>
									<input type="text" class="form-control" name="codigo" id="codigo" <?=($estado == 1)?'disabled':''?>>
								</div>	
							</div>
							<div class="col-xs-6">
								<div class="form-group">
									<label for="costo">Costo:</label>
									<input type="number" class="form-control " onchange="recibir();" name="costo" id="costo" required>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="nombre">Nombre:</label>
							<input type="text" class="form-control" name="nombre" id="nombre" required>
						</div>

						<div class="row">
							<div class="col-xs-6">
								<div class="form-group">
									<label for="Precio 1">Precio 1:</label>
									<input type="number" class="form-control" name="Precio1" value="" id="Precio1" disabled>
								</div>
							</div>
							<div class="col-xs-6">
								<div class="form-group">
									<label for="Utilidad 1">% de Utilidad 1:</label>
									<input type="number" class="form-control" onchange="recibir();" name="Utilidad1" id="Utilidad1" required>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-xs-6">
								<div class="form-group">
									<label for="Categoria">Categoria :</label>

									<?php $categoria = CategoriaController::ListaMostrarCategoria() ?>
									<select class="form-control seleccionarCategoria"  name="idcategoria" required>
										<option value="">Selecione una Categoria</option>
										<?php
										while ($row = $categoria->fetch_object()) {
											echo '<option value="' . $row->id. '">' . $row->nombre . '</option>';
										}
										?>						


									</select>
								</div>
							</div>
							<div class="col-xs-6">
								<div class="form-group">
									<label for="contidadMin">Stop Minimo:</label>
									<input type="number" class="form-control" name="cantidamin" id="fiesta" required>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-xs-6">
								<div class="form-group">
									<label for="fiestapatronal">Cantidad Inicial:</label>
									<input type="number" class="form-control" name="cantidainicial" id="fiesta" required>
								</div>
							</div>
							<div class="col-xs-6">
								<div class="form-group">
									<label for="nombre">Impuesto:</label>

									<select class="form-control select2 impuesto" onchange="recibir();" id="impuesto" name="impuesto" style="width: 100%;">
										<option>Seleciones el impueto</option>										
										<?php 
											  $impuesto = ImpuestoController::listaImpuesto();
											  while ($rowI = $impuesto->fetch_object()):					

										  ?>
										<option value="<?=$rowI->porcentaje?>"><?=$rowI->nombre?></option>
										<?php endwhile; ?>    
								  </select>
								</div>
							</div>

						</div>
						
						<div class="row">
							<div class="col-xs-6">
								<div class="form-group">
									<label for="Precio1_Iva">Precio 1 con Iva:</label>
									<input type="number" class="form-control" name="Precio1_Iva" id="Precio1_Iva" disabled>
								</div>
							</div>
							<div class="col-xs-6">
								<div class="form-group">
									<label for="foto">Foto:</label>
									<input type="file" class="form-control" name="foto" id="foto">
								</div>		
							</div>

						</div>
						

						<div class="row">
							<div class="col-xs-6">
								<div class="form-group">
									<label for="codigo_vendedor">Codigo del Vendeedor:</label>
									<input type="number" class="form-control" name="codigo_vendedor" id="limites">
								</div>
							</div>
								<div class="col-xs-6">
								<div class="form-group">
									<label for="fechaexpiracion">Vendedor:</label>
									<select class="form-control select2" name="id_vendedor" style="width: 100%;">
										<option  value="0" selected="selected">Seleciones Proveedor</option>
										<option  value="0">No Registrar proveedor</option>
									  <?php 
											$proveedor = ProveedorController::listaProveedor();
											while ($rowP = $proveedor->fetch_object()):							

										?>
									  <option value="<?=$rowP->id?>"><?=$rowP->nombre?></option>
									  <?php endwhile; ?>                
              
                 
								 </select>
								</div>
							</div>

						</div>					
						
						<button type="submit" class="btn btn-primary">Guardar</button>
					</form>
				</div>
			</div>
		</div>
	</section>
</div>


