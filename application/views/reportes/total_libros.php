<section class="content">
      <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">REPORTE DE TOTAL DE LIBROS</h3>

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
                    <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>TITULO</th>
                                <th>AUTOR</th>
                                <th>AÑO</th>
                                <th>EDITORIAL</th>
                                <th>EDICCION</th>
                                <th>CODIGO TOPOGRAFICO</th>
                                <th>CODIGO DE BARRAS</th>
                                <th>CATEGORIA</th>
                                <th>IDIOMA</th>
                                <th>EJEMPLARES</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($libros): ?>
                            <?php $i = 1;?>
                            <?php foreach ($libros as $libro): ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $libro->titulo; ?></td>
                                    <td><?php echo $libro->autor; ?></td>
                                    <td><?php echo $libro->año_publicacion; ?></td>
                                    <td><?php echo $libro->editorial; ?></td>
                                    <td><?php echo $libro->ediccion; ?></td>
                                    
                                    <td><?php echo $libro->codigo_topografico; ?></td>
                                    <td><?php echo $libro->codigo_barras; ?></td>
                                    <td><?php echo $libro->categoria; ?></td>
                                    <td><?php echo $libro->idioma; ?></td>
                                    <td><?php echo $libro->ejemplares; ?></td>
                                    
                                </tr>
                                <?php $i++;?>
                            <?php endforeach;?>
                        <?php endif;?>
                        </tbody>
                    </table>
                    <a href="<?php echo base_url().'reportes/exportarLibros';?>" class="btn btn-success btn-lg">Exportar a Excel</a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.box-body -->
    </div>
      <!-- /.box -->
</section>
