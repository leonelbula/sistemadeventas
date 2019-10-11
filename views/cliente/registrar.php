<div class="content-wrapper">
    
  <section class="content-header">
      
    <h1>
      Registrar Nuevo Cliente
    </h1>
 
    <ol class="breadcrumb">

      <li><a href="<?=URL_BASE?>frontend/principal"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Registrar Nuevo Cliente</li>
      
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
		  <form action="<?=URL_BASE?>cliente/guardar" method="POST" >
        <div class="col-md-6">

          <div class="box box-danger">
            <div class="box-header">
              <h3 class="box-title">Informacion de Cliente</h3>
            </div>
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
			   	   
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          
          <!-- /.box -->

        </div>       
       
       
		  </form>
      </div>
      <!-- /.row -->

      </div>
        
    </div>

  </section>

</div>