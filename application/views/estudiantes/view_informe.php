<div class="row">
	<div class="col-md-12">
		<div class="form-group">
        	<label for="">Nombre del Módulo:</label><br>
        	<?php echo getModulo($informe->modulo_id)->nombre;?>
        </div>
        <div class="form-group">
        	<label for="">Practica Modular:</label><br>
        	<?php echo $informe->practica_modular;?>
        </div>
        <div class="form-group">
        	<label for="">Titulo de la Práctica Modular:</label><br>
        	<?php echo $informe->titulo_practica;?>
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
        	<label for="">N°. de Resolución de Aprobacion:</label><br>
        	<?php echo $informe->numero_resolucion;?>
        </div>
	</div>
</div>