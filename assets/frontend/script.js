$(document).ready(function(){
	$('input[name=dni]').keypress(function (tecla) {
	  	if (tecla.charCode < 48 || tecla.charCode > 57) return false;
	});
	$(document).on("click", ".btn-view-informe", function(){
		var idEstMod = $(this).val();
		$.ajax({
			url: base_url+ "welcome/informe_practica",
			type: "POST",
			data: {idEstMod:idEstMod},
			success: function(resp){
				$("#modal-informe .modal-body").html(resp);
			}
		});
	});
	$("#form-search-estudiante").submit(function(e){
		e.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            url: base_url+"welcome/getInfoEstudiante",
            type: "POST",
            dataType:"json",
            data:formData,
            success:function(data){
            	if (data != "0") {
            		$("#infoEstudiante").show();
		            $("#estudiante").val(data.estudiante.id);
		            $("#nombres").text(data.estudiante.nombres);
		            $("#apellidos").text(data.estudiante.apellidos);
		            $("#dni").text(data.estudiante.dni);
		            $("#semestre").text(data.estudiante.semestre);
		            $("#programa_estudio").text(data.estudiante.programa_estudio);
		            html = '';
		            $.each(data.modulos, function(key, value){
		            	dataEstudianteModulo = value.estudiante_id +"*"+ value.modulo_id;
		            	html += '<tr id="mod'+value.modulo_id+'">';
		            	html += '<td><input type="hidden" value="'+dataEstudianteModulo+'">'+value.nombre+'</td>';
		            	if (!value.practica_realizada) {
		            		practica = 'No';
		            	}else{
		            		practica = 'SI'
		            		practica += ' <div class="btn-group" style="float:right;"><button type="button" class="btn btn-primary btn-xs btn-flat btn-view-informe" value="'+value.id+'" data-toggle="modal" data-target="#modal-informe"><span class="fa fa-eye"></span></button>'
        					practica += ' <a href="'+base_url+'welcome/reporte_practica/'+value.id+'" class="btn btn-danger btn-xs btn-flat" target="_blank"><span class="fa fa-file-pdf-o"></span></a></div>';
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
		            	html += '</tr>';
		            });

		            $("#tbmodulos tbody").html(html);
            	}else{
            		$("#infoEstudiante").hide();
            		swal("Error","El DNI ingresado no esta registrado en el sistema","error");
            	}
                
            }
        });
    });
});