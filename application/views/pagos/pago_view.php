<div class="content-layout">
	<div class="content-layout-row">
		<div class="layout-cell" style="width: 100%" >
	        <p style="text-align: right;">
	        	<a href="<?= base_url() ?>pagos/" class="button">Lista de pagos</a>
		        <a href="<?= base_url() ?>admin" class="button"><span class="glyphicon glyphicon-menu-hamburger"></span> Menú</a>
	        </p>
	    </div>
	</div>
</div>
<div class="content-layout">
    <div class="content-layout-row">
	    <div class="layout-cell" style="width: 100%; padding: 10px;" >
		    <div class="row">
		    	<div class="col-sm-6 col-sm-12">
		    		<div class="panel panel-primary">
					    <div class="panel-heading">Información General</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-xs-6"><?= form_label('Nombre del Paciente') ?></div>
								<div class="col-xs-6"><?= $nombre_paciente ?></div>
							</div>
							<div class="row">
								<div class="col-xs-6"><?= form_label('Documento de Identidad') ?></div>
								<div class="col-xs-6"><?= $doc_paciente ?></div>
							</div>
							<div class="row">
								<div class="col-xs-6"><?= form_label('Medico Tratante') ?></div>
								<div class="col-xs-6"><?= $nombre_medico ?></div>
							</div>
							<div class="row">
								<div class="col-xs-6"><?= form_label('Documento de Identidad') ?></div>
								<div class="col-xs-6"><?= $doc_medico ?></div>
							</div>
						</div>
					</div>
		    	</div>
		    	<div class="col-sm-6 col-sm-12">
		    		<div class="panel panel-primary">
					    <div class="panel-heading">Datos del pago</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-xs-6"><?= form_label('Fecha de la Cita') ?></div>
								<div class="col-xs-6"><?= date("d/m/Y", strtotime($fecha_cita)) ?></div>
							</div>
							<div class="row">
								<div class="col-xs-6"><?= form_label('Turno') ?></div>
								<div class="col-xs-6"><?= $turno ?></div>
							</div>
							<div class="row">
								<div class="col-xs-6"><?= form_label('Fecha del pago') ?></div>
								<div class="col-xs-6"><?= date("d/m/Y", strtotime($fecha_pago)) ?></div>
							</div>
							<div class="row">
								<div class="col-xs-6"><?= form_label('Monto') ?></div>
								<div class="col-xs-6"><?= number_format($monto, 2, ',', '.') ?></div>
							</div>
						</div>
					</div>
		    	</div>
		    </div>
		    <div class="row text-center">
				<a href="<?= base_url() ?>pagos/imprimir/<?= $id ?>" class="button" target="_blank"><span class="glyphicon glyphicon-print"></span> Imprimir Recibo</a>
			</div>
	    </div>
	</div>
</div>