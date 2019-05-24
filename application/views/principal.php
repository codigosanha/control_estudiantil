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
									<th>ESPECIALIDAD:</th>
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
 <div class="modal modal-info fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">CAMBIO DE ESTADO</h4>
            </div>
            <form action="<?php echo base_url(); ?>backend/categorias/changeImage" method="POST" enctype="multipart/form-data">
	          	<div class="modal-body">
	                <div class="row">
	                    <div class="col-sm-4">
	                        <h4>Portada Actual</h4>
	                        <img src="" alt="Portada Actual" class="image-actual img-responsive">
	                    </div>
	                    <div class="col-sm-8">
	                        <h4>Cambiar Imagen de Portada</h4>
	                    </div>
	                </div>
	          	</div>
	          	<div class="modal-footer">
	            	<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
	            	<button type="submit" class="btn btn-warning">Guardar</button>
	          	</div>
          	</form>
        </div>
        <!-- /.modal-content -->
    </div>
      <!-- /.modal-dialog -->
</div>