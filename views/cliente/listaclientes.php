  <div class="content-wrapper">
    
  <section class="content-header">
      
    <h1>
      Gestor Cliente
    </h1>
 
    <ol class="breadcrumb">

      <li><a href="<?=URL_BASE?>frontend/principal"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Gestor Cliente</li>
      
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
		  <a href="<?=URL_BASE?>cliente/registrar">
          <button class="btn btn-primary">

            Nuevo Cliente

          </button>
		  </a>
      </div>
		

      <div class="box-body">
         
        <table class="table table-bordered table-striped dt-responsive tablacliente" width="100%">

          <thead>
            
            <tr>
              
              <th style="width:10px">Codigo</th>
              <th>Razon Social o Nombre</th>
			  <th>Nit</th> 
			  <th>Direccion</th>
			  <th>Ciudad</th>
			  <th>Departamento</th> 
			  <th>Telefono</th>
			  <th>Correo</th>
			 
               <th>Acciones</th>

            </tr>

          </thead>
		  

        </table> 

      </div>
		
        
    </div>
	  <div class="box-footer">
          Proveedores
        </div>

  </section>

</div>
