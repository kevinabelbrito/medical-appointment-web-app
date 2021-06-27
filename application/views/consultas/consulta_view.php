<div class="content-layout">
	<div class="content-layout-row">
		<div class="layout-cell" style="width: 100%" >
	        <p style="text-align: right;">
	        	<a href="<?= base_url() ?>consultas/" class="button">Lista de consultas</a>
		        <a href="<?= base_url() ?>admin" class="button"><span class="glyphicon glyphicon-menu-hamburger"></span> Menú</a>
	        </p>
	    </div>
	</div>
</div>
<div class="content-layout">
    <div class="content-layout-row">
	    <div class="layout-cell" style="width: 100%; padding: 10px;" >
	    	<div class="row">
	    		<div class="col-md-6 col-sm-12">
	    			<div class="panel panel-primary">
					    <div class="panel-heading">Información del Paciente</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-xs-6"><?= form_label('Nombres y Apellidos') ?></div>
								<div class="col-xs-6"><?= $nombre_paciente ?></div>
							</div>
							<div class="row">
								<div class="col-xs-6"><?= form_label('Documento de Identidad') ?></div>
								<div class="col-xs-6"><?= $doc_paciente ?></div>
							</div>
							<div class="row">
								<div class="col-xs-6"><?= form_label('Sexo') ?></div>
								<div class="col-xs-6"><?= $sexo ?></div>
							</div>
							<div class="row">
								<div class="col-xs-6"><?= form_label('Tipo de Sangre') ?></div>
								<div class="col-xs-6"><?= $adn ?></div>
							</div>
							<div class="row">
								<div class="col-xs-6"><?= form_label('Peso') ?></div>
								<div class="col-xs-6"><?= $peso ?> Kg.</div>
							</div>
							<div class="row">
								<div class="col-xs-6"><?= form_label('Altura') ?></div>
								<div class="col-xs-6"><?= number_format($altura, 2, ',', '.') ?> Mts.</div>
							</div>
						</div>
					</div>
	    		</div>
	    		<div class="col-md-6 col-sm-12">
	    			<div class="panel panel-primary">
					    <div class="panel-heading">Información del Médico</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-xs-6"><?= form_label('Nombres y Apellidos') ?></div>
								<div class="col-xs-6"><?= $nombre_medico ?></div>
							</div>
							<div class="row">
								<div class="col-xs-6"><?= form_label('Documento de Identidad') ?></div>
								<div class="col-xs-6"><?= $doc_medico ?></div>
							</div>
							<div class="row">
								<div class="col-xs-6"><?= form_label('Especialidad') ?></div>
								<div class="col-xs-6"><?= $especialidad ?></div>
							</div>
							<div class="row">
								<div class="col-xs-6"><?= form_label('Correo Electrónico') ?></div>
								<div class="col-xs-6"><?= $email_medico ?></div>
							</div>
							<div class="row">
								<div class="col-xs-6"><?= form_label('Fecha de Ingreso') ?></div>
								<div class="col-xs-6"><?= date("d/m/Y", strtotime($ingreso)) ?></div>
							</div>
							<div class="row">
								<div class="col-xs-6"><?= form_label('Consultorio') ?></div>
								<div class="col-xs-6"><?= $consultorio ?></div>
							</div>
						</div>
					</div>
	    		</div>
	    	</div>
	    	<div class="row">
	    		<div class="col-xs-12">
	    			<div class="panel panel-primary">
					    <div class="panel-heading">Información de la consulta</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-sm-3 col-xs-6"><?= form_label('Nº de Cita') ?></div>
								<div class="col-sm-3 col-xs-6"><?= $nro_cita ?></div>
								<div class="col-sm-3 col-xs-6"><?= form_label('Fecha de la Cita') ?></div>
								<div class="col-sm-3 col-xs-6"><?= date("d/m/Y", strtotime($fecha_cita)) ?></div>
							</div>
							<div class="row">
								<div class="col-sm-3 col-xs-6"><?= form_label('Sintomas') ?></div>
								<div class="col-sm-3 col-xs-6"><?= $sintomas ?></div>
								<div class="col-sm-3 col-xs-6"><?= form_label('Diagnostico') ?></div>
								<div class="col-sm-3 col-xs-6"><?= $diagnostico ?></div>
							</div>
							<div class="row">
								<div class="col-sm-3 col-xs-6"><?= form_label('Tratamiento') ?></div>
								<div class="col-sm-3 col-xs-6"><?= $tratamiento ?></div>
								<div class="col-sm-3 col-xs-6"><?= form_label('Observaciones') ?></div>
								<div class="col-sm-3 col-xs-6"><?= $observaciones ?></div>
							</div>
						</div>
					</div>
	    		</div>
	    	</div>
	    	<div class="row text-center">
	    		<a href="<?= base_url() ?>consultas/imprimir/<?= $id ?>" class="button" target="_blank"><span class="glyphicon glyphicon-print"></span> Imprimir Consulta</a>
    		</div>
	    </div>
    </div>
</div>