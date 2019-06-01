<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Instituto</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/jquery-ui/jquery-ui.css">

	<style>
		html,body{
			margin: 0;
			background: #d2d6de;
			height: 100%;
			width: 100%;
		}
		.container{
			background: #FFF;
			height: 100%;
    		min-height: 100%;
		}
	</style>
</head>
<body>

<div class="container">
	<div class="info-estudiante">
		<h2 class="text-center">SISTEMA DE INFORMACION ESTUDIANTIL</h2>
		<hr>
		<div class="row">
			<div class="col-md-6 col-md-offset-3 col-xs-12">
				<h2 class="text-center">Buscar información del estudiante</h2>
				<div class="form-group">
					<input type="text" id="search-estudiante" name="search-estudiante" class="form-control" placeholder="Introduzca algo...">
				</div>
			</div>
		</div>
		<div class="row" >
			<div class="col-md-12 col-xs-12">
				<div style="display: none;" id="infoEstudiante">
					<br>
					<p class="text-center"><strong>INFORMACION DEL ESTUDIANTE</strong></p>
					<table class="table table-bordered" style="background: #d2d6de;">
						<tbody>
							<tr>
								<th>NOMBRES:</th>
								<td id="nombres"></td>
							</tr>
							<tr>
								<th>APELLIDOS:</th>
								<td id="apellidos"></td>
							</tr>
							<tr>
								<th>DNI:</th>
								<td id="dni"></td>
							</tr>
							<tr>
								<th>SEMESTRE:</th>
								<td id="semestre"></td>
							</tr>
							<tr>
								<th>PROGRAMA DE ESTUDIO:</th>
								<td id="programa_estudio"></td>
							</tr>
						</tbody>
					</table>

					
					<table class="table table-bordered" id="tbmodulos" style="background: #d2d6de;">
						<thead>
							<tr>
								<th colspan="2" class="text-center">INFORMACION DE MODULOS</th>
								<th colspan="4" class="text-center">INFORMACION DEL CERTIFICADO</th>
							</tr>
							<tr>
								<th>MODULO</th>
								<th>PRACTICA</th>
								<th>FECHA DE EMISION</th>
								<th>FECHA DE ENTREGA</th>
								<th>N° DE REGISTRO</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="<?php echo base_url(); ?>assets/jquery/jquery.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/jquery-ui/jquery-ui.js"></script>

<script>
	var base_url = "<?php echo base_url();?>";
</script>
<script>
	$(document).ready(function(){
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
	            $("#programa_estudio").text(ui.item.especialidad);
	            html = '';
	            $.each(ui.item.modulos, function(key, value){
	            	
	            	html += '<tr>';
	            	html += '<td>'+value.nombre+'</td>';
	            	if (!value.practica_realizada) {
	            		practica = 'No';
	            	}else{
	            		practica = 'SI';
	            	}
	            	html += '<td>'+practica+'</td>';
	            	fecha_emision = '';
	            	if (value.fecha_emision) {
	            		fecha_emision = value.fecha_emision;
	            	}
	            	html += '<td>'+fecha_emision+'</td>';
	            	fecha_entrega = '';
	            	if (value.fecha_entrega) {
	            		fecha_entrega = value.fecha_entrega;
	            	}
	            	html += '<td>'+fecha_entrega+'</td>';
	            	numero_registro = '';
	            	if (value.numero_registro) {
	            		numero_registro = value.numero_registro;
	            	}
	            	html += '<td>'+numero_registro+'</td>';
	            	html += '</tr>';
	            });

	            $("#tbmodulos tbody").html(html);
	        },
	    });
	});
</script>

</body>
</html>