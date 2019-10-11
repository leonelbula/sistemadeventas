<div class="content-wrapper">

	<section class="content-header">

		<h1>

			valor inventario
		</h1>

		<ol class="breadcrumb">

			<li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

			<li class="active">Valor Inventario ala fecha</li>

		</ol>

	</section>

	<section class="content">

		<div class="box">

			<div class="box-header with-border">

				<div class="input-group">



				</div>


			</div>

			<div class="box-body">

				<div class="row">

					<div class="col-xs-12">
						<div class="panel panel-default">
							<div class="panel-heading"><h2>Valor de Total</h2></div>
							<ul class="list-group">			  
								<?php while ($row = $valorInventario->fetch_object()):
									?>

								<li class="list-group-item"><h2><b>Inventario: </b> <?= number_format($row->resultado) ?></h2></li>
								<li class="list-group-item"><h2><b>Al fecha: </b> <?= date('Y-m-d') ?></h2></li>
									
								<?php endwhile; ?>
							</ul>
						</div>

					</div>



					<div class="col-md-6 col-xs-12">

					</div>



				</div>

			</div>

		</div>

	</section>

</div>
