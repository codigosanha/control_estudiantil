<div class="row">
	<div class="col-md-12">
		<div class="form-group">
        	<label for="">Nombre del Módulo:</label><br>
        	<?php echo getModulo($informe->modulo_id)->nombre;?>
        </div>
        <div class="form-group">
        	<label for="">Práctica Modular:</label><br>
        	<?php echo $informe->practica_modular;?>
        </div>
        <div class="form-group">
        	<label for="">Título de la Práctica Modular:</label><br>
        	<?php echo $informe->titulo_practica;?>
        </div>
        <div class="form-group">
            <label for="">Nombre del Asesor:</label><br>
            <?php echo $informe->asesor;?>
        </div>
        
        	<p><strong>Temporabilidad de la Práctica Modular</strong></p>
        	<div class="row">
        		<div class="col-md-6 form-group">
        			<label for="">Fecha de Inicio:</label><br>
        			<?php echo $informe->fecha_inicio;?>
        		</div>
        		<div class="col-md-6 form-group">
        			<label for="">Fecha de Termino:</label><br>
        			<?php echo $informe->fecha_termino;?>
        		</div>
        	</div>
        	
    
        <div class="form-group">
        	<label for="">Total de Horas:</label><br>
        	<?php echo $informe->total_horas;?>
        </div>
        <div class="form-group">
        	<label for="">N°. de Resolución de Aprobación:</label><br>
        	<?php echo $informe->numero_resolucion;?>
        </div>
        
        <div class="form-group">
            <label for="">Documento de la Resolución de Aprobación:</label><br>
            <?php if ($informe->archivo_resolucion): ?>
                <?php 
                    $modulo = "welcome";
                    if ($this->uri->segment(1) == "principal"){
                        $modulo = "principal";
                    } 
                ?>
                <a href="<?php echo base_url().$modulo;?>/resoluciones/<?php echo $informe->archivo_resolucion;?>"><?php echo $informe->archivo_resolucion;?></a>
                
            <?php endif ?>
                
        </div>
	</div>
</div>