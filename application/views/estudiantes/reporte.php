<head>
	<title>Reporte Estudiantil</title>
</head>
<style>
	table{
		width: 100%;
		background: #FFF;
		border: 1px solid #d2d6de;
		margin-bottom: 15px;
	}
	table tr th, table tr td{
		border: 1px solid #000;
	}
	.text-center{
		text-align: center;
	}
</style>
<p class="text-center"><strong>INFORMACION DEL ESTUDIANTE</strong></p>
<table cellspacing="0" cellpadding="3">
	<tbody>
		<tr>
			<th width="30%">NOMBRES:</th>
			<td><?php echo $estudiante->nombres;?></td>
		</tr>
		<tr>
			<th width="30%">APELLIDOS:</th>
			<td><?php echo $estudiante->apellidos;?></td>
		</tr>
		<tr>
			<th width="30%">DNI:</th>
			<td><?php echo $estudiante->dni;?></td>
		</tr>
		<tr>
			<th width="30%">SEMESTRE:</th>
			<td><?php echo $estudiante->semestre;?></td>
		</tr>
		<tr>
			<th width="30%">PROGRAMA DE ESTUDIO:</th>
			<td><?php echo getEspecialidad($estudiante->especialidad_id)->nombre;?></td>
		</tr>
	</tbody>
</table>


<table cellspacing="0" cellpadding="3">
	<thead>
		<tr>
			<th colspan="2" class="text-center">INFORMACION DE MODULOS</th>
			<th colspan="3" class="text-center">INFORMACION DEL CERTIFICADO</th>
		</tr>
		<tr>
			<th class="text-center">MODULO</th>
			<th class="text-center">PRACTICA</th>
			<th class="text-center">FECHA DE EMISION</th>
			<th class="text-center">FECHA DE ENTREGA</th>
			<th class="text-center">N° DE REGISTRO</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($modulos as $modulo): ?>
			<tr>
				<td><?php echo $modulo->nombre;?></td>
				<td><?php echo $modulo->practica_realizada? 'SI':'NO';?></td>
				<td><?php echo $modulo->fecha_emision ?:'';?></td>
				<td><?php echo $modulo->fecha_entrega ?:'';?></td>
				<td><?php echo $modulo->numero_registro ?:'';?></td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>