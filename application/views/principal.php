<section class="content">
	  <!-- Default box -->
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">Tablero Principal</h3>

			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
				<i class="fa fa-minus"></i></button>
				<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
				<i class="fa fa-times"></i></button>
			 </div>
		</div>
		<div class="box-body">
			<div class="row">
				<div class="col-md-6 col-md-offset-3 col-xs-12">
					<h2 class="text-center">Buscar información del estudiante</h2>
					<div class="form-group">
						<input type="text" id="search-estudiante" name="search-estudiante" class="form-control" placeholder="Introduzca algo...">
					</div>
				</div>
			</div>
			<hr>
			<div class="row" >
				<div class="col-md-12">
					<div style="background: #d2d6de;">
						<br>
						<p class="text-center"><strong>INFORMACION DEL ESTUDIANTE</strong></p>
						<table class="table table-bordered">
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
									<th>ESPECIALIDAD:</th>
									<td id="especialidad"></td>
								</tr>
							</tbody>
						</table>

						<p class="text-center"><strong>INFORMACION DE MODULOS</strong></p>
						<table class="table table-bordered" id="tbmodulos">
							<thead>
								<tr>
									<th>MODULO</th>
									<th>PRACTICA</th>
									<th>CERTIFICADO</th>
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
		<!-- /.box-body -->
	</div>
	  <!-- /.box -->
</section>
 