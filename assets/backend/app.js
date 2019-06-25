$(document).ready(function(){
	$('.sidebar-menu').tree();
	$(document).on("click",".btn-change-password", function(){
		var idUsuario = $(this).val();
		$("#idUsuario").val(idUsuario);
	});

	$(document).on("click", ".btn-view-informe", function(){
		
		var infoEstMod = $(this).val();
		var dataEstMod = infoEstMod.split("*"); 
		$(".info-modulo").text(dataEstMod[10]);
		$(".info-practica").text(dataEstMod[2]);
		$(".info-titulo").text(dataEstMod[3]);
		$(".info-fecha-inicio").text(dataEstMod[4]);
		$(".info-fecha-termino").text(dataEstMod[5]);
		$(".info-horas").text(dataEstMod[6]);
		$(".info-nota").text(dataEstMod[12]);
		$(".info-resolucion").text(dataEstMod[7]);
		$(".info-asesor").text(dataEstMod[8]);
		if (dataEstMod[9]) {
			vinculo = "<a href='"+base_url+'principal/resoluciones/'+dataEstMod[11]+"'>"+dataEstMod[9]+"</a>"

			$(".info-documento").html(vinculo);

		}else{
			$(".info-documento").html("");
		}

	});
	$(document).on("click", ".btn-quitar-documento", function(){

		$("#info-documento").hide();
		$("#file").show();
		$("#estado").val("1");
		
	
	});

	$(document).on("click", ".btn-edit-practica", function(){
		var infoEstMod = $(this).val();
		var dataEstMod = infoEstMod.split("*");
		$("input[name=estudiante_modulo]").val(dataEstMod[11]);
		$("input[name=modulo]").val(dataEstMod[10]);
		$("input[name=practica_modular]").val(dataEstMod[2]);
		$("textarea[name=titulo_practica]").val(dataEstMod[3]);
		$("input[name=fecha_inicio]").val(dataEstMod[4]);
		$("input[name=fecha_termino]").val(dataEstMod[5]);
		$("input[name=total_horas]").val(dataEstMod[6]);
		$("input[name=numero_resolucion]").val(dataEstMod[7]);
		$("input[name=asesor]").val(dataEstMod[8]);
		if (dataEstMod[9]) {
			$("#info-documento").show();
			$(".btn-quitar-documento").val(dataEstMod[11]);
			$("#info-documento a").attr("href", base_url+'principal/resoluciones/'+dataEstMod[11]);
			$("#info-documento a").text(dataEstMod[9]);

			$("#file").hide();
		}else{
			$("#file").show();
			$("#info-documento").hide();
		}
	});

	$("#form-change-password").submit(function(e){
		e.preventDefault();
		var dataForm = $(this).serialize();
		var url = $(this).attr("action");
		var newpass = $("#newpass").val();
		var repeatpass = $("#repeatpass").val();
		if (newpass != repeatpass) {
			swal("Error", "Las contraseñas no coinciden...intentalo nuevamente","error");
		}else{
			$.ajax({
				url: url,
				type:"POST",
				data: dataForm,
				dataType: "json",
				success: function(resp){
					if (resp ==1) {
						$("#modal-default").modal('hide');
						swal("Bien!","La contraseña ha sido actualizada","success");
					}else{
						swal("error","No se pudo cambiar la contraseña","error");
					}
				}
			});
		}
		
	});

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
            		dataEstudianteModulo = value.estudiante_id +"*"+ value.modulo_id+"*"+ value.practica_modular+"*"+ value.titulo_practica+"*"+ value.fecha_inicio+"*"+ value.fecha_termino+"*"+ value.total_horas+"*"+ value.numero_resolucion +"*"+ value.asesor+"*"+ value.archivo_resolucion+"*"+value.nombre+"*"+value.id+"*"+value.nota_cualitativa;
	            	html += '<tr id="mod'+value.modulo_id+'">';
	            	html += '<td><input type="hidden" value="'+dataEstudianteModulo+'">'+value.nombre+'</td>';
	            	if (!value.practica_realizada) {
	            		practica = '<input type="checkbox" class="minimal confirmar_practica" value="'+dataEstudianteModulo+'">';
	            		if (rol == 4) {
	            			practica = '';
	            		}
	            	}else{
	            		practica = 'SI'
						practica += " <div class='btn-group' style='float:right;'><button type='button' class='btn btn-primary btn-xs btn-flat btn-view-informe' value='"+dataEstudianteModulo+"' data-toggle='modal' data-target='#modal-informe'><span class='fa fa-eye'></span></button>";            			
						if (rol != 4) {
            				practica += " <button type='button' class='btn btn-warning btn-xs btn-edit-practica' value='"+dataEstudianteModulo+"' data-toggle='modal' data-target='#modal-edit-practica'><span class='fa fa-pencil'></span></button>";
            			}
            			practica += ' <a href="'+base_url+'principal/reporte_practica/'+value.id+'" class="btn btn-danger btn-xs btn-flat" target="_blank"><span class="fa fa-file-pdf-o"></span></a></div>';
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
		$("#form-confirmar-practica")[0].reset();
		infoEstudianteModulo = $(this).val();
		dataEstudianteModulo = infoEstudianteModulo.split("*");
		$("#estudiante_id").val(dataEstudianteModulo[0]);
		$("#modulo_id").val(dataEstudianteModulo[1]);
		nombres = $("#nombres").text();
		apellidos = $("#apellidos").text();
		modulo = $(this).closest("tr").children("td:eq(0)").text();
		$(".modulo").text(modulo);
		$("#modulo").val(modulo);
		$(".estudiante").text(nombres+" "+apellidos);
		$("#modal-confirmar-practica").modal("show");
	});

	$(document).on("click",".btn-cancelar-practica", function(){
		modulo = $("#modulo_id").val();
		$("#mod"+modulo).children("td:eq(1)").find("input").prop("checked", false);
	});

	$("#form-confirmar-practica").submit(function(e){
		e.preventDefault();
		var formData = new FormData($(this)[0]);
	
		url = $(this).attr("action");
		$.ajax({
			url: url,
			type:"POST",
			data: formData,
			cache: false,
    		contentType: false,
    		processData: false,
			success: function(resp){
				$("#modal-confirmar-practica").modal("hide");
				if (resp!=0) {
					
					swal("Bien", "Se actualizo correctamente la informacion de la practica pre profesional","success");
					cargarModulos(resp);
					$("#form-confirmar-practica")[0].reset();
				} else {
					swal("Error", "No se pudo actualizar la informacion de la practica","error");
					modulo = $("#modulo_id").val();
					$("tr#mod"+modulo).children("td:eq(1)").find("input").removeAttr("checked");
				}
				
			}
		});

	});

	$("#form-edit-practica").submit(function(e){
		e.preventDefault();
		var formData = new FormData($(this)[0]);
	
		url = $(this).attr("action");
		$.ajax({
			url: url,
			type:"POST",
			data: formData,
			cache: false,
    		contentType: false,
    		processData: false,
			success: function(resp){
				$("#modal-edit-practica").modal("hide");
				if (resp!=0) {
					
					swal("Bien", "Se actualizo correctamente la informacion de la practica pre profesional","success");
					cargarModulos($("#estudiante").val());
					$("#form-edit-practica")[0].reset();
					$("#estado").val("0");

				} else {
					swal("Error", "No se pudo actualizar la informacion de la practica","error");
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
            $("#reporte_estudiante").attr("href", base_url + "principal/reporte/" + ui.item.id);
            $("#estudiante").val(ui.item.id);
            $("#nombres").text(ui.item.nombres);
            $("#apellidos").text(ui.item.apellidos);
            $("#dni").text(ui.item.dni);
            $("#semestre").text(ui.item.semestre);
            $("#especialidad").text(ui.item.especialidad);
            html = '';
            $.each(ui.item.modulos, function(key, value){
            	dataEstudianteModulo = value.estudiante_id +"*"+ value.modulo_id+"*"+ value.practica_modular+"*"+ value.titulo_practica+"*"+ value.fecha_inicio+"*"+ value.fecha_termino+"*"+ value.total_horas+"*"+ value.numero_resolucion +"*"+ value.asesor+"*"+ value.archivo_resolucion+"*"+value.nombre+"*"+value.id+"*"+value.nota_cualitativa;
            	html += '<tr id="mod'+value.modulo_id+'">';
            	html += '<td><input type="hidden" value="'+dataEstudianteModulo+'">'+value.nombre+'</td>';
            	if (!value.practica_realizada) {
            		practica = '<input type="checkbox" class="minimal confirmar_practica" value="'+dataEstudianteModulo+'">';
            		if (rol == 4) {
            			practica = '';
            		}
            	}else{
            		practica = 'SI';
            		practica += " <div class='btn-group' style='float:right;'><button type='button' class='btn btn-primary btn-xs btn-flat btn-view-informe' value='"+dataEstudianteModulo+"' data-toggle='modal' data-target='#modal-informe'><span class='fa fa-eye'></span></button>";
            		if (rol != 4) {
            			practica += " <button type='button' class='btn btn-warning btn-xs btn-edit-practica' value='"+dataEstudianteModulo+"' data-toggle='modal' data-target='#modal-edit-practica'><span class='fa fa-pencil'></span></button>";
            		}
            		practica += ' <a href="'+base_url+'principal/reporte_practica/'+value.id+'" class="btn btn-danger btn-xs btn-flat" target="_blank"><span class="fa fa-file-pdf-o"></span></a></div>';
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
            	if (rol == 4) {
        			html += '<td></td>';
        		}else{
        			if (!value.estado_certificado) {
	            		html += '<td>';
		            	html += '<button type="button" class="btn btn-warning btn-edit-certificado" value="'+value.id+'" data-toggle="modal" data-target="#modal-certificado">';
		            	html += '<span class="fa fa-pencil"></span>'
		            	html += '</button></td>';
		        	}else{
		        		html += '<td></td>';
		        	}
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



	$("#autor, #editorial, #titulo").keydown(function(event){
    	var key = event.which;
	    if((key < 65 || key > 90) && key !==8 && key !== 32){
	       	return false;
	    }
    });

    $("#nombres,#apellidos").keydown(function(event){
    	var key = event.which;
	    if((key < 65 || key > 90) && key !==8 && key !== 32 && key!==192 && key!==255){
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