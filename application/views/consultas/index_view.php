<div class="content-layout">
    <div class="content-layout-row">
	    <div class="layout-cell" style="width: 33%" >
	        <?= form_open('consultas/', array('class' => 'search', 'id' => 'busquedaForm', 'method' => 'get')) ?>
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
			<?php if($num_consultas > 0){ ?>
			<br>
			<div class="table-responsive">
			<table style="margin: auto;">
				<tr>
					<th>Nº</th>
					<th>Paciente</th>
					<th>Médico Tratante</th>
					<th>Consultorio</th>
					<th>Fecha de la cita</th>
					<th>Diagnostico</th>
					<th>Acciones</th>
				</tr>
				<?php foreach ($consultas as $cst): ?>
				<tr>
					<td><?= $cst->id ?></td>
					<td style="min-width: 120px;"><?= $cst->nombre_paciente ?></td>
					<td style="min-width: 120px;"><?= $cst->nombre_medico ?></td>
					<td><?= $cst->consultorio ?></td>
					<td><?= date("d/m/Y", strtotime($cst->fecha_cita)) ?></td>
					<td>
						<div style="width: 200px;"><?= $cst->diagnostico ?></div>
					</td>
					<td style="min-width: 280px; text-align: center;">
						<a href="#" class="button" title="Editar" data-toggle="modal" data-target="#ModalEditar<?= $cst->id ?>"><span class="glyphicon glyphicon-edit"></a>
						<a href="<?= base_url() ?>consultas/detalles/<?= $cst->id ?>" class="button"><span class="glyphicon glyphicon-list-alt"></span></a>
						<a href="<?= base_url() ?>consultas/imprimir/<?= $cst->id ?>" class="button" target="_blank"><span class="glyphicon glyphicon-print"></span></a>
					</td>
				</tr>
				<!--Modal Editar-->
				<?php
				$data = array(
					'id' => $cst->id,
					'nombre_paciente' => $cst->nombre_paciente,
					'nombre_medico' => $cst->nombre_medico,
					'sintomas' => $cst->sintomas,
					'diagnostico' => $cst->diagnostico,
					'tratamiento' => $cst->tratamiento,
					'observaciones' => $cst->observaciones,
					);
				$this->load->view('consultas/editar_view', $data);
				?>
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