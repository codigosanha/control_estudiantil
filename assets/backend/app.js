$(document).ready(function(){
	$('.sidebar-menu').tree();

	$(document).on("click", ".btn-establecer-numero", function(){
		infoEstudianteModulo = $(this).val();
		dataEstudianteModulo = infoEstudianteModulo.split("*");
		nombres = $("#nombres").text();
		apellidos = $("#apellidos").text();
		modulo = $(this).closest("tr").children("td:eq(0)").text();
		$(".modulo").text(modulo);
		$(".estudiante").text(nombres+" "+apellidos);
		$("input[name=estudiante_id]").val(dataEstudianteModulo[0]);
		$("input[name=modulo_id]").val(dataEstudianteModulo[1]);
	});
	$("#form-numero-registro").submit(function(e){
		e.preventDefault();
		dataForm = $(this).serialize();
		url = $(this).attr("action");
		$.ajax({
			url: url,
			type: 'POST',
			data: dataForm,
			success: function(resp){
				$("#modal-numero-registro").modal("hide");
				if (resp != 0) {
					cargarModulos(resp);
				}else{
					swal("Error", "No se pudo establecer el numero de registro", "error");
				}
			}
		});
	});

	$("#form-cambio-estado").submit(function(e){
		e.preventDefault();
		dataForm = $(this).serialize();
		url = $(this).attr("action");
		$.ajax({
			url: url,
			type: 'POST',
			data: dataForm,
			success: function(resp){
				$("#myModal").modal("hide");
				if (resp != 0) {
					cargarModulos(resp);
				}else{
					swal("Error", "No se pudo cambiar el estado del certificado", "error");
				}
			}
		});
	});

	function cargarModulos(estudiante_id){

		$.ajax({
			url: base_url + "estudiantes/cargarModulos",
			type: "POST",
			data: {estudiante_id: estudiante_id},
			dataType: "json",
			success: function(data){
				html = '';
		        $.each(data, function(key, value){
		        	dataEstudianteModulo = value.estudiante_id +"*"+ value.modulo_id;
	            	html += '<tr id="mod'+value.modulo_id+'">';
	            	html += '<td><input type="hidden" value="'+dataEstudianteModulo+'">'+value.nombre+'</td>';
	            	if (!value.practica_realizada) {
	            		practica = '<input type="checkbox" class="minimal confirmar_practica" value="'+dataEstudianteModulo+'">';
	            	}else{
	            		practica = 'SI'
	            	}
	            	html += '<td>'+practica+'</td>';
	        
	            	if (!value.fecha_emision) {
		        		fecha_emision = '';
		        	}else{
		        		fecha_emision = value.fecha_emision;
		        	}
	            	html += '<td>'+fecha_emision+'</td>';
	            	if (!value.fecha_entrega) {
		        		fecha_entrega = '';
		        	}else{
		        		fecha_entrega = value.fecha_entrega;
		        	}
	            	html += '<td>'+fecha_entrega+'</td>';
	            	if (!value.numero_registro) {
	            		numero_registro = '';
		        	}else{
		        		numero_registro = value.numero_registro;
		        	}
	            	html += '<td>'+numero_registro+'</td>';
	            	if (!value.estado_certificado) {
	            		html += '<td>';
		            	html += '<button type="button" class="btn btn-warning btn-edit-certificado" value="'+value.id+'" data-toggle="modal" data-target="#modal-certificado">';
		            	html += '<span class="fa fa-pencil"></span>'
		            	html += '</button></td>';
		        	}else{
		        		html += '<td></td>';
		        	}
	            	
	            	html += '</tr>';
		        });

		        $("#tbmodulos tbody").html(html);
			}	
		});
		
	}

	$(document).on("click",".btn-change",function(){
		estadoActual = $(this).attr("data-href");
		nombres = $("#nombres").text();
		apellidos = $("#apellidos").text();
		modulo = $(this).closest("tr").children("td:eq(0)").text();
		infoEstudianteModulo = $(this).closest("tr").children("td:eq(0)").find("input").val();
		dataEstudianteModulo = infoEstudianteModulo.split("*");
		$(".modulo").text(modulo);
		$(".estudiante").text(nombres+" "+apellidos);
		$("input[name=estudiante_id]").val(dataEstudianteModulo[0]);
		$("input[name=modulo_id]").val(dataEstudianteModulo[1]);
		if (estadoActual=="0") {
			$(".estadoActual").text("Pendiente");
			$(".nuevoEstado").text("Emitido");
			$("#nuevoEstado").val(Number(estadoActual) + 1);
		} else {
			$(".estadoActual").text("Emitido");
			$(".nuevoEstado").text("Entregado");
			$("#nuevoEstado").val(Number(estadoActual) + 1);
		} 
	});

	$(document).on("change", ".confirmar_practica", function(){
		infoEstudianteModulo = $(this).val();
		dataEstudianteModulo = infoEstudianteModulo.split("*");
		$("#estudiante_id").val(dataEstudianteModulo[0]);
		$("#modulo_id").val(dataEstudianteModulo[1]);
		nombres = $("#nombres").text();
		apellidos = $("#apellidos").text();
		modulo = $(this).closest("tr").children("td:eq(0)").text();
		$(".modulo").text(modulo);
		$(".estudiante").text(nombres+" "+apellidos);
		$("#modal-confirmar-practica").modal("show");
	});

	$(document).on("click",".btn-cancelar-practica", function(){
		modulo = $("#modulo_id").val();
		$("#mod"+modulo).children("td:eq(1)").find("input").prop("checked", false);
	});

	$("#form-confirmar-practica").submit(function(e){
		e.preventDefault();
		data = $(this).serialize();
		url = $(this).attr("action");
		$.ajax({
			url: url,
			type:"POST",
			data: data,
			success: function(resp){
				$("#modal-confirmar-practica").modal("hide");
				if (resp==1) {
					
					swal("Bien", "Se actualizo correctamente la informacion de la practica pre profesional","success");
					modulo = $("#modulo_id").val();
					$("tr#mod"+modulo).children("td:eq(1)").find("input").remove();
					$("tr#mod"+modulo).children("td:eq(1)").text("SI");
				} else {
					swal("Error", "No se pudo actualizar la informacion de la practica","error");
					modulo = $("#modulo_id").val();
					$("tr#mod"+modulo).children("td:eq(1)").find("input").removeAttr("checked");
				}
				
			}
		});

	});

	$("#search-estudiante").autocomplete({
        source:function(request, response){
            $.ajax({
                url: base_url+"estudiantes/getInfoEstudiante",
                type: "POST",
                dataType:"json",
                data:{ valor: request.term},
                success:function(data){
                    response(data);
                }
            });
        },
        minLength:2,
        select:function(event, ui){
        	console.log(ui.item);
            //data = ui.item.id + "*"+ ui.item.codigo+ "*"+ ui.item.label+ "*"+ ui.item.precio+ "*"+ ui.item.stock;
            $("#infoEstudiante").show();
            $("#estudiante").val(ui.item.id);
            $("#nombres").text(ui.item.nombres);
            $("#apellidos").text(ui.item.apellidos);
            $("#dni").text(ui.item.dni);
            $("#semestre").text(ui.item.semestre);
            $("#especialidad").text(ui.item.especialidad);
            html = '';
            $.each(ui.item.modulos, function(key, value){
            	dataEstudianteModulo = value.estudiante_id +"*"+ value.modulo_id;
            	html += '<tr id="mod'+value.modulo_id+'">';
            	html += '<td><input type="hidden" value="'+dataEstudianteModulo+'">'+value.nombre+'</td>';
            	if (!value.practica_realizada) {
            		practica = '<input type="checkbox" class="minimal confirmar_practica" value="'+dataEstudianteModulo+'">';
            	}else{
            		practica = 'SI'
            	}
            	html += '<td>'+practica+'</td>';
        
            	if (!value.fecha_emision) {
	        		fecha_emision = '';
	        	}else{
	        		fecha_emision = value.fecha_emision;
	        	}
            	html += '<td>'+fecha_emision+'</td>';
            	if (!value.fecha_entrega) {
	        		fecha_entrega = '';
	        	}else{
	        		fecha_entrega = value.fecha_entrega;
	        	}
            	html += '<td>'+fecha_entrega+'</td>';
            	if (!value.numero_registro) {
            		numero_registro = '';
	        	}else{
	        		numero_registro = value.numero_registro;
	        	}
            	html += '<td>'+numero_registro+'</td>';
            	if (!value.estado_certificado) {
            		html += '<td>';
	            	html += '<button type="button" class="btn btn-warning btn-edit-certificado" value="'+value.id+'" data-toggle="modal" data-target="#modal-certificado">';
	            	html += '<span class="fa fa-pencil"></span>'
	            	html += '</button></td>';
	        	}else{
	        		html += '<td></td>';
	        	}
            	html += '</tr>';
            });

            $("#tbmodulos tbody").html(html);
        },
    });

    $(document).on("click", ".btn-edit-certificado", function(){
    	idModEst = $(this).val();
    	nombres = $("#nombres").text();
		apellidos = $("#apellidos").text();
		modulo = $(this).closest("tr").children("td:eq(0)").text();
		$(".modulo").text(modulo);
		$(".estudiante").text(nombres+" "+apellidos);
		$("#idModEst").val(idModEst);
    });

    $("#form-update-certificado").submit(function(e){
    	e.preventDefault();
    	dataForm = $(this).serialize();
    	url= $(this).attr("action");
    	$.ajax({
    		url: url,
    		type: "POST",
    		data: dataForm,
    		success: function(resp){
    			if (resp==1) {
    				$("#modal-certificado").modal("hide");
    				swal("Bien Hecho!","Se actualizo la informacion del certificado","success");
    				cargarModulos($("#estudiante").val());
    			}else{
    				swal("Error","No se pudo actualizar la informacion del certificado","error");

    			}
    		}
    	});
    });



	$("#nombres, #apellidos, #autor, #editorial, #titulo").keydown(function(event){
    	var key = event.which;
	    if((key < 65 || key > 90) && key !==8 && key !== 32){
	       	return false;
	    }
    });

	
	$('#dni, #telefono').keypress(function (tecla) {
	  if (tecla.charCode < 48 || tecla.charCode > 57) return false;
	});

	$("#logout").on("click", function(e){
		e.preventDefault();
		swal({
		    title: "¿Desear cerrar sesión?",
		    text: "Si estas seguro de hacerlo haga click en el boton Aceptar, caso contrario haga click en cancelar",
		    type: "warning",
	        showCancelButton: true,
	        cancelButtonClass: "btn-danger",
	        confirmButtonClass: "btn-success",
	        confirmButtonText: "Aceptar",
	        closeOnConfirm: true,
		},
		function(isConfirm){
		   	if (isConfirm){
		   		window.location.href= base_url + "auth/logout";
		    } 
		});
	});

	$(document).on("click",".btn-activar-especialidad",function(){
		idEstudiante = $(this).val();

		swal({
		    title: "¿Ventana de Confirmación?",
		    text: "Si estas seguro de Activar el Programa de Estudio haga click en el boton Aceptar, caso contrario haga click en cancelar",
		    type: "warning",
	        showCancelButton: true,
	        cancelButtonClass: "btn-danger",
	        confirmButtonClass: "btn-success",
	        confirmButtonText: "Aceptar",
	        closeOnConfirm: true,
		},
		function(isConfirm){
		   	if (isConfirm){
		   		$.ajax({
		   			url: base_url + "programa_estudios/activar",
		   			type: "POST",
		   			data:{id:idEstudiante},
		   			success: function(resp){
		   				if (resp==1) {
		   					location.reload(true);
		   				}else{
		   					swal("error","No se pudo Activar el Programa de Estudio","error");
		   				}
		   			}
		   		});
		   		
		    } 
		});
	});

	$(document).on("click",".btn-inactivar-especialidad",function(){
		idEstudiante = $(this).val();

		swal({
		    title: "¿Ventana de Confirmación?",
		    text: "Si estas seguro de Inactivar el Programa de Estudio haga click en el boton Aceptar, caso contrario haga click en cancelar",
		    type: "warning",
	        showCancelButton: true,
	        cancelButtonClass: "btn-danger",
	        confirmButtonClass: "btn-success",
	        confirmButtonText: "Aceptar",
	        closeOnConfirm: true,
		},
		function(isConfirm){
		   	if (isConfirm){
		   		$.ajax({
		   			url: base_url + "programa_estudios/inactivar",
		   			type: "POST",
		   			data:{id:idEstudiante},
		   			success: function(resp){
		   				if (resp==1) {
		   					location.reload(true);
		   				}else{
		   					swal("error","No se pudo Inhabilitar el Programa de Estudio","error");
		   				}
		   			}
		   		});
		   		
		    } 
		});
	});

	$(document).on("click",".btn-activar-modulo",function(){
		idEstudiante = $(this).val();

		swal({
		    title: "¿Ventana de Confirmación?",
		    text: "Si estas seguro de Activar el Módulo haga click en el boton Aceptar, caso contrario haga click en cancelar",
		    type: "warning",
	        showCancelButton: true,
	        cancelButtonClass: "btn-danger",
	        confirmButtonClass: "btn-success",
	        confirmButtonText: "Aceptar",
	        closeOnConfirm: true,
		},
		function(isConfirm){
		   	if (isConfirm){
		   		$.ajax({
		   			url: base_url + "modulos/activar",
		   			type: "POST",
		   			data:{id:idEstudiante},
		   			success: function(resp){
		   				if (resp==1) {
		   					location.reload(true);
		   				}else{
		   					swal("error","No se pudo Activar el Módulo","error");
		   				}
		   			}
		   		});
		   		
		    } 
		});
	});

	$(document).on("click",".btn-inactivar-modulo",function(){
		idEstudiante = $(this).val();

		swal({
		    title: "¿Ventana de Confirmación?",
		    text: "Si estas seguro de Inactivar el Módulo haga click en el boton Aceptar, caso contrario haga click en cancelar",
		    type: "warning",
	        showCancelButton: true,
	        cancelButtonClass: "btn-danger",
	        confirmButtonClass: "btn-success",
	        confirmButtonText: "Aceptar",
	        closeOnConfirm: true,
		},
		function(isConfirm){
		   	if (isConfirm){
		   		$.ajax({
		   			url: base_url + "modulos/inactivar",
		   			type: "POST",
		   			data:{id:idEstudiante},
		   			success: function(resp){
		   				if (resp==1) {
		   					location.reload(true);
		   				}else{
		   					swal("error","No se pudo Inactivar el Módulo","error");
		   				}
		   			}
		   		});
		   		
		    } 
		});
	});


	$(document).on("click",".btn-eliminar-estudiante",function(){
		idEstudiante = $(this).val();

		swal({
		    title: "¿Ventana de Confirmación?",
		    text: "Si estas seguro de eliminar al estudiante haga click en el boton Aceptar, caso contrario haga click en cancelar",
		    type: "warning",
	        showCancelButton: true,
	        cancelButtonClass: "btn-danger",
	        confirmButtonClass: "btn-success",
	        confirmButtonText: "Aceptar",
	        closeOnConfirm: true,
		},
		function(isConfirm){
		   	if (isConfirm){
		   		$.ajax({
		   			url: base_url + "estudiantes/delete",
		   			type: "POST",
		   			data:{id:idEstudiante},
		   			success: function(resp){
		   				if (resp==1) {
		   					location.reload(true);
		   				}else{
		   					swal("error","No se pudo eliminar al Estudiante","error");
		   				}
		   			}
		   		});
		   		
		    } 
		});
	});
  
	$(document).on("click",".btn-eliminar-usuario",function(){
		idusuario = $(this).val();
		fila = $(this).closest("tr"); 
		swal({
		    title: "¿Ventana de Confirmación?",
		    text: "Si estas seguro de eliminar al usuario haga click en el boton Aceptar, caso contrario haga click en cancelar",
		    type: "warning",
	        showCancelButton: true,
	        cancelButtonClass: "btn-danger",
	        confirmButtonClass: "btn-success",
	        confirmButtonText: "Aceptar",
	        closeOnConfirm: true,
		},
		function(isConfirm){
		   	if (isConfirm){
		   		$.ajax({
		   			url: base_url + "usuarios/delete",
		   			type: "POST",
		   			data:{id:idusuario},
		   			success: function(resp){
		   				if (resp=="1") {
		   					location.reload(true);
		   				}
		   			}
		   		});
		   		
		    } 
		});
	});
	$("#tb-without-buttons").DataTable({
		language: {
	            "lengthMenu": "Mostrar _MENU_ registros por pagina",
	            "zeroRecords": "No se encontraron resultados en su busqueda",
	            "searchPlaceholder": "Buscar registros",
	            "info": "Mostrando registros de _START_ al _END_ de un total de  _TOTAL_ registros",
	            "infoEmpty": "No existen registros",
	            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
	            "search": "Buscar:",
	            "paginate": {
	                "first": "Primero",
	                "last": "Último",
	                "next": "Siguiente",
	                "previous": "Anterior"
	            },
	        },
	}); 
});