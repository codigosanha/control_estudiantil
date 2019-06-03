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
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/sweetalert/sweetalert.css">

	<style>
		html,body{
			margin: 0;
			background: #d2d6de;
			height: 100%;
			width: 100%;
		}
		.container{
			background: #FFF;
			height: auto;
			min-height: 100%;
		}
		.info-estudiante{
			padding: 0;
		}
		header{
			background: #17a2b8;
			height: 150px;
			padding-top: 60px;
		}
		header h1{
			margin: 0;
			color: #FFF;
			font-weight: bold;

		}
		section{
			padding:15px;
		}
		@media only screen and (max-width : 480px) {
			header{
				padding-top: 25px;
			}
			header h1{
				font-size: 30px;
			}
		}
	</style>
</head>
<body>

<div class="container info-estudiante">
		<header>
			<h1 class="text-center">SISTEMA DE INFORMACION ESTUDIANTIL</h1>
		</header>
		<section>
			<div class="row">
				<div class="col-md-6 col-md-offset-3 col-xs-12">
					<h4 class="text-center">Buscar información del estudiante</h4>
					<div class="form-group">
						<form action="<?php echo base_url();?>welcome/getInfoEstudiante" method="POST" id="form-search-estudiante">
							<div class="input-group">
						      	<input type="text" name="dni" class="form-control" placeholder="Introduzca DNI " required="required" maxlength="8">
						      	<span class="input-group-btn">
						        	<button class="btn btn-warning" type="submit">Buscar</button>
						      	</span>
						    </div><!-- /input-group -->
					    </form>
					</div>
				</div>
			</div>
			<div class="row" >
				<div class="col-md-12 col-xs-12">
					<div style="display: none;" id="infoEstudiante">
						<br>
						<p class="text-center"><strong>INFORMACION DEL ESTUDIANTE</strong></p>
						<div class="table-responsive">
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
						</div>
						<div class="table-responsive">
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
		</section>

		
		
	
</div>

<script src="<?php echo base_url(); ?>assets/jquery/jquery.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/jquery-ui/jquery-ui.js"></script>
<script src="<?php echo base_url(); ?>assets/sweetalert/sweetalert.js"></script>

<script>
	var base_url = "<?php echo base_url();?>";
</script>
<script>
	$(document).ready(function(){
		$('input[name=dni]').keypress(function (tecla) {
		  	if (tecla.charCode < 48 || tecla.charCode > 57) return false;
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
</script>

</body>
</html>