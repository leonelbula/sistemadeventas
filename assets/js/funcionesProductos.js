//$(".formularioVenta").on("change", "input.costo", function(){
//	var costo =  document.getElementById("costo").value;
//	
//	console.log("costo",costo)
//})



function recibir() 
    { 
        var costo = document.getElementById("costo").value;
	    var utilidad1 = document.getElementById("Utilidad1").value;		
		var iva2 = document.getElementById("impuesto");
		var combo = document.getElementById("impuesto");
		var iva = combo.options[combo.selectedIndex].value;
		

		
		var precioventa1 = 0;
	
		
		var precioventa1iva = 0;
	
		
		var precioventa1ivaIncl = 0;
		
		
		var precio1 = 0;
		
		
		//total = (parseInt(costo) + parseInt(utilidad));
		precioventa1 = Number(costo * utilidad1/100);
		
		
		precio1 = (parseInt(precioventa1) + parseInt(costo));
	
				
		//console.log("costo", costo);		
		
		 document.getElementById('Precio1').value = precio1;
		
		 
		 if(Number(iva)==0){
			  document.getElementById('Precio1_Iva').value = precio1;
			 
		 }else{
			 precioventa1iva = Number(precio1 * iva/100);
			 
			 
			 precioventa1ivaIncl = (parseInt(precioventa1iva) + parseInt(precio1));
			 
			 
			  document.getElementById('Precio1_Iva').value = precioventa1ivaIncl;
			 
			 
		 }
		 
		
         
    }         

$(".nuevaImagen").change(function(){

	var imagen = this.files[0];
	
	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/

  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

  		$(".nuevaImagen").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else if(imagen["size"] > 2000000){

  		$(".nuevaImagen").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen no debe pesar más de 2MB!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else{

  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagen);

  		$(datosImagen).on("load", function(event){

  			var rutaImagen = event.target.result;

  			$(".previsualizar").attr("src", rutaImagen);

  		})

  	}
})

