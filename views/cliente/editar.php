<div class="content-wrapper">
    
  <section class="content-header">
      
    <h1>
      Editar Cliente
    </h1>
 
    <ol class="breadcrumb">

      <li><a href="<?=URL_BASE?>frontend/principal"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Editar Cliente</li>
      
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
		  <a href="<?=URL_BASE?>cliente/">
          <button class="btn btn-primary">

           Cancelar

          </button>
		  </a>
      </div>
		

      <div class="box-body">
         
      
      <div class="row">
		  <form action="<?=URL_BASE?>cliente/Actualizar" method="POST" >
        <div class="col-md-6">

          <div class="box box-danger">
            <div class="box-header">
              <h3 class="box-title">Informacion del Clieente</h3>
            </div>
            <div class="box-body">
				<?php 
					while ($row1 = $detallesCliente->fetch_object()):					
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
				<div class="form-group">
                <label>Tipo de Cliente:</label>

                <select class="form-control select2" name="tipo" style="width: 100%;">
                  <option selected="selected">Seleciones el tipo</option>
				  <option value="1" <?=$row1->tipo == 1?'selected ': ''?>>Por Mayor</option>                
				  <option value="0" <?=$row1->tipo == 0?'selected ': ''?>>Cliente Generico</option>				
                </select>
                <!-- /.input group -->
              </div>
              <!-- Date -->
              <div class="form-group">              
                <label>Precio a facturar:</label>

                <select class="form-control select2" name="precio_fact" style="width: 100%;">
                  <option selected="selected">Seleciones una opcion</option>
				  <option value="1" <?=$row1->precio_fact == 1?'selected ': ''?>>Precio 1</option>                  
				  <option value="2" <?=$row1->precio_fact == 2?'selected ': ''?>>Precio 2</option>
				  <option value="3" <?=$row1->precio_fact == 3?'selected ': ''?>>Precio 3</option>		
                </select>
                <!-- /.input group -->
              </div>
			  <div class="form-group">
               <label>Se aplica interes por Mora:</label>
                <select class="form-control select2" name="interes" style="width: 100%;">
					<option value="0" selected="selected">Seleciones la opcion</option>
					<option value="0"  <?=$row1->interes == 0 ?'selected ': ''?>>No se le Aplica Interes</option>
                  <?php 
						$retencion= ExtrasController::listaIntereses();
						while ($rowR = $retencion->fetch_object()):							
						
					?>
				  <option value="<?=$rowR->porcentaje?>"<?=$row1->interes == $rowR->porcentaje ?'selected ': ''?>><?=$rowR->descripcion?></option>
				  <?php endwhile; ?>     
                </select>
              </div>
              <!-- /.form group -->

              <!-- Date range -->
              <div class="form-group">
                <label>Cuenta Contable:</label>

                <select class="form-control select2" name="cuentacontable" style="width: 100%;">
					<option  value="0" selected="selected">Seleciones Cuenta Contable</option>
				  <?php 
						$cuentas = CuentasContableController::ListarCuentas();
						while ($row = $cuentas->fetch_object()):							
						
					?>
				  <option value="<?=$row->num_cuenta?>" <?=$row1->cuenta_contable == $row->num_cuenta ? 'selected':''?>><?=$row->num_cuenta?> - <?=$row->descripcion?></option>
				  <?php endwhile; ?>                
              
                 
                </select>
                <!-- /.input group -->
              </div>
			  <button class="btn btn-primary" type="submit">

            Editar cliente

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