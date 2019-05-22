<section class="content">
      <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Todos los Prestamos</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fa fa-times"></i></button>
             </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-center">REGISTRO DE PRESTAMOS REALIZADOS</h2>
                    <table  class="table table-bordered tabla-prestamos-realizados">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>APELLIDOS Y NOMBRES</th>
                                <th>TIPO DE LECTOR </th>
                                <th>DNI/CARNET</th>
                                <th>TITULO DE LIBRO</th>
                                <th>CODIGO TOPOGRAFICO</th>
                                <th>FECHA DE PRESTAMO</th>
                                <th>FECHA DE DEVOLUCION</th>
                                <th>HORA</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($prestamos): ?>
                                <?php $i = 1;?>
                                <?php foreach ($prestamos as $prestamo): ?>

                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $prestamo->apellidos." ".$prestamo->nombres; ?></td>

                                            <td><?php echo $prestamo->tipolector; ?></td>
                                            <td><?php echo $prestamo->num_documento; ?></td>
                                            <td><?php echo $prestamo->titulo; ?></td>
                                            <td><?php echo $prestamo->codigo_topografico; ?></td>
                                            <td><?php echo $prestamo->fecha_prestamo; ?></td>
                                            <td><?php echo $prestamo->fecha_devolucion; ?></td>
                                            <td><?php echo date("h:i a", strtotime($prestamo->hora)); ?></td>
                                        </tr>
                                    <?php $i++;?>
                                <?php endforeach;?>
                            <?php endif;?>
                        </tbody>
                    </table>
                    <a href="<?php echo base_url().'reportes/exportarPrestamos';?>" class="btn btn-success btn-lg">Exportar a Excel</a>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.box-body -->
    </div>
      <!-- /.box -->
</section>