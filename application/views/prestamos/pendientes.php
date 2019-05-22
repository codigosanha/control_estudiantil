<section class="content">
      <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Devoluciones Pendientes</h3>

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
                    <table id="tb-without-buttons" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Codigo de Libro</th>
                                <th>DNI</th>
                                <th>Lector</th>
                                <th>Fec. de Prestamo</th>
                                <th>Fec. de Devolucion</th>
                                <th>Est. de Devolucion</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($prestamos): ?>
                                <?php $i = 1;?>
                                <?php foreach ($prestamos as $prestamo): ?>
                                    
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $prestamo->codigo_topografico; ?></td>

                                            <td><?php echo $prestamo->num_documento; ?></td>
                                            <td><?php echo $prestamo->nombres . " " . $prestamo->apellidos; ?></td>
                                            <td><?php echo $prestamo->fecha_prestamo; ?></td>
                                            <td><?php echo $prestamo->fecha_devolucion; ?></td>

                                            <?php
                                              
                                                $fec_actual = new DateTime(date("Y-m-d"));
                                                $fec_devolucion = new DateTime($prestamo->fecha_devolucion);
                                                $diff = $fec_actual->diff($fec_devolucion);
                                                if (strtotime(date("Y-m-d")) <= strtotime($prestamo->fecha_devolucion)) {
                                                    $mensaje = "Falta ";
                                                }else{
                                                    $mensaje = "Retraso de ";
                                                }



                                             ?>

                                            <td><?php echo $mensaje.$diff->days." dias";?></td>

                                            <td>
                                                <button type="button" class="btn btn-success btn-xs btn-flat btn-renovar" value='<?php echo json_encode($prestamo);?>'>
                                                    Renovar
                                                </button>
                                                <a href="<?php echo base_url(); ?>prestamos/update/<?php echo $prestamo->id; ?>" class="btn btn-danger btn-xs btn-flat" title="Finalizar Prestamo"><i class="fa fa-hourglass-end" aria-hidden="true"></i> Finalizar</a>

                                            </td>
                                        </tr>
                                        <?php $i++;?>
                                 
                                <?php endforeach;?>
                            <?php endif;?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.box-body -->
    </div>
      <!-- /.box -->
</section>