<div class="content-wrapper">
    
  <section class="content-header">
      
    <h1>
      Detalles Proveedor
    </h1>
 
    <ol class="breadcrumb">

      <li><a href="<?=URL_BASE?>frontend/principal"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Detalles Proveedor</li>
      
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
		  <a href="<?=URL_BASE?>ventas/inicarventas">
          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCategoria">

          volver

          </button>
		  </a>
      </div>
		

      <div class="box-body">
         
		  <div class="panel panel-default">
			  <div class="panel-heading">Informacion de cierre de caja</div>
				<ul class="list-group">			  
				<?php while ($row = $detalles ->fetch_object()):

				 ?>
			  
					<li class="list-group-item"><h3><b>FECHA INICIO:</b> <?= $row->fecha_inicio?></h3></li>
					<li class="list-group-item"><h3><b>VENTA TOTAL:</b> <?=number_format($row->totalingresos)?></h3></li>
				  <li class="list-group-item"><h3><b>GASTOS:</b> <?= number_format($row->totalgastos)?></h3></li>
				  <li class="list-group-item"><h3><b>EFECTIVO ENTREGADO:</b> <?= number_format($row->montoentregado) ?></h3></li>
				  <li class="list-group-item"><h3><b>DIFERENCIA:</b> <?= number_format($row->diferencia)?></h3></li>
				  <li class="list-group-item"><h3><b>FECHA DE CIERRE:</b> <?= $row->fecha_cierre?></h3></li>
				  
				  <?php endwhile; ?>
			  </ul>
		  </div>

   

      </div>
	</div>
        
    </div>

  </section>

</div>
