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
			<td><?php echo getNumeroRomano($estudiante->semestre);?></td>
		</tr>
		<tr>
			<th width="30%">PROGRAMA DE ESTUDIO:</th>
			<td><?php echo getEspecialidad($estudiante->especialidad_id)->nombre;?></td>
		</tr>
	</tbody>
</table>

<p class="text-center"><strong>INFORMACION DE PRACTICA MODULAR</strong></p>
<table cellspacing="0" cellpadding="3">
	<tr>
		<th>Nombre del Módulo</th>
		<td colspan="4"><?php echo getModulo($informe->modulo_id)->nombre;?></td>
	</tr>
	<tr>
		<th>Practica Modular</th>
		<td colspan="4"><?php echo $informe->practica_modular;?></td>
	</tr>
	<tr>
		<th>Titulo de la Práctica Modular</th>
		<td colspan="4"><?php echo $informe->titulo_practica;?></td>
	</tr>
	<tr>
		<th>Temporalidad de la Practica Modular</th>
		<th>INICIO:</th>
		<td><?php echo $informe->fecha_inicio;?></td>
		<th>FIN:</th>
		<td><?php echo $informe->fecha_termino;?></td>
	</tr>
	<tr>
		<th>Total de Horas</th>
		<td colspan="4"><?php echo $informe->total_horas;?></td>
	</tr>
	<tr>
		<th>Nota Cualitativa:</th>
		<td colspan="4"><?php echo $informe->nota_cualitativa;?></td>
	</tr>
	<tr>
		<th>N°. de resolución de aprobacion	</th>
		<td colspan="4"><?php echo $informe->numero_resolucion;?></td>
	</tr>
	<tr>
		<th>Nombre del Asesor</th>
		<td colspan="4"><?php echo $informe->asesor;?></td>
	</tr>
</table>
	
