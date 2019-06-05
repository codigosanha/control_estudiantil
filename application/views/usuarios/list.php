<?php if ($this->session->flashdata("success")): ?>
                <script>
                    swal("Exito", "<?php echo $this->session->flashdata("success") ;?>", "success");
                </script>
            <?php endif ?>
<section class="content">
      <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Lista de  Usuarios</h3>

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
                        <a href="<?php echo base_url(); ?>usuarios/add" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo usuario</a>
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
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>DNI</th>
                                <th>Username</th>
                                <th>Rol</th>
                                <th>Cambiar Contraseña</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($usuarios): ?>
                            <?php $i = 1;?>
                            <?php foreach ($usuarios as $usuario): ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $usuario->nombres; ?></td>
                                    <td><?php echo $usuario->apellidos; ?></td>
                                    <td><?php echo $usuario->dni; ?></td>
                                    <td><?php echo $usuario->username; ?></td>
                                    <td>
                                        <?php 

                                            if ($usuario->rol == 1) {
                                                echo "Director";
                                            }else if($usuario->rol == 2){
                                                echo "Secretaria";
                                            }else{
                                                echo "Docente";
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php if ($this->session->userdata("rol") != 3): ?>
                                            <button type="button"  class="btn btn-default btn-change-password" value="<?php echo $usuario->id;?>" data-toggle="modal" data-target="#modal-default">Cambiar</button>
                                        <?php else: ?>
                                            -
                                        <?php endif ?>
                                        
                                    </td>
                                    <td>
                                        <?php if ($this->session->userdata("rol") == 3): ?>
                                            -
                                        <?php else: ?>
                                            <div class="btn-group">
                                                <a href="<?php echo base_url(); ?>usuarios/edit/<?php echo $usuario->id; ?>" class="btn btn-warning btn-flat" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
                                                <button class="btn btn-danger btn-eliminar-usuario" value="<?php echo $usuario->id?>">
                                                    <span class="fa fa-times"></span>
                                                </button>
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

<div class="modal modal-default fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Cambiar Contraseña</h4>
            </div>
            <form action="<?php echo base_url();?>usuarios/changePassword" method="POST" id="form-change-password">
                <input type="hidden" id="idUsuario" name="idUsuario">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="newpass">Nueva Contraseña:</label>
                        <input type="password" class="form-control" name="newpass" id="newpass">
                    </div>
                    <div class="form-group">
                        <label for="repeatpass">Repetir Contraseña:</label>
                        <input type="password" class="form-control" name="repeatpass" id="repeatpass">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
      <!-- /.modal-dialog -->
</div>