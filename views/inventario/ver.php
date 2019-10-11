<div class="content-wrapper">

	<section class="content-header">

		<h1>
			Detalles Productos
		</h1>

		<ol class="breadcrumb">

			<li><a href="<?= URL_BASE ?>frontend/principal"><i class="fa fa-dashboard"></i> Inicio</a></li>

			<li class="active">Detalles Productos</li>

		</ol>

	</section>

	<section class="content">

		<div class="box">

			<div class="box-header with-border">
				<a href="<?= URL_BASE ?>inventario/">
					<button class="btn btn-primary" >

						volver

					</button>
				</a>
			</div>


			<div class="box-body">

				<div class="panel panel-default">
					<div class="panel-heading">Informacion del Producto</div>
					<ul class="list-group">			  
						<?php while ($row = $detallesPro->fetch_object()):
							
							$id = $row->id_categoria;
							$categoriade = CategoriaController::MostarCategoria($id);
							
							while ($row1 = $categoriade->fetch_object()) {
								$categoria = $row1->nombre;
							}
							?>
							<li class="list-group-item"><b>CODIGO:</b> <?= $row->codigo ?></li>
							<li class="list-group-item"><b>COSTO:</b> <?= $row->costo ?></li>
							<li class="list-group-item"><b>NOMBRE:</b> <?= strtoupper($row->nombre) ?></li>
							<li class="list-group-item"><b>PRECIO VENTA 1 SIN IVA:</b> <h4><?= $row->precio_1 ?> --- <b>Utilidad :</b></b> <?= strtoupper($row->utilidad_1) ?> %</h4></li>
							<li class="list-group-item"><b>PRECIO VENTA 2 SIN IVA:</b> <h4><?= $row->precio_2 ?> --- <b>Utilidad :</b></b> <?= strtoupper($row->utilidad_2) ?> %</h4></li>
							<li class="list-group-item"><b>PRECIO VENTA 3 SIN IVA:</b> <h4><?= $row->precio_3 ?> --- <b>Utilidad :</b></b> <?= strtoupper($row->utilidad_3) ?> %</h4></li>
							<li class="list-group-item"><b>CATEGORIA :</b></b> <?= strtoupper($categoria) ?></li>
							<li class="list-group-item"><b>ESTADO:</b> <?= $row->estado ?></li>
							<li class="list-group-item"><b>PRECIO VENTA 1 MAS IVA:</b><h4> <?= $row->precio_v_iva1 ?></h4></li>
							<li class="list-group-item"><b>PRECIO VENTA 2 MAS IVA:</b><h4> <?= $row->precio_v_iva2 ?></h4></li>
							<li class="list-group-item"><b>PRECIO VENTA 3 MAS IVA:</b><h4> <?= $row->precio_v_iva3 ?></h4></li>
							<li class="list-group-item"><b>CODIGO VENDEDOR:</b><h4> <?= $row->codigo_fabr ?></h4></li>
							<li class="list-group-item"><b>IMPUESTO :</b><h4> <?= $row->impuesto ?>%</h4></li>
							<?php endwhile; ?>
					</ul>
				</div>



			</div>
		</div>

</div>

</section>

</div>
