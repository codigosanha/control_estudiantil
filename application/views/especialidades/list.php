<section class="content">
      <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Lista de Programa de Estudios</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fa fa-times"></i></button>
             </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12 text-right">
                    <a href="<?php echo base_url(); ?>programa_estudios/add" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo Programa de Estudio</a>
                </div>
            </div>
            <!-- /.row -->
            <?php if ($this->session->flashdata("success")): ?>
                <script>
                    swal("Exito", "<?php echo $this->session->flashdata("success") ;?>", "success");
                </script>
            <?php endif ?>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <table id="tb-without-buttons" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($especialidades): ?>
                            <?php $i = 1;?>
                            <?php foreach ($especialidades as $especialidad): ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $especialidad->nombre; ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="<?php echo base_url(); ?>programa_estudios/edit/<?php echo $especialidad->id; ?>" class="btn btn-warning btn-flat" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
                                            <button type="button" class="btn btn-danger btn-flat btn-eliminar-especialidad" title="Eliminar" value="<?php echo $especialidad->id;?>"><span class="glyphicon glyphicon-remove"></span></button>
                                        </div>
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
