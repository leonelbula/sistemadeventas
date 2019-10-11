<div class="content-wrapper">
    
  <section class="content-header">
      
    <h1>
      Editar Proveedor
    </h1>
 
    <ol class="breadcrumb">

      <li><a href="<?=URL_BASE?>frontend/principal"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Editar Proveedor</li>
      
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
		  <a href="<?=URL_BASE?>proveedor/">
          <button class="btn btn-primary" >

           Cancelar

          </button>
		  </a>
      </div>
		

      <div class="box-body">
         
      
      <div class="row">
		  <form action="<?=URL_BASE?>proveedor/Actualizar" method="POST" >
        <div class="col-md-6">

          <div class="box box-danger">
            <div class="box-header">
              <h3 class="box-title">Informacion de Proveedor</h3>
            </div>
            <div class="box-body">
				<?php 
					while ($row1 = $detallesProveedor->fetch_object()):					
				?>
              <!-- Date dd/mm/yyyy -->
              <div class="form-group">
                <label>Nombre:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-user"></i>
                  </div>
					<input type="hidden" value="<?=$row1->id?>" name="id">
					<input type="text" class="form-control" value="<?=$row1->nombre?>" name="nombre" required>
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->

              <!-- Date mm/dd/yyyy -->
              <div class="form-group">
				  <label>Nit - CC:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-tag"></i>
                  </div>
					<input type="text" class="form-control" value="<?=$row1->nit?>" name="nit" required>
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->

              <!-- phone mask -->
              <div class="form-group">
                <label>Direccion:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-bookmark-o"></i>
                  </div>
					<input type="text" class="form-control" value="<?=$row1->direccion?>"  name="direccion" required>
                </div>
                <!-- /.input group -->
              </div>
			  <div class="form-group">
                <label>Departamento:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-bookmark-o"></i>
                  </div>
					<input type="text" class="form-control" value="<?=$row1->departamento?>"  name="departamento" required>
                </div>
                <!-- /.input group -->
              </div>
			  <div class="form-group">
                <label>Ciudad:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-bookmark-o"></i>
                  </div>
					<input type="text" class="form-control" value="<?=$row1->ciudad?>"  name="ciudad" required>
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->

              <!-- phone mask -->
              <div class="form-group">
                <label>Telefono:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>
					<input type="text" class="form-control" value="<?=$row1->telefono?>"  name="telefono" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->

              <!-- IP mask -->
              <div class="form-group">
                <label>Email:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-envelope-o"></i>
                  </div>
					<input type="text" class="form-control" value="<?=$row1->email?>"  name="email" >
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
			   <div class="form-group">
                <label>Vendedor:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>
					<input type="text" class="form-control" value="<?=$row1->vendedor?>"  name="vendedor" >
                </div>
                <!-- /.input group -->
              </div>
			   <div class="form-group">
                <label>Telefono vendedor:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>			
					 <input type="text" class="form-control" value="<?=$row1->tel_vendedor?>"   name="tel_vendedor" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                </div>
                <!-- /.input group -->
              </div>

            </div>
            <!-- /.box-body -->
          </div>
         
        </div>
        <!-- /.col (left) -->
        <div class="col-md-6">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Informacion Contable</h3>
            </div>
            <div class="box-body">
              <!-- Date -->
              <div class="form-group">
                <label>Tipo de Impuesto:</label>

                <select class="form-control select2" name="impuesto" style="width: 100%;">
                  <option selected="selected">Seleciones el impueto</option>
				  <option value="0">No se le Aplica Impuesto</option>
                  <?php 
						$impuesto = ImpuestoController::listaImpuesto();
						while ($rowI = $impuesto->fetch_object()):					
						
					?>
				  <option value="<?=$rowI->porcentaje?>"<?= $row1->impuesto == $rowI->porcentaje ? 'selected':'' ?>><?=$rowI->nombre?></option>
				  <?php endwhile; ?>    
                </select>
                <!-- /.input group -->
              </div>
			            
              
			  <button class="btn btn-primary" type="submit">

            Editar proveedor

          </button>
			
            </div>
            <!-- /.box-body -->
          </div>
        
        <?php endwhile; ?>
        </div>
        <!-- /.col (right) -->
		  </form>
      </div>
      <!-- /.row -->
	  </div>
      </div>
        
    </div>

  </section>

</div>