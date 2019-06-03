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
			<div class="row" >
				<div class="col-md-12">
					<div style="display: none;" id="infoEstudiante">
						<br>
						<p class="text-center"><strong>INFORMACION DEL ESTUDIANTE</strong></p>
						<input type="hidden" id="estudiante">
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
									<td id="especialidad"></td>
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
									<th>Editar</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
						<a href="" target="_blank" id="reporte_estudiante" class="btn btn-danger btn-flat btn-lg">
							<span class="glyphicon glyphicon-list-alt"></span> Ver en formato Reporte</a>

					</div>
				</div>
			</div>
		</div>
		<!-- /.box-body -->
	</div>
	  <!-- /.box -->
</section>
 <div class="modal modal-default fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">CAMBIO DE ESTADO</h4>
            </div>
            <form action="<?php echo base_url(); ?>estudiantes/cambioEstado" method="POST" id="form-cambio-estado">
            	<input type="hidden" name="estudiante_id">
	            <input type="hidden" name="modulo_id" >
	          	<div class="modal-body">
	                <div class="form-group">
	                	<label for="">Estudiante:</label>
	                	<p class="estudiante"></p>
	                </div>
	                <div class="form-group">
	                	<label for="">Modulo</label>
	                	<p class="modulo"></p>
	                </div>
	                <div class="form-group">
	                	<label for="">Estado Actual</label>
	                	<p class="estadoActual"></p>
	                </div>
	                <div class="form-group">
	                	<label for="">Nuevo Estado</label>
	                	<p class="nuevoEstado"></p>
	                	<input type="hidden" name="nuevoEstado" id="nuevoEstado">
	                </div>
	                <div class="form-group">
	                	<label for="">Indique Fecha de Cambio:</label>
	                	<input type="date" name="fecha" value="<?php echo date("Y-m-d");?>">

	                </div>
	          	</div>
	          	<div class="modal-footer">
	            	<button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
	            	<button type="submit" class="btn btn-success">Guardar</button>
	          	</div>
          	</form>
        </div>
        <!-- /.modal-content -->
    </div>
      <!-- /.modal-dialog -->
</div>

<div class="modal modal-default fade" id="modal-confirmar-practica" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">CONFIRMACION DE PRACTICAS PRE PROFESIONALES</h4>
            </div>
            <form action="<?php echo base_url(); ?>estudiantes/confirmar_practica" method="POST" id="form-confirmar-practica">
	          	<div class="modal-body">
	                <div class="row">
	                    <div class="col-sm-12">
	                        Realmente esta seguro de confirmar la realización de la practica pre profesionales por parte del estudiante <b class="estudiante"></b> en el modulo de <b class="modulo"></b>, de ser así haga click en el boton Confirmar caso contrario en Cancelar.
	                    </div>
	                    <input type="hidden" name="estudiante_id" id="estudiante_id">
	                    <input type="hidden" name="modulo_id" id="modulo_id">
	                </div>
	          	</div>
	          	<div class="modal-footer">
	            	<button type="button" class="btn btn-danger btn-cancelar-practica pull-left" data-dismiss="modal">Cancelar</button>
	            	<button type="submit" class="btn btn-success btn-confirmar">Confirmar</button>
	          	</div>
          	</form>
        </div>
        <!-- /.modal-content -->
    </div>
      <!-- /.modal-dialog -->
</div>

<div class="modal modal-default fade" id="modal-certificado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Actualizar información del Certificado</h4>
            </div>
            <form action="<?php echo base_url(); ?>estudiantes/updateCertificado" method="POST" id="form-update-certificado">
	          	<div class="modal-body">
	                <input type="hidden" name="idModEst" id="idModEst">
                    <div class="form-group">
	                	<label for="">Estudiante:</label>
	                	<p class="estudiante"></p>
	                </div>
	                <div class="form-group">
	                	<label for="">Modulo</label>
	                	<p class="modulo"></p>
	                </div>
	                <div class="form-group">
	                	<label for="">Fecha de Emisión</label>
	                	<input type="date" name="fecha_emision" class="form-control">
	                </div>
	                <div class="form-group">
	                	<label for="">Fecha de Entrega</label>
	                	<input type="date" name="fecha_entrega" class="form-control">
	                </div>
	                <div class="form-group">
	                	<label for="">Numero de Registro</label>
	                	<input type="text" name="numero_registro" class="form-control">
	                </div>
                    <input type="hidden" name="estudiante_id">
                    <input type="hidden" name="modulo_id">
	                
	          	</div>
	          	<div class="modal-footer">
	            	<button type="button" class="btn btn-danger btn-cancelar-practica pull-left" data-dismiss="modal">Cerrar</button>
	            	<button type="submit" class="btn btn-success btn-confirmar">Guardar</button>
	          	</div>
          	</form>
        </div>
        <!-- /.modal-content -->
    </div>
      <!-- /.modal-dialog -->
</div>