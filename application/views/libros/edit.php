<section class="content">
      <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Editar Libro</h3>
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
        <?php echo form_open('libros/update', "enctype=multipart/form-data"); ?>
        <input type="hidden" name="idLibro" value="<?php echo $libro->id;?>">
        <input type="hidden" name="imagenLast" value="<?php echo $libro->imagen?>">
        <div class="box-body">
            <div class="col-md-6">
                <div class="form-group <?php echo form_error('codigo_topografico') == true ? 'has-error' : '' ?>">
                    <label for="codigo_topografico">Codigo Topografico</label>
                    <input type="text" class="form-control" id="codigo_topografico" name="codigo_topografico" placeholder="Codigo Tpografico" value="<?php echo set_value('codigo_topografico') ?: $libro->codigo_topografico; ?>" required="required">
                    <?php echo form_error('codigo_topografico'); ?>
                </div>
                <div class="form-group <?php echo form_error('codigo_barras') == true ? 'has-error' : '' ?>">
                    <label for="codigo_barras">Codigo Barras</label>
                    <input type="text" class="form-control" id="codigo_barras" name="codigo_barras" placeholder="Codigo de Barras" value="<?php echo set_value('codigo_barras') ?: $libro->codigo_barras; ?>" required="required">
                    <?php echo form_error('codigo_barras'); ?>
                </div>
                <div class="form-group <?php echo form_error('titulo') == true ? 'has-error' : '' ?>">
                    <label for="titulo">Titulo</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Titulo" value="<?php echo set_value('titulo') ?: $libro->titulo; ?>" required="required">
                    <?php echo form_error('titulo'); ?>
                </div>
                <div class="form-group <?php echo form_error('autor') == true ? 'has-error' : '' ?>">
                    <label for="autor">Autor</label>
                    <input type="text" class="form-control" id="autor" name="autor" placeholder="Autor" value="<?php echo set_value('autor')?:$libro->autor; ?>" required="required">
                    <?php echo form_error('autor'); ?>
                </div>
                <div class="form-group">
                    <label for="publicacion">Año de Publicacion</label>
                    <input type="text" id="datepicker"class="form-control" id="publicacion" name="publicacion" placeholder="Año de Publicacion" value="<?php echo $libro->año_publicacion;?>" required="required">
                </div>

            </div>
        <div class="col-md-6">

            <div class="form-group">
                <label for="editorial">Editorial</label>
                <input type="text" class="form-control" id="editorial" name="editorial" placeholder="Editorial" value="<?php echo $libro->editorial;?>">
            </div>

            <div class="form-group">
                <label for="ediccion">Ediccion</label>
                <input type="text" class="form-control" id="ediccion" name="ediccion" placeholder="Ediccion"  value="<?php echo $libro->ediccion;?>" maxlength="15">
            </div>
            <div class="form-group">
                <label for="idioma">Idioma</label>
                <select name="idioma" id="idioma" class="form-control">
                    <option value="Español" <?php echo $libro->idioma == 'Español' ? 'selected':'';?>>Español</option>
                    <option value="Ingles" <?php echo $libro->idioma == 'Ingles' ? 'selected':'';?>>Ingles</option>
                </select>
            </div>
            <div class="form-group <?php echo form_error('ejemplares') == true ? 'has-error' : '' ?>">
                <label for="ejemplares">Ejemplares</label>
                <input type="number" class="form-control" id="ejemplares" name="ejemplares" placeholder="Ejemplares" value="<?php echo set_value('ejemplares')?:$libro->ejemplares; ?>" required="required" min="1">
                <?php echo form_error('ejemplares'); ?>
            </div>
            <div class="form-group <?php echo form_error('categoria_id') == true ? 'has-error' : '' ?>">
                <label for="categoria_id" class="control-label">Categoria</label>
                <select name="categoria_id" id="categoria_id" class="form-control" required="required">
                    <option value="">Seleccione...</option>
                    <?php foreach ($categorias as $categoria): ?>
                        <option value="<?php echo $categoria->id; ?>" <?php echo $categoria->id == $libro->categoria_id ? 'selected':'';?>><?php echo $categoria->nombre; ?></option>
                    <?php endforeach;?>
                </select>
                <?php echo form_error('categoria_id'); ?>
            </div>
            <div class="form-group">
                <label for="imagen">Imagen Portada</label>
                <input type="file" id="imagen" name="imagen" accept=".jpg, .png">
            </div>
        </div>

        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <div class="form-group">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
                    <a href="<?php echo base_url(); ?>libros" class="btn btn-danger"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
                </div>
            </div>
        </div>
        </form>
        <!-- /.box-footer-->
    </div>
      <!-- /.box -->

</section>