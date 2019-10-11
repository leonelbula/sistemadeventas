<?php

require_once 'models/Venta.php';
require_once 'models/Compra.php';
require_once 'models/Cliente.php';
require_once 'models/Inventario.php';


class frontendController{
	
	public function index() {
		
		require_once 'views/login/login.php';
		
	}	
	public function Principal() {
		require_once 'views/layout/menu.php';
		$ventas = new Venta();
		$Compra = new Compra();	
		$Cliente = new Cliente();
		$Inventario = new Inventario();	
		
		$totalCompra = $Compra->TotalCompras();
		$totalVentas = $ventas->TotalVentas();
		$totalCliente = $Cliente->TotalClientes();
		$totalProductos = $Inventario->TotalProductos();
		
		require_once 'views/layout/principal.php';
		require_once 'views/layout/copy.php';
		
	}
}

