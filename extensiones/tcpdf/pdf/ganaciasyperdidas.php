<?php

require_once '../../../config/DataBase.php';

class Reportes {
	
public $db;


public function __construct() {
$this->db = Database::connect();
}	

public function ReportesGastos($fechaInicial,$fechaFinal) {

		
if($fechaInicial == $fechaFinal){
$sql = "SELECT * FROM gastos WHERE fecha LIKE '%$fechaFinal%'";
			
} else {
			
$fechaActual = new DateTime();
$fechaActual->add(new DateInterval("P1D"));
$fechaActualMasUno = $fechaActual->format("Y-m-d");

$fechaFinal2 = new DateTime($fechaFinal);
$fechaFinal2->add(new DateInterval("P1D"));
$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

if ($fechaFinalMasUno == $fechaActualMasUno) {

$sql = "SELECT * FROM gastos WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'";
} else {
$sql = "SELECT * FROM gastos WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal'";
}
}
		
		
$resul = $this->db->query($sql);
return $resul;
}

public function ReportesVentas($fechaInicial,$fechaFinal) {

		
if($fechaInicial == $fechaFinal){
$sql = "SELECT * FROM venta WHERE fecha LIKE '%$fechaFinal%'";
			
} else {
			
$fechaActual = new DateTime();
$fechaActual->add(new DateInterval("P1D"));
$fechaActualMasUno = $fechaActual->format("Y-m-d");

$fechaFinal2 = new DateTime($fechaFinal);
$fechaFinal2->add(new DateInterval("P1D"));
$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

if ($fechaFinalMasUno == $fechaActualMasUno) {

$sql = "SELECT * FROM venta WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'";
} else {
$sql = "SELECT * FROM venta WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal'";
}
}
		
		
$resul = $this->db->query($sql);
return $resul;
}

public function MostrarInformacionEmpresa() {
$sql = "SELECT * FROM datos_empresa ";
$resul = $this->db->query($sql);
return $resul;
}
}


//require_once '../../../controllers/ClienteController.php';
//require_once '../../../controllers/InventarioController.php';
class imprimirReporte{

public $fechaInicio;
public $fechaFinal;

public function traerImpresionReporte(){
$fechaInicial = $this->fechaInicio;
$fechaFinal = $this->fechaFinal;

$reporte = new Reportes();
$detalles = $reporte->ReportesGastos($fechaInicial,$fechaFinal);
$detallesU = $reporte->ReportesVentas($fechaInicial,$fechaFinal);
$fechaI = $_GET['fechaInicial'];


$datosEmpresa = $reporte->MostrarInformacionEmpresa();

foreach ($datosEmpresa as $key => $valueE) {
$nomEmpresa = $valueE['nombre'];
$nitEmpresa = $valueE['nit'];
$dirEmpresa = $valueE['direccion'];
$ciuEmpresa = $valueE['ciudad'];
$depEmpresa = $valueE['departamento'];
$telEmpresa = $valueE['telefono'];
}

while ($row = $detalles-> fetch_object()) {
$descripcion = $row->descripcion;
$fecha = $row->fecha;
$valor = $row->valor;

$arraytotalG[] = array('valor' => (int)$valor);

}

$valorTotalG =  array_column($arraytotalG, 'valor');
$TotalGasto = array_sum($valorTotalG);

while ($row = $detallesU-> fetch_object()) {

$utilidad = $row->utilidad;
$total = $row->total;

$arrayUtilida[] = array('valor' => (int)$utilidad);
$arraytotal[] = array('valor' => (int)$total);

}


$valorUtilida =  array_column($arrayUtilida, 'valor');
$TotalUtilidad = number_format(array_sum($valorUtilida));

$valorTotal =  array_column($arraytotal, 'valor');
$TotalT = number_format(array_sum($valorTotal));


$totalSU = array_sum($valorUtilida);

$ganaciaNeta = number_format((int)$totalSU - (int)$TotalGasto);

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

//$pdf->setPrintHeader(false);
//$pdf->setPrintFooter(false);
$pdf->startPageGroup();

$pdf->AddPage();

$bloque1 = <<<EOF
<table>
		
		<tr>
			
			<td style="width:170px">
				
				<div style="font-size:8.5px; text-align:right; line-height:15px;">
									
					<h3>$nomEmpresa</h3>				
					
				</div>
			</td>

			<td style="background-color:white; width:110px">
				
				<div style="font-size:8.5px; text-align:right; line-height:15px;">
					
					<br>
					NIT: $nitEmpresa

					<br>
					$dirEmpresa

				</div>

			</td>

			<td style="background-color:white; width:90px">

				<div style="font-size:8.5px; text-align:right; line-height:15px;">
					
					<br>
					Teléfono: $telEmpresa
					
					<br>
					$ciuEmpresa -- $depEmpresa

				</div>
				
			</td>

			<td style="background-color:white; width:130px; text-align:center; color:red">
				<br><br>
					Reporte de ganacias
					<div style="font-size:8.5px; text-align:right; line-height:15px;">
					Fecha Inicio: $fechaI
					<br>
					
					Fecha Final: $fechaFinal
					

				</div>
					
		
				</td>

		</tr>
		

	</table>

		
EOF;

$pdf->writeHTML($bloque1 ,false, false, false, false, '');
// ---------------------------------------------------------

// ---------------------------------------------------------


$bloque3 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">
		<tr>
		
			<td style=" color:#333; background-color:white; width:540px; text-align:left"></td>
		</tr>
		<tr>
		<td style="border: 1px solid #666; background-color:white; width:540px; text-align:center; font-weight: bold">
			Ganacias y perdidas 
		</td>			

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

$bloque4 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>
			<td style="color:#333; background-color:white; width:200px; text-align:left">
			<h4>UTILIDAD</h4>
			
			</td>
		
			<td style="color:#333; background-color:white; width:70px; text-align:left">
			
			</td>	
			<td style="color:#333; background-color:white; width:270px; text-align:left">
			
			</td>	
			
			<td style=" color:#333; background-color:white; width:45px; text-align:center"> 
				
			</td>


		</tr>

	</table>


EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');

// ---------------------------------------------------------






$bloque5 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>
			<td style="color:#333; background-color:white; width:200px; text-align:left">			
			Venta de mercancia
			</td>		
			<td style="color:#333; background-color:white; width:70px; text-align:left">
			
			</td>	
			<td style="color:#333; background-color:white; width:270px; text-align:left">
			$TotalT
			</td>	
			
			<td style=" color:#333; background-color:white; width:45px; text-align:center"> 
				
			</td>


		</tr>
		<tr>
			<td style="color:#333; background-color:white; width:200px; text-align:left">			
			Utilidad en Ventas
			</td>		
			<td style="color:#333; background-color:white; width:70px; text-align:left">
			
			</td>	
			<td style="color:#333; background-color:white; width:270px; text-align:left">
			$TotalUtilidad
			</td>	
			
			<td style=" color:#333; background-color:white; width:45px; text-align:center"> 
				
			</td>


		</tr>

	</table>


EOF;

$pdf->writeHTML($bloque5, false, false, false, false, '');

// ---------------------------------------------------------

$bloque6 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>
			<td style="color:#333; background-color:white; width:200px; text-align:left">
			<h4>GASTOS</h4>
			
			</td>
		
			<td style="color:#333; background-color:white; width:70px; text-align:left">
			
			</td>	
			<td style="color:#333; background-color:white; width:270px; text-align:left">
			
			</td>	
			
			<td style=" color:#333; background-color:white; width:45px; text-align:center"> 
				
			</td>


		</tr>

	</table>


EOF;

$pdf->writeHTML($bloque6, false, false, false, false, '');

// ---------------------------------------------------------


foreach ($detalles as $key => $value) {

$id = $value['id'];
$fecha = $value['fecha'];
$valor = number_format($value['valor']);
$descripcion = $value['descripcion'];



$bloque7 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>
			<td style="color:#333; background-color:white; width:200px; text-align:left">			
			$descripcion
			</td>		
			<td style="color:#333; background-color:white; width:70px; text-align:left">
			
			</td>	
			<td style="color:#333; background-color:white; width:270px; text-align:left">
			($valor)
			</td>	
			
			<td style=" color:#333; background-color:white; width:45px; text-align:center"> 
				
			</td>


		</tr>

	</table>


EOF;

$pdf->writeHTML($bloque7, false, false, false, false, '');
}

$bloque8 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		
		<tr>		
		<th style=" background-color:white; width:200px; text-align:center; font-weight: bold">Utilidad Neta:</th>	
		<th style=" background-color:white; width:70px; text-align:center; font-weight: bold"></th>
		<th style=" background-color:white; width:270px; text-align:left; font-weight: bold">$ganaciaNeta</th>
		<th style=" background-color:white; width:45px; text-align:center; font-weight: bold"></th>
			

		</tr>		

	</table>

EOF;

$pdf->writeHTML($bloque8, false, false, false, false, '');
// ---------------------------------------------------------

// ---------------------------------------------------------


$bloque9 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">
		<tr>
		
			<td style=" color:#333; background-color:white; width:540px; text-align:left"></td>
		</tr>
		<tr>
		<td style="border: 1px solid #666; background-color:white; width:540px; text-align:center; font-weight: bold">
			Ganacias y perdidas 
		</td>			

		</tr>

	</table>

EOF;
$pdf->writeHTML($bloque9, false, false, false, false, '');
//SALIDA DEL ARCHIVO 
$pdf->Output('factura.pdf');
}

}

$reporte = new imprimirReporte();
$reporte-> fechaInicial = $_GET["fechaInicial"];
$reporte-> fechaFinal = $_GET["fechaFinal"];

$reporte ->traerImpresionReporte();

?>
