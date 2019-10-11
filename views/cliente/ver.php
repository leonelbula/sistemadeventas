<div class="content-wrapper">

	<section class="content-header">

		<h1>
			Detalles Cliente
		</h1>

		<ol class="breadcrumb">

			<li><a href="<?= URL_BASE ?>frontend/principal"><i class="fa fa-dashboard"></i> Inicio</a></li>

			<li class="active">Detalles Cliente</li>

		</ol>

	</section>

	<section class="content">

		<div class="box">

			<div class="box-header with-border">
				<a href="<?= URL_BASE ?>cliente/">
					<button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCategoria">

						volver

					</button>
				</a>
			</div>


			<div class="box-body">

				<div class="panel panel-default">
					<div class="panel-heading">Informacion de Cliente</div>
					<ul class="list-group">			  
						<?php while ($row = $detallesCliente->fetch_object()):
							?>

							<li class="list-group-item"><b>Nombre:</b> <?= strtoupper($row->nombre) ?></li>
							<li class="list-group-item"><b>Nit:</b> <?= $row->nit ?></li>
							<li class="list-group-item"><b>Direccion:</b> <?= strtoupper($row->direccion) ?></li>
							<li class="list-group-item"><b>Departamento:</b> <?= strtoupper($row->departamento) ?></li>
							<li class="list-group-item"><b>Ciudad:</b></b> <?= strtoupper($row->ciudad) ?></li>
							<li class="list-group-item"><b>Email:</b> <?= $row->email ?></li>
							<li class="list-group-item"><b>Telefono:</b> <?= $row->telefono ?></li>
							
							<?php endwhile; ?>
					</ul>
				</div>



			</div>
		</div>

</div>

</section>

</div>
