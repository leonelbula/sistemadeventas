<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="<?= URL_BASE ?>frontend/principal">Principal</a>
				</li>

				<li>
					<a href="#">lista de Usuarios</a>
				</li>

			</ul><!-- /.breadcrumb -->


		</div>
		<div class="page-header">
			<h1>
				<a href="#modal-form" role="button" class="blue" data-toggle="modal">
					<button class="btn btn-info" type="submit">
						<i class="ace-icon fa fa-check bigger-110"></i>
						Registrar
					</button>
				</a>
			</h1>
		</div><!-- /.page-header --

		<div class="page-content">			
			<div class="row">
				<div class="col-xs-12">
		<!-- PAGE CONTENT BEGINS -->
		<div class="row">
			<div class="col-xs-12">
				<table id="simple-table" class="table  table-bordered table-hover">
					<thead>
						<tr>

							<th class="detail-col">Detalles</th>
							<th>Usuario</th>
							<th>Tipo</th>
							<th class="hidden-480">Estado</th>



							<th>Acciones</th>
						</tr>
					</thead>

					<tbody>
						<?php while ($row = $listaUsuario->fetch_object()): ?>
							<tr>


								<td class="center">
									<div class="action-buttons">
										<a href="#" class="green bigger-140 show-details-btn" title="Ver Detalles">
											<i class="ace-icon fa fa-angle-double-down"></i>
											<span class="sr-only">Detalles</span>
										</a>
									</div>
								</td>

								<td>
									<a href="<?= URL_BASE ?>usuario/perfil&id=<?= $row->id ?>"><?= $row->nombre ?></a>
								</td>
								<td><?= $row->tipo ?></td>
								<td class="hidden-480">
									<?php
									if ($row->estado == 1) {
										echo'Activado';
									} else {
										echo 'Desactivado';
									}
									?>
								</td>																	

								<td>
									<div class="hidden-sm hidden-xs btn-group">												
										<a href="<?= URL_BASE ?>usuario/editar&id=<?= $row->id ?>">
											<button class="btn btn-xs btn-info">
												<i class="ace-icon fa fa-pencil bigger-120"></i>
											</button>
										</a>
										<a href="<?= URL_BASE ?>usuario/eliminar&id=<?= $row->id ?>">
											<button class="btn btn-xs btn-danger">
												<i class="ace-icon fa fa-trash-o bigger-120"></i>
											</button>
										</a>
									</div>

									<div class="hidden-md hidden-lg">
										<div class="inline pos-rel">
											<button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto">
												<i class="ace-icon fa fa-cog icon-only bigger-110"></i>
											</button>

											<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
												<li>
													<a href="#" class="tooltip-info" data-rel="tooltip" title="View">
														<span class="blue">
															<i class="ace-icon fa fa-search-plus bigger-120"></i>
														</span>
													</a>
												</li>

												<li>
													<a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
														<span class="green">
															<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
														</span>
													</a>
												</li>

												<li>
													<a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
														<span class="red">
															<i class="ace-icon fa fa-trash-o bigger-120"></i>
														</span>
													</a>
												</li>
											</ul>
										</div>
									</div>
								</td>
							</tr>

							<tr class="detail-row">
								<td colspan="8">
									<div class="table-detail">
										<div class="row">											

											<div class="col-xs-12 col-sm-7">
												<div class="space visible-xs"></div>

												<div class="profile-user-info profile-user-info-striped">
													<div class="profile-info-row">
														<div class="profile-info-name"> Usuario </div>

														<div class="profile-info-value">
															<span><?= $row->nombre ?></span>
														</div>
													</div>

													<div class="profile-info-row">
														<div class="profile-info-name"> Tipo </div>

														<div class="profile-info-value">																	
															<span><?= $row->tipo ?></span>
														</div>
													</div>

													<div class="profile-info-row">
														<div class="profile-info-name"> Estado </div>

														<div class="profile-info-value">
															<span>
																<?php
																if ($row->estado == 1) {
																	echo'Activado';
																} else {
																	echo 'Desactivado';
																}
																?></span>
														</div>
													</div>



												</div>
											</div>


										</div>
									</div>
								</td>
							</tr>
						<?php endwhile; ?>

					</tbody>
				</table>
			</div>
		</div>

	</div>
</div>
<div id="modal-form" class="modal" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="blue bigger">Nuevo Registro</h4>
			</div>

			<div class="modal-body">
				<form action="<?= URL_BASE ?>usuario/guardar" enctype="multipart/form-data" method="POST">

					<div class="form-group">
						<label for="nombre">Nombre:</label>
						<input type="text" class="form-control" name="nombre" id="nombre" required>
					</div>
					<div class="form-group">
						<label for="direccion">Password:</label>
						<input type="password" name="password" placeholder="Password" class="form-control" required />
					</div>
					<div class="form-group">
						<label for="municipio">Tipo de Perfil:</label>
						<select class="form-control"  name="tipo" required>
							<option value="">Selecione una opcion</option>
							<option value="usuario">Usuario</option>
							<option value="admin">Administrador</option>									

						</select>
					</div>
					<div class="form-group">
						<label for="telefono">Desea Activar Perfil:</label>
						<select class="form-control" name="estado" required>
							<option value="">Seleccione una opcion</option>
							<option value="1">Activado</option>
							<option value="0">Desactivado</option>									

						</select>
					</div>






					<button type="submit" class="btn btn-primary">Guardar</button>
				</form>
			</div>

			<div class="modal-footer">
				<button class="btn btn-sm" data-dismiss="modal">
					<i class="ace-icon fa fa-times"></i>
					Cancelar
				</button>

			</div>
		</div>
	</div>
</div>