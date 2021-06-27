<div class="content-layout">
    <div class="content-layout-row">
	    <div class="layout-cell" style="width: 33%" >
	        <?= form_open('especialidades/', array('class' => 'search', 'id' => 'busquedaForm', 'method' => 'get')) ?>
			<?= form_input('campo', $campo, array('id' => 'campo', 'placeholder' => 'Descripción')) ?><a class="search-button" href="#" onclick="javascript:jQuery(this).parents('form').submit();"><span class="search-button-text">Buscar</span></a>
			<?= form_close() ?>
	    </div>
	    <div class="layout-cell" style="width: 67%" >
	        <p style="text-align: right;">
	        	<?php if($this->session->userdata('tipo') == "Administrador" || $this->session->userdata('tipo') == "Editor"): ?>
	        	<a href="#" class="button" data-toggle="modal" data-target="#ModalAgregar"><span class="glyphicon glyphicon-plus-sign"></span> Nueva especialidad</a>
	        	<?php endif ?>
		        <a href="<?= base_url() ?>admin" class="button"><span class="glyphicon glyphicon-menu-hamburger"></span> Menú</a>
	        </p>
	    </div>
    </div>
</div>
<div class="content-layout">
    <div class="content-layout-row">
	    <div class="layout-cell" style="width: 100%" >
			<?php if($num_esp > 0){ ?>
			<br>
			<table style="margin: auto;">
				<tr>
					<th>Descripción</th>
					<th>Acciones</th>
				</tr>
				<?php foreach ($especialidades as $esp): ?>
				<tr>
					<td><?= $esp->descripcion ?></td>
					<td>
						<?php if($this->session->userdata('tipo') == "Administrador" || $this->session->userdata('tipo') == "Editor"): ?>
			        		<a href="#" class="button" title="Editar" data-toggle="modal" data-target="#ModalEditar<?= $esp->id ?>"><span class="glyphicon glyphicon-edit"></a>
			        	<?php endif?>
			        	<?php if($this->session->userdata('tipo') == "Administrador"): ?>
							<a href="#" class="button" title="Eliminar" data-toggle="modal" data-target="#ModalEliminar<?= $esp->id ?>"><span class="glyphicon glyphicon-remove"></a>
						<?php endif?>
					</td>
				</tr>
				<!--Modal Editar-->
				<?php
				$data = array(
					'id' => $esp->id,
					'descripcion' => $esp->descripcion,
					);
				$this->load->view('especialidades/editar_view', $data);
				?>
				<!--Modal Eliminar-->
				<?php
				$data = array('id' => $esp->id, 'descripcion' => $esp->descripcion);
				$this->load->view('especialidades/eliminar_view', $data);
				?>
				<?php endforeach ?>
			</table>
			<?= $pagination ?>
			<?php } else { ?>
			<div class="alert alert-info">
				<h2 class="text-center"><?= $mensaje ?></h2>
			</div>
			<?php } ?>
			<!--Modal para agregar registros-->
			<?php
			$this->load->view('especialidades/agregar_view');
			?>
	    </div>
    </div>
</div>