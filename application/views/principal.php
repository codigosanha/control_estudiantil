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
						<p class="text-center"><strong>INFORMACIÓN DEL ESTUDIANTE</strong></p>
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
									<th colspan="2" class="text-center">INFORMACIÓN DE MÓDULOS PROFESIONALES</th>
									<th colspan="4" class="text-center">INFORMACIÓN DEL CERTIFICADO</th>
								</tr>
								<tr>
									<th>MÓDULO</th>
									<th>PRÁCTICA MODULAR</th>
									<th>FECHA DE EMISIÓN</th>
									<th>FECHA DE ENTREGA</th>
									<th>N° DE REGISTRO</th>
									<th>EDITAR</th>
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
<div class="modal modal-default fade" id="modal-confirmar-practica" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"> <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">CONFIRMACIÓN DE PRÁCTICAS PRE PROFESIONALES</h4>
            </div>
            <form action="<?php echo base_url(); ?>estudiantes/confirmar_practica" method="POST" id="form-confirmar-practica" enctype="multipart/form-data">
	          	<div class="modal-body">
	                <div class="row">
	                    <div class="col-sm-12">
	                    	<div class="form-group">
	                        Para confirmar la realización de la practica pre profesionales por parte del estudiante <b class="estudiante"></b> en el módulo profesional de <b class="modulo"></b> se debe llenar el siguiente formulario. 
	                        </div>
	                        <div class="form-group">
	                        	<label for="">Nombre del Módulo Profesional:</label>
	                        	<input type="text" class="form-control" id="modulo" required="required">
	                        </div>
	                        <div class="form-group">
	                        	<label for="">Práctica Modular:</label>
	                        	<input type="text" name="practica_modular" class="form-control" required="required">
	                        </div>
	                        <div class="form-group">
	                        	<label for="">Título de la Práctica Modular:</label>
	                        	<textarea name="titulo_practica" class="form-control" required="required" rows="3"></textarea>
	                        </div>
	                        
	                        	<p><strong>Temporabilidad de la Práctica Modular</strong></p>
	                        	<div class="row">
	                        		<div class="col-md-6 form-group">
	                        			<label for="">Fecha de Inicio:</label>
	                        			<input type="date" name="fecha_inicio" class="form-control" required="required">
	                        		</div>
	                        		<div class="col-md-6 form-group">
	                        			<label for="">Fecha de Término:</label>
	                        			<input type="date" name="fecha_termino" class="form-control" required="required">
	                        		</div>
	                        	</div>
	                        	
	                    
	                        <div class="form-group">
	                        	<label for="">Total de Horas:</label>
	                        	<input type="text" name="total_horas" class="form-control" required="required">
	                        </div>
	                        <div class="form-group">
	                        	<label for="">Nota Cualitativa:</label>
	                        	<input type="text" name="nota_cualitativa" class="form-control" required="required">
	                        </div>

	                        <div class="form-group">
	                        	<label for="">N°. de Resolución de Aprobación:</label>
	                        	<input type="text" name="numero_resolucion" class="form-control" required="required">
	                        </div>
	                        <div class="form-group">
			                	<label for="">Nombre del Asesor</label>
			                	<input type="text" name="asesor" class="form-control" required="required">
			                </div>
			                <div class="form-group">
			                	<label for="">Resolución de Aprobación</label>
			                	<input type="file" name="file" class="form-control" accept=".doc,.docx,.pdf">
			                </div>
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
	                	<label for="">Módulo Profesional</label>
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
	                	<label for="">Número de Registro</label>
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

<div class="modal modal-default fade" id="modal-informe" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"> <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Información de Práctica Modular</h4>
            </div>

          	<div class="modal-body">
            	<div class="row">
					<div class="col-md-12">
						<div class="form-group">
				        	<label for="">Nombre del Módulo:</label><p class="info-modulo"></p>
				        </div>
				        <div class="form-group">
				        	<label for="">Práctica Modular:</label>
				        	<p class="info-practica"></p>
				        </div>
				        <div class="form-group">
				        	<label for="">Título de la Práctica Modular:</label>
				        	<p class="info-titulo"></p>
				        </div>
				        <div class="form-group">
				            <label for="">Nombre del Asesor:</label>
				            <p class="info-asesor"></p>
				        </div>
				        
				        	<p><strong>Temporabilidad de la Práctica Modular</strong></p>
				        	<div class="row">
				        		<div class="col-md-6 form-group">
				        			<label for="">Fecha de Inicio:</label>
				        			<p class="info-fecha-inicio"></p>
				        		</div>
				        		<div class="col-md-6 form-group">
				        			<label for="">Fecha de Termino:</label>
				        			<p class="info-fecha-termino"></p>
				        		</div>
				        	</div>
				        	
				    
				        <div class="form-group">
				        	<label for="">Total de Horas:</label>
				        	<p class="info-horas"></p>
				        </div>
				        <div class="form-group">
				        	<label for="">Nota Cualitativa:</label>
				        	<p class="info-nota"></p>
				        </div>
				        <div class="form-group">
				        	<label for="">N°. de Resolución de Aprobación:</label>
				        	<p class="info-resolucion"></p>
				        </div>
				        
				        <div class="form-group">
				            <label for="">Documento de la Resolución de Aprobación:</label>
				            <p class="info-documento"></p>
				                
				        </div>
					</div>
				</div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-danger btn-cancelar-practica pull-left" data-dismiss="modal">Cancelar</button>
          	</div>
         
        </div>
        <!-- /.modal-content -->
    </div>
      <!-- /.modal-dialog -->
</div>

<div class="modal modal-default fade" id="modal-edit-practica" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"> <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">EDITAR INFORMACIÓN DE PRÁCTICAS PRE PROFESIONALES</h4>
            </div>
            <form action="<?php echo base_url(); ?>estudiantes/editar_practica" method="POST" id="form-edit-practica" enctype="multipart/form-data">
	          	<div class="modal-body">
	                <div class="row">
	                    <div class="col-sm-12">
	                        <div class="form-group">
	                        	<label for="">Nombre del Módulo Profesional:</label>
	                        	<input type="text" class="form-control" name="modulo" required="required">
	                        </div>
	                        <div class="form-group">
	                        	<label for="">Práctica Modular:</label>
	                        	<input type="text" name="practica_modular" class="form-control" required="required">
	                        </div>
	                        <div class="form-group">
	                        	<label for="">Título de la Práctica Modular:</label>
	                        	<textarea name="titulo_practica" class="form-control" required="required" rows="3"></textarea>
	                        </div>
	                        
	                        	<p><strong>Temporabilidad de la Práctica Modular</strong></p>
	                        	<div class="row">
	                        		<div class="col-md-6 form-group">
	                        			<label for="">Fecha de Inicio:</label>
	                        			<input type="date" name="fecha_inicio" class="form-control" required="required">
	                        		</div>
	                        		<div class="col-md-6 form-group">
	                        			<label for="">Fecha de Término:</label>
	                        			<input type="date" name="fecha_termino" class="form-control" required="required">
	                        		</div>
	                        	</div>
	                        	
	                    
	                        <div class="form-group">
	                        	<label for="">Total de Horas:</label>
	                        	<input type="text" name="total_horas" class="form-control" required="required">
	                        </div>
	                        <div class="form-group">
	                        	<label for="">Nota Cualitativa:</label>
	                        	<input type="text" name="nota_cualitativa" class="form-control" required="required">
	                        </div>
	                        <div class="form-group">
	                        	<label for="">N°. de Resolución de Aprobación:</label>
	                        	<input type="text" name="numero_resolucion" class="form-control" required="required">
	                        </div>
	                        <div class="form-group">
			                	<label for="">Nombre del Asesor</label>
			                	<input type="text" name="asesor" class="form-control" required="required">
			                </div>
			                <div class="form-group">
			                	<label for="">Resolución de Aprobación</label>
			                	<br>
			                	<div id="info-documento">
			                		<a href="#" class="btn-documento" target="_blank">documento.docx</a> <button type="button" class="btn btn-danger btn-quitar-documento btn-xs"> <span class="fa fa-times"></span></button>
			                	</div>
			                	
			                	<input type="file" name="file" class="form-control" id="file" accept=".doc,.docx,.pdf">
			                	<input type="hidden" name="estado" id="estado" value="0">
			                </div>
	                    </div>
	                    <input type="hidden" name="estudiante_modulo" >
	         
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