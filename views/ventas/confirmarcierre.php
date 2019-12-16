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
          <button class="btn btn-primary">

          volver

          </button>
		  </a>
      </div>
		

      <div class="box-body">
         
		  <div class="panel panel-default">
			  <div class="panel-heading">Informacion de Cierre</div>
				<ul class="list-group">
					<li class="list-group-item"><b><h2>Venta Total:</b> <?= number_format($ventatotal)?></h2>
					<h2><b style="color:#C0392B;">Gastos:</b> - <?=number_format($gastoGenerado)?></h2>					
					<h2><b>Abonos Clientes:</b> <?=number_format($valorAbonos)?></h2>
					<h2><b>VALOR TOTAL:</b> <?=number_format($montoDiario)?></h2></li>
					<li class="list-group-item"><b><h2>Efectivo Entregado:</b> <?=number_format($montoentregado)?></h2></li>
					<li class="list-group-item"><b><h2 style="color:#58D68D;">Diferencia:</b> <?= number_format($diferencia)?></h2></li>
					<li class="list-group-item"><b><h3>Caja base:</b> <?= number_format($basecaja)?></h3></li>
					
				 
			  </ul>
		  </div>
		  <form action="<?= URL_BASE ?>ventas/guardarcierre" method="POST">			  
			  <input type="hidden" name="id" value="<?= $id ?>" />
			   <input type="hidden" name="ventatotal" value="<?= $montoDiario ?>" />
			  <input type="hidden" name="gastototal" value="<?= $gastoGenerado ?>" />
			  <input type="hidden" name="montoentregado" value="<?= $montoentregado ?>" />
			  <input type="hidden" name="diferencia" value="<?= $diferencia ?>" />
			  <button type="submit" class="btn btn-primary btn-lg">Confirmar Cierre de caja</button>
		  </form>
   

      </div>
	</div>
        
    </div>

  </section>

</div>
