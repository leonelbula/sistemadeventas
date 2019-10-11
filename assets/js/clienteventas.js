
	
 //$.ajax({

 	//url: "../ajax/tablaclienteventa.php",
 //	success:function(respuesta){
		//	console.log("respuesta", respuesta);
//	}

//})
 
 $('.tablaclienteventa').DataTable( {
    "ajax": "../ajax/tablaclienteventa.php",
    "deferRender": true,
	"retrieve": true,
	"processing": true,
	 "language": {

			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
			"sFirst":    "Primero",
			"sLast":     "Último",
			"sNext":     "Siguiente",
			"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}

	}

} );

$(".tablaclienteventa tbody").on("click", "button.agregarCliente", function(){
	
	var idCliente = $(this).attr("idCliente");
			
	$("button.agregarCliente").addClass('disabled');
		
	$(this).addClass("btn-default");
	
	$("#modalAgregarCliente").modal("hide");
	
	var datos = new FormData();
    datos.append("idCliente", idCliente);
	
	$.ajax({

		url: "../ajax/ajaxCliente.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function (respuesta) {

			//console.log("Respuesta", respuesta);
			var idCliente = respuesta["id"];
			var Nit = respuesta["nit"];
			var Nombre = respuesta["nombre"];
			var Direccion = respuesta["direccion"];
			var Departamento = respuesta["departamento"];
			var Ciudad = respuesta["ciudad"];
			var Email = respuesta["email"];
			var Telefono = respuesta["telefono"];		
			 
							 
			$(".cabeceraVenta").append(
					'<div class="col-sm-4 invoice-col">'+					
					'<input type="hidden" class="idclienteventa" value="'+idCliente+'"/>'+					
					'<input type="hidden" class="IdCliente" idClieT ="'+idCliente+'"  value="'+idCliente+'" />'+
				'<address>'+
					'<strong> Cliente </strong><br>'+
					''+Nombre+'<br>'+Direccion+					
					'<br>Telefono:'+Telefono+
					'Email:'+Email+
				'</address>'+
			'</div>'+			
			'<div class="col-sm-4 invoice-col">'+
				'C.C o Nit.'+Nit+
				'<address>'+
					'<strong>Departamento:'+Departamento+'</strong><br>'+				
					'<strong>Ciudad:'+Ciudad+'</strong><br>'+
				'</address>'+
				'<button class="btn btn-danger quitarCliente" idCliente="'+idCliente+'"><i class="fa fa-times"></i></button>'+
			'</div>'
			
			)
			
			}

	})
	
});
    

var idQuitarCliente = [];

localStorage.removeItem("quitarCliente");

$(".cabeceraVenta").on("click", "button.quitarCliente", function(){

	//console.log("boton");
	$(this).parent().parent().remove();
	
	var idCliente = $(this).attr("idCliente");
	
	/*=============================================
	ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR
	=============================================*/

	if(localStorage.getItem("quitarCliente") == null){

		idQuitarCliente = [];
	
	}else{

		idQuitarCliente.concat(localStorage.getItem("quitarCliente"))

	}
	idQuitarCliente.push({"idCliente":idCliente});

	localStorage.setItem("quitarCliente", JSON.stringify(idQuitarCliente));
	
	$("button.recuperarBoton[idCliente='"+idCliente+"']").removeClass('btn-default');

	$("button.recuperarBoton[idCliente='"+idCliente+"']").addClass('btn-primary agregarCliente');
	
	$("button.agregarCliente").addClass('btn-primary agregarCliente');
	
	$("button.agregarCliente").removeClass('disabled');
	location.reload();



})


$(".seleccionarTipoventa").change(function(){

	var tipo = $(this).val();

	//$(".seleccionarTipo").html("");
	
	
	if(tipo == 0){
		console.log("respuesta", tipo);
		//$(".plazoVenta").addClass('disabled'); 
		  $('.plazoVenta').prop('disabled', 'disabled');
		
	}else{
		$('.plazoVenta').attr('disabled', false);
	}
	
})
