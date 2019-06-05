<?php if ($this->session->flashdata("success")): ?>
                <script>
                    swal("Exito", "<?php echo $this->session->flashdata("success") ;?>", "success");
                </script>
            <?php endif ?>
<section class="content">
      <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Lista de Modulos</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fa fa-times"></i></button>
             </div>
        </div>
        <div class="box-body">
            <?php if ($this->session->userdata("rol") != 3): ?>
                <div class="row">
                    <div class="col-md-12 text-right">
                        <a href="<?php echo base_url(); ?>modulos/add" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo Modulo</a>
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
                                <th>Programa de Estudio</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($modulos): ?>
                            <?php $i = 1;?>
                            <?php foreach ($modulos as $modulo): ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $modulo->nombre; ?></td>
                                    <td><?php echo getEspecialidad($modulo->especialidad_id)->nombre; ?></td>
                                    <td>
                                        <?php if ($modulo->estado == 0): ?>
                                            <span class="label label-danger">Inactivo</span>
                                        <?php else: ?>
                                            <span class="label label-success">Activo</span>
                                        <?php endif ?>
                                        
                                    </td>
                                    <td>
                                        <?php if ($this->session->userdata("rol") == 3): ?>
                                            -
                                        <?php else: ?>
                                            <div class="btn-group">
                                                <?php if ($modulo->estado == 1): ?>
                                                    <a href="<?php echo base_url(); ?>modulos/edit/<?php echo $modulo->id; ?>" class="btn btn-warning btn-flat" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
                                            
                                                    <button type="button" class="btn btn-danger btn-flat btn-inactivar-modulo" title="Inactivar" value="<?php echo $modulo->id;?>"><span class="glyphicon glyphicon-remove"></span></button>
                                                <?php else: ?>
                                                    <button type="button" class="btn btn-success btn-flat btn-activar-modulo" title="Activar" value="<?php echo $modulo->id;?>"><span class="glyphicon glyphicon-check"></span></button>
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
