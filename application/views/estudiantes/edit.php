<section class="content">
      <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Editar Estudiante</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fa fa-times"></i></button>
             </div>
        </div>
        <?php if ($this->session->flashdata("success")): ?>
            <script>
                swal("Exito", "<?php echo $this->session->flashdata("success") ;?>", "success");
            </script>
        <?php endif ?>
        <?php echo form_open('estudiantes/update', "enctype=multipart/form-data"); ?>
        <input type="hidden" name="idEstudiante" value="<?php echo $estudiante->id?>">
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nombres">Nombres:</label>
                        <input type="text" class="form-control" id="nombres" name="nombres" placeholder="Nombre" required="required" value="<?php echo set_value('nombres')?:$estudiante->nombres; ?>">
                    </div>
                    <div class="form-group">
                        <label for="apellidos">Apellidos:</label>
                        <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Apellidos" required="required" value="<?php echo set_value('apellidos')?:$estudiante->apellidos; ?>">
                    </div>
                    <div class="form-group <?php echo form_error('dni') == true ? 'has-error' : '' ?>">
                        <label for="dni">DNI:</label>
                        <input type="text" class="form-control" id="dni" name="dni" placeholder="DNI" required="required" value="<?php echo set_value('dni')?:$estudiante->dni; ?>">
                        <?php echo form_error('dni'); ?>
                    </div>
                    <div class="form-group">
                        <label for="nombre">Semestre:</label>
                        <select name="semestre" id="semestre" class="form-control" required="required">
                            <option value="">Seleccione..</option>
                            <?php
                                for ($i=1; $i <= 7 ; $i++) { 
                                    $selected = '';
                                    if ($estudiante->semestre == $i) {
                                        $selected = 'selected';
                                    }
                                    echo "<option value='".$i."' ".$selected.">".getNumeroRomano($i)."</option>";
                                }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="especialidad_id">Programa de Estudio</label>
                        <select name="especialidad_id" id="especialidad_id" class="form-control" required="required">
                            <option value="">Seleccione...</option>
                            <?php foreach ($especialidades as $especialidad): ?>
                                <?php
                                    $selected = '';
                                    if ($estudiante->especialidad_id == $especialidad->id) {
                                        $selected = 'selected';
                                    }

                                ?>
                                <option value="<?php echo $especialidad->id?>" <?php echo $selected; ?>><?php echo $especialidad->nombre?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>

                
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <div class="row">
                <div class="form-group">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
                        <a href="<?php echo base_url(); ?>estudiantes" class="btn btn-danger"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
                    </div>
                </div>
            </div>
        </div>
        </form>
        <!-- /.box-footer-->
    </div>
      <!-- /.box -->

</section>