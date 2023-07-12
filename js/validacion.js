function Validar() 
{
    var primer_apellido = document.forms["myForm"]["primer_apellido"].value;
	var segundo_apellido = document.forms["myForm"]["segundo_apellido"].value;
	var primer_nombre = document.forms["myForm"]["primer_nombre"].value;
	var segundo_nombre = document.forms["myForm"]["segundo_nombre"].value;
    var RE = new RegExp("^[a-zA-Z\\s]+$");

    if(!RE.test(primer_apellido))
	{
		alert("Primer Apellido: No cumple con las especificaciones del campo");
		return false;
	} 

    if(!RE.test(segundo_apellido))
	{
		alert("Segundo Apellido: No cumple con las especificaciones del campo");
		return false;
	} 

    if(!RE.test(primer_nombre))
	{
		alert("Primer Nombre: No cumple con las especificaciones del campo");
		return false;
	} 

    if(!RE.test(segundo_nombre))
	{
		alert("Segundo Nombre: No cumple con las especificaciones del campo");
		return false;
	} 
}

function Eliminar(cod) 
{
	var empleado = confirm("esta seguro que desea retirar al empleado");
	if(empleado) 
	{
		var dir = "../process/del_empleado.php?id=" + cod;
		window.location.href = dir;
	}else{
		return false;
	} 
	
}

function add(modulo)
{
	switch(modulo)
	{
		case '1':
			var dir = "../process/edit_empleado.php";
			window.location.href = dir;
			break;
		default:
			alert("Modulo no definido")
		
	}
}

function getConfirmation() 
{
	  var retVal = confirm("Do you want to continue ?");
	  if( retVal == true ) {
		 document.write ("User wants to continue!");
		 return true;
	  } else {
		 document.write ("User does not want to continue!");
		 return false;
	  }
}

function conversion(dato){
	if (dato==false){
		dato = 0;
	}else{
		dato = 1;
	}
	return dato;
}




function actualizarEmpleado()
{
	var id_empleado = document.getElementById("id_empleado").value;
	var nombre = document.getElementById("nombre").value;
	var apellido = document.getElementById("apellido").value;
	var fecha_ingreso = document.getElementById("fecha_ingreso").value;
	var fecha_nacimiento = document.getElementById("fecha_nacimiento").value;
	var id_pais_nacimiento = document.getElementById("id_pais_nacimiento").value;
	var id_departamento_nacimiento = document.getElementById("id_departamento_nacimiento").value;
	var id_lugar_nacimiento = document.getElementById("id_lugar_nacimiento").value;
	var id_tipo_contrato = document.getElementById("id_tipo_contrato").value;
	var cedula = document.getElementById("cedula").value;
	var fecha_expedicion = document.getElementById("fecha_expedicion").value;
	var id_pais_Expedicion = document.getElementById("id_pais_Expedicion").value;
	var id_departamento = document.getElementById("id_departamento").value; //id_departamento_Expedicion
	var id_lugar_Expedicion = document.getElementById("id_lugar_Expedicion").value;
	var estado = document.getElementById("estado").checked;
	var socio = document.getElementById("socio").checked;
	estado = conversion(estado);
	socio = conversion(socio);
	var id_area = document.getElementById("id_area").value;
	var id_oficio = document.getElementById("id_oficio").value;
	var id_estado_civil = document.getElementById("id_estado_civil").value;
	var id_genero = document.getElementById("id_estado_civil").value;
	var direccion = document.getElementById("direccion").value;
	var id_pais_direccion = document.getElementById("id_pais_direccion").value;
	var id_departamento_direccion = document.getElementById("id_departamento_direccion").value;
	var id_lugar_direccion = document.getElementById("id_lugar_direccion").value;
	var tipo_vivienda = document.getElementById("tipo_vivienda").value;
	var estrato_social = document.getElementById("estrato_social").value;
	var tel_fijo = document.getElementById("tel_fijo").value;
	var tel_celular = document.getElementById("tel_celular").value;
	var email = document.getElementById("email").value;
	var num_casillero = document.getElementById("num_casillero").value;
	var id_eps = document.getElementById("id_eps").value;
	var id_afp = document.getElementById("id_afp").value;
	var id_arl = document.getElementById("id_arl").value;
	var id_tipo_sangre = document.getElementById("id_tipo_sangre").value;
	var id_talla_camisa = document.getElementById("id_talla_camisa").value;
	var id_tipo_calzado = document.getElementById("id_tipo_calzado").value;
	var talla_calzado = document.getElementById("talla_calzado").value;

	var parametros = "servicio=3&nombre="+nombre+"&apellido="+apellido+"&fecha_ingreso="+fecha_ingreso+"&fecha_nacimiento="+fecha_nacimiento+"&id_pais_nacimiento="+id_pais_nacimiento+"&id_departamento="+id_departamento_nacimiento+"&id_lugar_nacimiento="+id_lugar_nacimiento+"&id_tipo_contrato="+id_tipo_contrato+"&cedula="+cedula+"&fecha_expedicion="+fecha_expedicion+"&id_pais_Expedicion="+id_pais_Expedicion+"&id_departamento_Expedicion="+id_departamento+"&$id_pais_expedicion="+id_lugar_Expedicion+"&estado="+estado+"&socio="+socio+"&id_area="+id_area+"&id_oficio="+id_oficio+"&id_estado_civil="+id_estado_civil+"&id_genero="+id_genero+"&direccion="+direccion+"&id_pais_direccion="+id_pais_direccion+"&id_departamento_direccion="+id_departamento_direccion+"&id_lugar_direccion="+id_lugar_direccion+"&tipo_vivienda="+tipo_vivienda+"&estrato_social="+estrato_social+"&tel_fijo="+tel_fijo+"&tel_celular="+tel_celular+"&email="+email+"&num_casillero="+num_casillero+"&id_eps="+id_eps+"&id_afp="+id_afp+"&id_arl="+id_arl+"&id_tipo_sangre="+id_tipo_sangre+"&id_talla_camisa="+id_talla_camisa+"&id_tipo_calzado="+id_tipo_calzado+"&talla_calzado="+talla_calzado+"&id_empleado="+id_empleado;

	alert("-----"+id_pais_Expedicion);
	var url = '../process/signin.php';
    const ajax_request = new XMLHttpRequest();
    ajax_request.open( "POST", url, true );
    ajax_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax_request.send( parametros );
    ajax_request.responseType = 'text';

    ajax_request.onload =() =>{
		if(ajax_request.readyState === ajax_request.DONE){
		  if(ajax_request.status == 200){
			var res = ajax_request.responseText;
			var resarray = res.split(':');
			var status = resarray[1].split(',');
			//alert (status[0]);
			if(status[0]=='"true"'){
			  //document.location.href="../servicios/admin/main.php?id=13";
			  alert('Msg: Comunicación OK');
			}else{
			  //document.getElementById("user_valid").innerHTML = "Error: Usuario y contraseña";
			  alert('Error: Comunicación');
			}
		  }
		}
	  };

}

function cambiarEstado(id, pos){
	var accion = '';
	
	//const estado = document.getElementById("estado"+pos).value;
	//alert(document.getElementById("estado"+pos).checked);
	if(document.getElementById("estado"+pos).checked==true)
	{
		accion = '1';
	}else{
		accion = '0';
	}
	var parametros = "servicio=2&idUser="+id+"&estado="+accion;
	var url = '../process/signin.php';
	const ajax_request = new XMLHttpRequest();
	//alert(url);
    ajax_request.open( "POST", url, true );
    ajax_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajax_request.send( parametros );
    ajax_request.responseType = 'text';

	ajax_request.onload =() =>{
		if(ajax_request.readyState === ajax_request.DONE){
		  if(ajax_request.status == 200){
			var res = ajax_request.responseText;

			var resarray = res.split(':');
			var status = resarray[1].split(',');
			//alert(status[0]);
			if(status[0]=="true"){
				alert('Usuario actualizado con exito');
			}else{
			  alert('Error: Volver a intentarlo');
			}
		  }
		}
	  };

    
}




 
