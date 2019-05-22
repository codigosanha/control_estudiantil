<section class="content">
	  <!-- Default box -->
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">CUADRO MENSUAL DE LIBROS PRESTADOS POR CATEGORIA</h3>

			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
				<i class="fa fa-minus"></i></button>
				<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
				<i class="fa fa-times"></i></button>
			 </div>
		</div>
		<div class="box-body">
			<form action="<?php echo current_url(); ?>" method="POST">
				<div class="row">
					<div class="form-group">
						<div class="col-md-5">
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon3">Indique Mes-Año:</span>
								<input type="text" class="form-control" id="datepicker1" aria-describedby="basic-addon3" name="month-year" required="required" value="<?php echo $monthYear;?>">
								<span class="input-group-btn">
							        <input class="btn btn-primary" type="submit" name="buscar" value="Buscar">
							    </span>
							</div>
						</div>
					</div>
				</div>
				<br>
			</form>
			<?php if (!empty($categorias)): ?>
				
			<?php $meses = ["ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SETIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE"];?>
			<div class="row">
				<div class="col-md-12">
					<h3 class="text-center">LIBROS PRESTADOS POR CATEGORIA DEL MES DE <?php echo $meses[$month-1];?> DEL <?php echo $year;?></h3>
					<div class="table-responsive">
					<table class="table table-bordered tabla-cuadro-mensual">
						<thead>
							<tr>
								<th>Codigo</th>
								<th>Categoria/Día</th>
								
								<?php foreach ($dias as $dia): ?>
									<th><?php echo $dia;?></th>
								<?php endforeach ?>
								<th>Total</th>
								
							</tr>
						</thead>
						
						<tbody>
							<?php $totalDias = 0;?>
							<?php foreach ($categorias as $categoria): ?>
								<tr>
									<td><?php echo $categoria->codigo;?></td>
									<td><?php echo $categoria->nombre;?></td>
									<?php $total = 0;?>
									<?php $cantDias = 0;?>
									<?php foreach ($categoria->amountPerDays as $key => $value): ?>
										<td><?php echo $value;?></td>
										<?php $total += $value;?>
										<?php $cantDias += 1;?>
									<?php endforeach ?>
									<td><?php echo $total;?></td>
								
								</tr>
								<?php $totalDias += $total;  ?>
							<?php endforeach ?>
							<tr>
								<th colspan="<?php echo $cantDias +2;?>" class="text-right">Total</th>
								<td><?php echo $totalDias?></td>
							</tr>
						
						</tbody>
					</table>
					</div>
					<a href="<?php echo base_url().'reportes/exportarByMonth/'.$month."/".$year;?>" class="btn btn-success btn-lg">Exportar a Excel</a>
				</div>
			</div>
			<?php endif ?>
		</div>
		<!-- /.box-body -->
	</div>
	  <!-- /.box -->
</section>
 