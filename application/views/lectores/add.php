<section class="content">
      <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Registrar Lector</h3>

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
        <?php echo form_open('lectores/store', "enctype=multipart/form-data"); ?>
        <div class="box-body">
            <div class="col-md-6">
               
                <div class="form-group">
                    <label for="nombres">Nombres:</label>
                    <input type="text" class="form-control" id="nombres" name="nombres" placeholder="Nombres" required="required" value="<?php echo set_value('nombres')?:''; ?>">
                </div>
                <div class="form-group">
                    <label for="apellidos">Apellidos:</label>
                    <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Apellidos" required="required" value="<?php echo set_value('apellidos')?:''; ?>">
                </div>
                <div class="form-group">
                    <label for="tipo_documento_id" class="control-label">Tipo Documento</label>
                    <select name="tipo_documento_id" id="tipo_documento_id" class="form-control" required="required" >
                        <?php foreach ($tipodocumentos as $tipodocumento): ?>
                            <option value="<?php echo $tipodocumento->id; ?>" <?php echo set_value('tipo_documento_id') == $tipodocumento->id?'selected':''; ?>><?php echo $tipodocumento->nombre; ?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tipo_lector_id" class="control-label">Tipo Lector</label>
                    <select name="tipo_lector_id" id="tipo_lector_id" class="form-control" required="required">
                        
                        <?php foreach ($tipolectores as $tipolector): ?>
                            <option value="<?php echo $tipolector->id; ?>" <?php echo set_value('tipo_lector_id') == $tipolector->id?'selected':''; ?>><?php echo $tipolector->nombre; ?></option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="telefono">Telefono</label>
                    <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Telefono" value="<?php echo set_value('telefono')?:''; ?>" maxlength="9">
                </div>

                <div class="form-group">
                    <label for="direccion">Direccion</label>
                    <input type="text" class="form-control" id="direccin" name="direccion" placeholder="Direccion" value="<?php echo set_value('direccion')?:''; ?>">
                </div>
                
                <div class="form-group <?php echo form_error('num_documento') == true ? 'has-error' : '' ?>">
                    <label for="num_documento">Numero Documento</label>
                    <input type="text" class="form-control" id="num_documento" name="num_documento" placeholder="Numero de Documento" required="required" value="<?php echo set_value('num_documento'); ?>">
                   
                    <?php echo form_error('num_documento'); ?>
                </div>

                <div class="form-group <?php echo form_error('distrito_provincia') == true ? 'has-error' : '' ?>">
                    <label for="distrito_provincia">Distrito - Provincia</label>
                    <input type="text" class="form-control" id="distrito_provincia" name="distrito_provincia" placeholder="Numero de Documento" required="required" value="<?php echo set_value('distrito_provincia'); ?>" required="required">
                   
                    <?php echo form_error('distrito_provincia'); ?>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <div class="form-group">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
                    <a href="<?php echo base_url(); ?>lectores" class="btn btn-danger"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
                </div>
            </div>
        </div>
        </form>
        <!-- /.box-footer-->
    </div>
      <!-- /.box -->

</section>