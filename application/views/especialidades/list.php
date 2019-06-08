<?php if ($this->session->flashdata("success")): ?>
                <script>
                    swal("Exito", "<?php echo $this->session->flashdata("success") ;?>", "success");
                </script>
            <?php endif ?>
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
            <?php if ($this->session->userdata("rol") != 4): ?>
                <div class="row">
                    <div class="col-md-12 text-right">
                        <a href="<?php echo base_url(); ?>programa_estudios/add" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo Programa de Estudio</a>
                    </div>
                </div>
                <!-- /.row -->
                
                <hr>
            <?php endif ?>
            
            <div class="row">
                <div class="col-md-12">
                    <table id="tb-without-buttons" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Estado</th>
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
                                        <?php if ($especialidad->estado == 0): ?>
                                            <span class="label label-danger">Inactivo</span>
                                        <?php else: ?>
                                            <span class="label label-success">Activo</span>
                                        <?php endif ?>
                                        
                                    </td>
                                    <td>
                                        <?php if ($this->session->userdata("rol") == 4): ?>
                                            -
                                        <?php else: ?>
                                            <div class="btn-group">
                                                <?php if ($especialidad->estado == 1): ?>
                                                    <a href="<?php echo base_url(); ?>programa_estudios/edit/<?php echo $especialidad->id; ?>" class="btn btn-warning btn-flat" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
                                                    <button type="button" class="btn btn-danger btn-flat btn-inactivar-especialidad" title="Inactivar" value="<?php echo $especialidad->id;?>"><span class="glyphicon glyphicon-remove"></span></button>
                                                <?php else: ?>
                                                    <button type="button" class="btn btn-success btn-flat btn-activar-especialidad" title="Activar" value="<?php echo $especialidad->id;?>"><span class="glyphicon glyphicon-check"></span></button>
                                                <?php endif ?>
                                            </div>
                                        <?php endif ?>
                                        
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
