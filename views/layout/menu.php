<?php
if (!isset($_SESSION['identity'])) {
	echo'<script>

					swal({
						  type: "success",
						  title: "Cerrado sistema",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "'.URL_BASE.'";

							}
						})

	</script>';
	//header('Location:' . URL_BASE);
}
?>
<div class="wrapper">
  <header class="main-header">
    <!-- Logo -->
    <a href="<?=URL_BASE?>frontend/principal" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>SACV</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b> - SACV</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Navegación</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">        
        
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-shopping-cart text-red"></i> Hay Productos Stock bajo
                    </a>
                  </li>                  
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-red"></i> 5 Pedido
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-user text-red"></i> You changed your username
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>         
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?= URL_BASE ?>assets/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?= $_SESSION['identity']->nombre ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?= URL_BASE ?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  <?= $_SESSION['identity']->nombre ?>
                 
                </p>
              </li>           
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Perfil</a>
                </div>
                <div class="pull-right">
                  <a href="<?=URL_BASE?>usuario/salir" class="btn btn-default btn-flat">salir</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">   
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">NAVEGACIÓN PRINCIPAL</li>
        <li class="">
          <a href="<?=URL_BASE?>frontend/principal">
            <i class="fa fa-dashboard"></i> <span>Principal</span>            
          </a>         
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>CLIENTES</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?=URL_BASE?>cliente/"><i class="fa fa-circle-o"></i> lista de Clientes</a></li>            
            <li><a href="<?=URL_BASE?>cliente/estadocuenta"><i class="fa fa-circle-o"></i> Estado de Cuenta</a></li>
                 
          </ul>
        </li>        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-th"></i>
            <span>PEDIDO</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?=URL_BASE?>pedido/"><i class="fa fa-circle-o"></i>Realuzar Pedidos</a></li>   
      		
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>PRODUCTOS</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?=URL_BASE?>inventario/"><i class="fa fa-circle-o"></i> Lista de Productos</a></li>
            <li><a href="<?=URL_BASE?>categoria/"><i class="fa fa-circle-o"></i> Categorias</a></li>         
		   
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>PROVEEDORES</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
			  <li><a href="<?=URL_BASE?>proveedor/"><i class="fa fa-circle-o"></i> Lista Proveedores</a></li>
            <li><a href="<?=URL_BASE?>proveedor/estadocuentaproveedor"><i class="fa fa-circle-o"></i> Estado Cuenta</a></li>
                   
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i> <span>VENTAS</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?=URL_BASE?>ventas/listarventas"><i class="fa fa-circle-o"></i> Ventas</a></li>
            <li><a href="<?=URL_BASE?>ventas/reporteventas"><i class="fa fa-circle-o"></i> Reportes Ventas</a></li>          
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-table"></i> <span>COMPRAS</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?=URL_BASE?>compras/Compras"><i class="fa fa-circle-o"></i>Lista Compras</a></li>
<!--			<li><a href="<?=URL_BASE?>compras/"><i class="fa fa-circle-o"></i> Compras por periodo</a></li> -->
            <li><a href="<?=URL_BASE?>compras/reportecompra"><i class="fa fa-circle-o"></i> Reportes</a></li>
          </ul>
        </li> 
		<li class="treeview">
          <a href="#">
            <i class="fa fa-book"></i>
            <span>GASTOS</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
			  <li><a href="<?=URL_BASE?>gastos/"><i class="fa fa-circle-o"></i>Gastos</a></li>     
            <li><a href="<?=URL_BASE?>gastos/nuevogastos"><i class="fa fa-circle-o"></i>Regitrar Gastos</a></li>     
      			
      			<li><a href="<?=URL_BASE?>gastos/reportes"><i class="fa fa-circle-o"></i> Reportes</a></li> 
          
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-folder"></i> <span>REPORTES</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?=URL_BASE?>reporte/utilidades"><i class="fa fa-circle-o"></i>Utilidades</a></li>
            <li><a href="<?=URL_BASE?>reporte/estganaciaperdidas"><i class="fa fa-circle-o"></i>Estado Ganacias y Perdidas</a></li>
            <li><a href="<?=URL_BASE?>reporte/valorinventario"><i class="fa fa-circle-o"></i> Valor Inventario</a></li>           
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-share"></i> <span>USUARIOS</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i> Registrar Usuario</a></li>
            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Permisos de Usuario
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>              
            </li>           
          </ul>
        </li>
        <li><a href="<?=URL_BASE?>parametros/"><i class="fa fa-book"></i> <span>PARAMETROS</span></a></li>
       
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>