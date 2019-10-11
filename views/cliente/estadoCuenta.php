<div class="content-wrapper">
    
  <section class="content-header">
      
    <h1>
      Gestor de cuentas Clientes
    </h1>
 
    <ol class="breadcrumb">

      <li><a href="<?=URL_BASE?>frontend/principal"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Gestor estado de cuenta</li>
      
    </ol>

  </section>

  <section class="content">

    <div class="box">      
		

      <div class="box-body">
         
        <table class="table table-bordered table-striped dt-responsive tablaestadocuentacliente" width="100%">

          <thead>
            
            <tr>
              
              <th style="width:10px">Codigo</th>			 
              <th>Razon Social</th>
			  <th>Nit</th> 			  		
			  <th>Total Compra</th>
			  <th>Saldo</th> 		 
			  <th>Acciones</th>

            </tr>

          </thead>
		   <tbody>
			   <?php 
			   
			   foreach ($listaEstado as $key => $value):			  
			  
				
				 ?>
                <tr>
                  <td><?= $value['id_cliente']?></td>
				  <?php $proveedor = ClienteController::MostrarClienteId($value['id_cliente']);
				  
				 
				  
                   foreach ($proveedor as $key => $valueP) {
					   echo '<td>'.$valueP['nombre'].'</td>
							<td>'.$valueP['nit'].'</td>';
					   
                   }
					
				  ?>                
				
				  <td><?= number_format($value['total']) ?></td>
				  <td><?= number_format($value['saldo']) ?></td>
				  		  
                  <td>
					  <div class="btn-group">
						  <a href="<?=URL_BASE?>cliente/verestadocuentacliente&id=<?=$value['id_cliente']?>">
							  <button class="btn btn-warning btnEditarCategoria">
								  <i class="fa fa-eye"></i>
							  </button>
						  </a>
						 
					  </div>
				  </td>
                </tr>
				<?php endforeach; ?>
		   </tbody>

        </table> 

      </div>
		
        
    </div>
	  <div class="box-footer">
          Cuentas Cliente
        </div>

  </section>

</div>

