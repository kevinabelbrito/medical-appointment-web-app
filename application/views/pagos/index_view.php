<div class="content-layout">
    <div class="content-layout-row">
	    <div class="layout-cell" style="width: 33%" >
	        <?= form_open('pagos/', array('class' => 'search', 'id' => 'busquedaForm', 'method' => 'get')) ?>
			<?= form_input('campo', $campo, array('id' => 'campo', 'placeholder' => 'Documento, nombre del paciente o medico')) ?><a class="search-button" href="#" onclick="javascript:jQuery(this).parents('form').submit();"><span class="search-button-text">Buscar</span></a>
			<?= form_close() ?>
	    </div>
	    <div class="layout-cell" style="width: 67%" >
	        <p style="text-align: right;">
		        <a href="<?= base_url() ?>admin" class="button"><span class="glyphicon glyphicon-menu-hamburger"></span> Menú</a>
	        </p>
	    </div>
    </div>
</div>
<div class="content-layout">
    <div class="content-layout-row">
	    <div class="layout-cell" style="width: 100%" >
			<?php if($num_pagos > 0){ ?>
			<br>
			<div class="table-responsive">
			<table style="margin: auto;">
				<tr>
					<th>Nº</th>
					<th>Paciente</th>
					<th>Médico Tratante</th>
					<th>Fecha de la cita</th>
					<th>Fecha del pago</th>
					<th>Monto</th>
					<th>Acciones</th>
				</tr>
				<?php foreach ($pagos as $pago): ?>
				<tr>
					<td><?= $pago->id ?></td>
					<td style="min-width: 150px;"><?= $pago->nombre_paciente ?></td>
					<td style="min-width: 150px;"><?= $pago->nombre_medico ?></td>
					<td><?= date("d/m/Y", strtotime($pago->fecha_cita)) ?></td>
					<td><?= date("d/m/Y", strtotime($pago->fecha_pago)) ?></td>
					<td><?= number_format($pago->monto, 2, ',', '.') ?></td>
					<td style="min-width: 200px; text-align: center;">
						<a href="<?= base_url() ?>pagos/detalles/<?= $pago->id ?>" class="button"><span class="glyphicon glyphicon-list-alt"></span></a>
						<a href="<?= base_url() ?>pagos/imprimir/<?= $pago->id ?>" class="button" target="_blank"><span class="glyphicon glyphicon-print"></span></a>
					</td>
				</tr>
				<?php endforeach ?>
			</table>
			</div>
			<?= $pagination ?>
			<?php } else { ?>
			<div class="alert alert-info">
				<h2 class="text-center"><?= $mensaje ?></h2>
			</div>
			<?php } ?>
	    </div>
    </div>
</div>