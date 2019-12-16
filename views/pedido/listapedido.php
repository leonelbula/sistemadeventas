<div class="content-wrapper">
    
  <section class="content-header">
      
    <h1>
      Gestor Pedidos
    </h1>
 
    <ol class="breadcrumb">

      <li><a href="<?=URL_BASE?>frontend/principal"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Gestor Pedidos</li>
      
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
		 
      </div>
		

      <div class="box-body">
         
		  <table id="tablasPedido" class="table table-bordered table-striped dt-responsive " width="100%">

          <thead>
            
            <tr>
              
              <th style="width:10px">Codigo</th>
              <th>Razon Social</th>   			 
			  <th>Telefono</th>
			  <th>Correo</th>
			  <th>Vendedor</th>
			  <th>Tel-Vendedor</th>
               <th>Acciones</th>

            </tr>

          </thead>
		   <tbody>
			   <?php 
			   	
			   foreach ($listaproveedor as $key => $value):			  
			  
				
				 ?>
                <tr>
				  <td><?= $value['id']?></td>	  
                  <td><?= $value['nombre']?></td>
				  <td><?= $value['telefono']?></td>
				  <td><?= $value['email']?></td>
				  <td><?= $value['vendedor']?></td>
				  <td><?= $value['tel_vendedor']?></td>
				 
                  <td>
					  <div class="btn-group">
						 
							  <button class="btn btn-warning btnverpedido" verPedido=<?=$value['id']?>>
								  <i class="fa fa-eye"></i>
							  </button>
							  
						 
						 
					  </div>
				  </td>
                </tr>
				<?php endforeach; ?>
		   </tbody>

        </table> 

      </div>
		
        
    </div>
	  <div class="box-footer">
          Pedidos
        </div>

  </section>

</div>

<script>
	$(function () {
    $('#tablasPedido').DataTable()   
  })

</script>
