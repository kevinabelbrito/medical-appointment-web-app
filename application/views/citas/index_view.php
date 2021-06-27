<div class="content-layout">
    <div class="content-layout-row">
	    <div class="layout-cell" style="width: 33%" >
	        <?= form_open('citas/', array('class' => 'search', 'id' => 'busquedaForm', 'method' => 'get')) ?>
			<?= form_input('campo', $campo, array('id' => 'campo', 'placeholder' => 'Documento, nombre del paciente o medico')) ?><a class="search-button" href="#" onclick="javascript:jQuery(this).parents('form').submit();"><span class="search-button-text">Buscar</span></a>
			<?= form_close() ?>
	    </div>
	    <div class="layout-cell" style="width: 67%" >
	        <p style="text-align: right;">
	        	<?php if($this->session->userdata('tipo') == "Administrador" || $this->session->userdata('tipo') == "Editor"): ?>
	        	<a href="#" class="button" data-toggle="modal" data-target="#ModalAgregar"><span class="glyphicon glyphicon-plus-sign"></span> Programar cita</a>
	        	<?php endif ?>
		        <a href="<?= base_url() ?>admin" class="button"><span class="glyphicon glyphicon-menu-hamburger"></span> Menú</a>
	        </p>
	    </div>
    </div>
</div>
<div class="content-layout">
    <div class="content-layout-row">
	    <div class="layout-cell" style="width: 100%" >
			<?php if($num_citas > 0){ ?>
			<br>
			<div class="table-responsive">
			<table style="margin: auto;">
				<tr>
					<th>Nº</th>
					<th>Paciente</th>
					<th>Fecha</th>
					<th>Médico Tratante</th>
					<th>Especialidad</th>
					<th>Turno</th>
					<th>Estatus</th>
					<th>Acciones</th>
				</tr>
				<?php foreach ($citas as $cita): ?>
				<tr>
					<td><?= $cita->id ?></td>
					<td style="min-width: 150px;"><?= $cita->nombre_paciente ?></td>
					<td><?= date("d/m/Y", strtotime($cita->fecha)) ?></td>
					<td style="min-width: 150px"><?= $cita->nombre_medico ?></td>
					<td><?= $cita->especialidad ?></td>
					<td><?= $cita->turno ?></td>
					<td>
						<span class="label <?php if($cita->status == "Pendiente de Pago"): ?> label-warning <?php else: ?> label-success <?php endif ?>">
							<?= $cita->status ?>
						</span>
					</td>
					<td style="min-width: 250px; text-align: center;">
						<?php if($this->session->userdata('tipo') == "Administrador" || $this->session->userdata('tipo') == "Editor"): ?>
			        		<a href="#" class="button" title="Editar" data-toggle="modal" data-target="#ModalEditar<?= $cita->id ?>"><span class="glyphicon glyphicon-edit"></a>
			        		<?php
			        		$num_consultas = $this->citas_model->num_consultas($cita->id);
			        		if($num_consultas == 0):
			        		?>
			        		<a href="#" class="button" title="Consulta" data-toggle="modal" data-target="#ModalConsulta<?= $cita->id ?>">C</a>
			        		<?php endif ?>
			        		<?php if($cita->status == "Pendiente de Pago"): ?>
			        		<a href="#" class="button" title="Notificar Pago" data-toggle="modal" data-target="#ModalPagar<?= $cita->id ?>">P</a>
			        		<?php endif ?>
			        	<?php endif?>
			        	<?php if($this->session->userdata('tipo') == "Administrador"): ?>
							<a href="#" class="button" title="Eliminar" data-toggle="modal" data-target="#ModalEliminar<?= $cita->id ?>"><span class="glyphicon glyphicon-remove"></a>
						<?php endif?>
					</td>
				</tr>
				<!--Modals del modulo-->
				<?php
				//Modal Editar
				$data = array(
					'id' => $cita->id,
					'paciente' => $cita->paciente,
					'medico' => $cita->medico,
					'fecha' => $cita->fecha,
					'turno' => $cita->turno,
					'turnos' => $turnos,
					'medicos' => $medicos,
					'pacientes' => $pacientes,
					);
				$this->load->view('citas/editar_view', $data);
				//Modal Pagar
				$data = array(
					'id' => $cita->id,
					'nombre_paciente' => $cita->nombre_paciente,
					'doc_paciente' => $cita->doc_paciente,
					'fecha' => $cita->fecha,
					'precio_consulta' => $cita->precio_consulta,
					);
				$this->load->view('citas/pagar_view', $data);
				//Modal Consulta
				$data = array(
					'id' => $cita->id,
					'nombre_paciente' => $cita->nombre_paciente,
					'nombre_medico' => $cita->nombre_medico,
					);
				$this->load->view('citas/consulta_view', $data);
				//Modal Eliminar
				$data = array('id' => $cita->id);
				$this->load->view('citas/eliminar_view', $data);
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
			<!--Modal para agregar registros-->
			<?php
			$this->load->view('citas/agregar_view', array('turnos' => $turnos));
			?>
	    </div>
    </div>
</div>