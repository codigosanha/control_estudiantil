$(document).ready(function(){
	$('.sidebar-menu').tree();

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
            $("#nombres").text(ui.item.nombres);
            $("#apellidos").text(ui.item.apellidos);
            $("#dni").text(ui.item.dni);
            $("#semestre").text(ui.item.semestre);
            $("#especialidad").text(ui.item.especialidad);
            html = '';
            $.each(ui.item.modulos, function(key, value){
            	dataEstudianteModulo = value.estudiante_id +"*"+ value.modulo_id;
            	html += '<tr>';
            	html += '<td>'+value.nombre+'</td>';
            	if (!value.practica_realizada) {
            		practica = '<input type="checkbox" class="minimal confirmar_practica" value="'+dataEstudianteModulo+'">';
            	}else{
            		practica = 'SI'
            	}
            	html += '<td>'+practica+'</td>';
            	estado_certificado = '';
            	if (!value.estado_certificado) {
            		estado_certificado = '<span class="label label-danger">Pendiente</span><br>';
            		estado_certificado += '<a href="#myModal" data-toggle="modal" class="btn-change" data-href="0">Cambiar a Emitido</a>';
            	}else if(value.estado_certificado == 1){
            		estado_certificado = '<span class="label label-warning">Emitido</span>';
            		estado_certificado += '<a href="#myModal" data-toggle="modal" class="btn-change" data-href="'+value.estado_certificado+'">Cambiar a Entregado</a>';
            	}else {
            		estado_certificado = '<span class="label label-success">Entregado</span>';
            	}
            	html += '<td>'+estado_certificado+'</td>';
            	html += '<td></td>';
            	html += '<td></td>';
            	html += '<td></td>';
            	html += '</tr>';
            });

            $("#tbmodulos tbody").html(html);
        },
    });

	$(document).on("change", "#fecprestamo", function(){
		fecha = $(this).val();
		
		var date = new Date(fecha);
		var fecha = sumarDias(date, 5);

	   	d = fecha.getDate() + 1;
        m = fecha.getMonth()+1; 
        y = fecha.getFullYear();
        var data ="";

	    if(d < 10){
	        d = "0"+d;
	    };
	    if(m < 10){
	        m = "0"+m;
	    };

	    data = y+"-"+m+"-"+d;
	    $("#fecdevolucion").val(data);
	});

	function sumarDias(fecha, dias){
	  fecha.setDate(fecha.getDate() + dias);
	  return fecha;
	}

	$("#ejemplares").keyup(function(event){
    	valor = $(this).val();
    	if (valor !='') {
    		if (valor == 0) {
	    		swal("Error","El valor de ejemplares no puede ser 0","error");
	    		$(this).val("1");
	    	}
    	}
    	
    });

	$("#nombres, #apellidos, #autor, #editorial, #titulo").keydown(function(event){
    	var key = event.which;
	    if((key < 65 || key > 90) && key !==8 && key !== 32){
	       	return false;
	    }
    });

    $("#ediccion").keydown(function(event){
    	var key = event.which;
	    if((key < 65 || key > 105) && key !==8 && key !== 32){
	       	return false;
	    }
    });

    $("#distrito_provincia").keydown(function(event){
    	var key = event.which;
	    if((key < 65 || key > 90) && key !==8 && key !== 32 && key!==189){
	       	return false;
	    }
    });

	$("#checkChangePassword").on("change", function(){
		$("#password").val(null);
		if($(this).prop('checked')) {
		    $(this).val("1");
		    
		    $("#password").removeAttr("disabled");
		    $("#password").attr("required","required");

		}else{
			$(this).val("0");
			$("#password").attr("disabled","disabled");
			$("#password").removeAttr("required");
		}
	});
	
	$('#dni, #telefono').keypress(function (tecla) {
	  if (tecla.charCode < 48 || tecla.charCode > 57) return false;
	});

	$(document).on("click",".btn-renovar", function(){
		var infoPrestamo = $(this).val();
		swal({
		    title: "¿Estas seguro que deseas renovar el préstamo para 5 días más?",
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
		   		$.ajax({
					url: base_url + "prestamos/renovar",
					type:"POST",
					data: {prestamo:infoPrestamo},
					success: function(resp){
						if (resp !="0") {
							location.reload(true);
						}
						else{
							alert("No se pudo renovar el prestamo");
						}
					}
				});
		    } 
		});
		
	});

	$(document).on("click",".btn-eliminar", function(e){
		e.preventDefault();
		url = $(this).attr("href");
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
		   		$.ajax({
					url: url,
					type:"POST",
					success: function(resp){
						location.reload(true);
					}
				});
		    } 
		});
		
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
	$("#datepicker").datepicker({
	    format: "yyyy",
	    viewMode: "years", 
	    minViewMode: "years",
	    startDate : '1900'
	});
	$("#datepicker1").datepicker({
	    format: "mm-yyyy",
	    viewMode: "months", 
	    minViewMode: "months",
	    language: 'es'
	});

	$("#tipo_documento_id").on("change", function(){
		item = $("#tipo_documento_id option:selected").text().toLowerCase();
		num_documento = $("#num_documento").val();
	
		if (item=='dni') {
			$("#num_documento").val(num_documento.substr(0,8));
		}
	});
	
	$('input#num_documento').keypress(function (event) {
		item = $("#tipo_documento_id option:selected").text().toLowerCase();
		if (item=="dni") {
			cantidad = 8;
		} else{
			cantidad = 10;
		}
      	if (event.which < 48 || event.which > 57 || this.value.length === Number(cantidad)) {
        	return false;
      	}
    });
	
	$(document).on("click","#btn-comprobardni", function(){
		num_documento = $("#num_documento").val();
		if(num_documento==""){
			alertify.error("No ha ingresado ningun numero de documento");
		}
		else{

			$.ajax({
			  	type: "POST",
			  	url: base_url+"lectores/comprobardocumento",
			  	data: { num_documento: num_documento }
			}).done(function(msg) {
			    if (msg === "nf") {
			    	$("#nombres").val("");
			    	$("input[name=idLector]").val(null);
			    	alertify.error("El Lector no existe...haga clic boton Registrar para registrarlo");
			    }
			    else if (msg === "na") {
			    	$("#nombres").val("");
			    	$("input[name=idLector]").val(null);
			    	alertify.error("El Lector esta registrado...pero no esta disponible");
			    }
			    else{
			    	var result = JSON.parse(msg);
			    	$("input[name=idLector]").val(result.id);
			    	$("#nombres").val(result.nombres + " " +result.apellidos);
			    }
			});
		}

	});
	$(document).on("click", ".btn-select",function(){
    	codigo = $(this).closest("tr").find("td:eq(1)").text();
    	idLibro = $(this).val();
    	$("input[name=idLibro]").val(idLibro);
    	$("#codigo").val(codigo);
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