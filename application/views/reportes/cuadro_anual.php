<section class="content">
	  <!-- Default box -->
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">CUADRO ANUAL DE LIBROS PRESTADOS POR CATEGORIA</h3>

			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
				<i class="fa fa-minus"></i></button>
				<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
				<i class="fa fa-times"></i></button>
			 </div>
		</div>
		<div class="box-body">
			<form action="<?php echo current_url();?>" method="POST">
				<div class="row">
					<div class="form-group">
						<div class="col-md-5">
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon3">Indique Año:</span>
								<input type="text" class="form-control" id="datepicker" aria-describedby="basic-addon3" name="year" required="required" value="<?php echo $year;?>">
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
				
			
			<div class="row">
				<div class="col-md-12">
					<h2 class="text-center">LIBROS PRESTADOS POR CATEGORIA AÑO - <?php echo $year;?></h2>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Codigo</th>
								<th>Categoria/Meses</th>
								<th>Ene</th>
								<th>Feb</th>
								<th>Mar</th>
								<th>Abr</th>
								<th>May</th>
								<th>Jun</th>
								<th>Jul</th>
								<th>Ago</th>
								<th>Set</th>
								<th>Oct</th>
								<th>Nov</th>
								<th>Dic</th>
								<th>Total</th>
							</tr>
						</thead>
						<?php 
							$totaljan=0;
							$totalfeb=0;
							$totalmar=0;
							$totalapr=0;
							$totalmay=0;
							$totaljun=0;
							$totaljul=0;
							$totalaug=0;
							$totalsep=0;
							$totaloct=0;
							$totalnov=0;
							$totaldec=0;
						?>
						<tbody>
							<?php foreach ($categorias as $categoria): ?>
								<tr>
									<td><?php echo $categoria->codigo;?></td>
									<td><?php echo $categoria->nombre;?></td>
									<td><?php echo $categoria->cantidades->jan;?></td>
									<td><?php echo $categoria->cantidades->feb;?></td>
									<td><?php echo $categoria->cantidades->mar;?></td>
									<td><?php echo $categoria->cantidades->apr;?></td>
									<td><?php echo $categoria->cantidades->may;?></td>
									<td><?php echo $categoria->cantidades->jun;?></td>
									<td><?php echo $categoria->cantidades->jul;?></td>
									<td><?php echo $categoria->cantidades->aug;?></td>
									<td><?php echo $categoria->cantidades->sep;?></td>
									<td><?php echo $categoria->cantidades->oct;?></td>
									<td><?php echo $categoria->cantidades->nov;?></td>
									<td><?php echo $categoria->cantidades->dec;?></td>
									<td><?php echo $categoria->cantidades->total_yearly;?></td>
								</tr>

								<?php 
									$totaljan = $totaljan + $categoria->cantidades->jan;
									$totalfeb=$totalfeb + $categoria->cantidades->feb;
									$totalmar=$totalmar + $categoria->cantidades->mar;
									$totalapr=$totalapr + $categoria->cantidades->apr;
									$totalmay=$totalmay + $categoria->cantidades->may;
									$totaljun=$totaljun + $categoria->cantidades->jun;
									$totaljul=$totaljul + $categoria->cantidades->jul;
									$totalaug=$totalaug + $categoria->cantidades->aug;
									$totalsep=$totalsep + $categoria->cantidades->sep;
									$totaloct=$totaloct + $categoria->cantidades->oct;
									$totalnov=$totalnov + $categoria->cantidades->nov;
									$totaldec=$totaldec + $categoria->cantidades->dec;

								?>
								
							<?php endforeach ?>
							<tr>
								
								<th colspan="2">TOTALES MENSUALES</th>
								<td><?php echo $totaljan;?></td>
								<td><?php echo $totalfeb;?></td>
								<td><?php echo $totalmar;?></td>
								<td><?php echo $totalapr;?></td>
								<td><?php echo $totalmay;?></td>
								<td><?php echo $totaljun;?></td>
								<td><?php echo $totaljul;?></td>
								<td><?php echo $totalaug;?></td>
								<td><?php echo $totalsep;?></td>
								<td><?php echo $totaloct;?></td>
								<td><?php echo $totalnov;?></td>
								<td><?php echo $totaldec;?></td>
								<td><?php echo $totaljan + $totalfeb + $totalmar + $totalapr + $totalmay + $totaljun + $totaljul + $totalaug + $totalsep + $totaloct + $totalnov + $totaldec;?></td>
							</tr>
						</tbody>
					</table>
					<a href="<?php echo base_url().'reportes/exportar/'.$year;?>" class="btn btn-success btn-lg">Exportar a Excel</a>
				</div>
			</div>
			<?php endif ?>
		</div>
		<!-- /.box-body -->
	</div>
	  <!-- /.box -->
</section>
 