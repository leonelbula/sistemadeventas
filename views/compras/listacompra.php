<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>
			Gestor de Compra

		</h1>
		<ol class="breadcrumb">
			<li><a href="<?= URL_BASE ?>frontend/principal"><i class="fa fa-dashboard"></i> Pincipal</a></li>
			<li><a>Compras</a></li>

		</ol>
    </section>
	
    <!-- Main content -->
    <section class="content">

		<!-- Default box -->
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title">lista de Compras</h3>

			</div>
			<div class="box-body">
				<div class="box-header with-border">
					<a href="<?= URL_BASE ?>compras/nuevacompra">
						<button class="btn btn-primary">

							Nuevo Compra

						</button>
					</a>
					<button type="button" class="btn btn-default pull-right" id="daterange-btn2">

						<span>
							<i class="fa fa-calendar"></i> Rango de fecha
						</span>

						<i class="fa fa-caret-down"></i>

					</button>
				</div>
			</div>
			<div class="box-body">
				<table id="tablascompras" class="table table-bordered table-striped dt-responsive" width="100%">
					<thead>
						<tr>
							<th>#</th>
							<th>N° Factura</th>
							<th>Proveedor</th>
							<th>fecha</th>
							<th>fecha Vencimiento</th>
							<th>valor</th> 
							<th>Tipo</th>
							<th>acciones</th>							
						</tr>
					</thead>
					<tbody>
						<?php
						$i = 1;
						while ($row = $listaCompra->fetch_object()) {
							echo '<tr>

							 <td>' . ($i++) . '</td>

							 <td>' . $row->numero_factura . '</td>';
							$id = $row->id_proveedor;
							$detallesProveedor = ProveedorController::MostrarproveedorId($id);
							while ($row1 = $detallesProveedor->fetch_object()) {
								$Nomproveedor = $row1->nombre;
							}
							echo '<td>' . $Nomproveedor . '</td>';


							echo '<td>' . $row->fecha . '</td>
							 <td>' . $row->fecha_vencimiento . '</td>
							 <td>$ ' . number_format($row->total) . '</td>';
							;
							if ($row->tipo == 1) {

								$tipo = "<button class='btn btn-primary btn-xs'>Credito</button>";
							} else {

								$tipo = "<button class='btn btn-info btn-xs'>Contado</button>";
							}
							echo'<td>' . $tipo . '</td>                              
                 
					 <td>

                    <div class="btn-group">
                        
                      <button class="btn btn-info btnImprimirFactura" codigoCompra="'.$row->numero_factura.'">

                        <i class="fa fa-print"></i>

                      </button>';

							if ($_SESSION["identity"]->tipo == "admin") {

								echo '<button class="btn btn-warning btnEditarCompra" idCompra="'.$row->id.'"><i class="fa fa-pencil"></i></button>

                      <button class="btn btn-danger btnEliminarCompra" idCompra="'.$row->id.'"><i class="fa fa-times"></i></button>';
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
				lista compras
			</div>
			<!-- /.box-footer-->
		</div>
		<!-- /.box -->

    </section>
    <!-- /.content -->
</div>
