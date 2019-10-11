<?php

require_once 'models/Gastos.php'; 
require_once 'models/Venta.php'; 
require_once 'models/Inventario.php';

class reporteController{
	public function utilidades() {
		require_once 'views/layout/menu.php';
		if(isset($_GET["fechaInicial"])){
			
			$fechaInicial = $_GET["fechaInicial"];
            $fechaFinal = $_GET["fechaFinal"];
			
			$ventas = new Venta();
			$listaVentas = $ventas->ReportesVentas($fechaInicial,$fechaFinal);	
		}else{
			$ventas = new Venta();
			$listaVentas = $ventas->MostrarVentas();	
		}
		require_once 'views/reportes/utilidades.php';
		require_once 'views/layout/copy.php';
	}
	public function estganaciaperdidas() {
		require_once 'views/layout/menu.php';
		
			$ventas = new Venta();
			$totalVentas = $ventas->TotalVentas();
			
			$totalUtilidad = $ventas->TotalUtilidad();
			
			$gastos = new Gastos();
			$valorGastos = $gastos->TotalGastos();
		
		require_once 'views/reportes/estganaciaperdidas.php';
		require_once 'views/layout/copy.php';
	}
	public function valorinventario() {
		require_once 'views/layout/menu.php';
		$inventario = new Inventario();
		
		$valorInventario = $inventario->ValorInventario();
				
		require_once 'views/reportes/valorinventario.php';
		require_once 'views/layout/copy.php';
	}
}
