<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>
			Lista de Mesas

		</h1>
		<ol class="breadcrumb">
			<li><a href="<?= URL_BASE ?>frontend/principal"><i class="fa fa-dashboard"></i> Pincipal</a></li>
			<li><a>Mesas</a></li>

		</ol>
    </section>
	
    <!-- Main content -->
    <section class="content">
		
      <!-- /.row -->
    		<!-- Default box -->
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title">lista de Mesas</h3>

			</div>
			<div class="box-body">
				<div class="box-header with-border">
					
						<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalRegistrarMesa" data-dismiss="modal">
							Agregar mesa
						</button>
					
				</div>
			</div>
			<div class="box-body">
				<table class=" table table-bordered table-striped dt-responsive" style="width:100%">
					<thead>
						<tr>
							<th>#</th>
							<th>mesa</th>			
												
							<th>acciones</th>							
						</tr>
					</thead>
					<tbody>
						<?php
						$i = 1;
						while ($row = $listarMesa->fetch_object()) {
							echo '<tr>

							 <td>' . ($i++) . '</td>';						
							
							echo '<td>
								<div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>' . $row->nombre . '</h3>             
            </div>
            
            <a href="#" class="small-box-footer">Mas Informacion <i class="fa fa-arrow-circle-right"></i></a>
          </div></td>

					 <td>

                    <div class="btn-group">';                        
                      

							if ($_SESSION["identity"]->tipo == "admin") {

								echo '
									 <button class="btn btn-danger btnEliminar" idMesa="'.$row->id_mesa.'"><i class="fa fa-times"></i></button>';
							}

							echo '</div>  
						
                  </td>
				  <td>				 
				  </td>

                </tr>';
						}
						?>
					</tbody>
				</table>
			</div>
			<!-- /.box-body -->
			<div class="box-footer">
				lista mesas
			</div>
			<!-- /.box-footer-->
		</div>
		<!-- /.box -->

    </section>
    <!-- /.content -->
</div>


<div id="modalRegistrarMesa" class="modal fade" role="dialog">

	<div class="modal-dialog">

		<div class="modal-content">

			<form role="form" action="<?= URL_BASE ?>mesa/registrarmesa" method="POST" >

				<!--=====================================
				CABEZA DEL MODAL
				======================================-->

				<div class="modal-header" style="background:#3c8dbc; color:white">

					<button type="button" class="close" data-dismiss="modal">&times;</button>

					<h4 class="modal-title">Agregar Mesa</h4>

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

					</div>

				</div>

				<!--=====================================
				PIE DEL MODAL
				======================================-->

				<div class="modal-footer">

					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

					<button type="submit" class="btn btn-primary">Guardar </button>

				</div>

			</form>     

		</div>

	</div>

</div>