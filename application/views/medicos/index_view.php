<div class="content-layout">
    <div class="content-layout-row">
	    <div class="layout-cell" style="width: 33%" >
	        <?= form_open('medicos/', array('class' => 'search', 'id' => 'busquedaForm', 'method' => 'get')) ?>
			<?= form_input('campo', $campo, array('id' => 'campo', 'placeholder' => 'Documento o Nombre')) ?><a class="search-button" href="#" onclick="javascript:jQuery(this).parents('form').submit();"><span class="search-button-text">Buscar</span></a>
			<?= form_close() ?>
	    </div>
	    <div class="layout-cell" style="width: 67%" >
	        <p style="text-align: right;">
	        	<?php if($this->session->userdata('tipo') == "Administrador" || $this->session->userdata('tipo') == "Editor"): ?>
	        	<a href="#" class="button" data-toggle="modal" data-target="#ModalAgregar"><span class="glyphicon glyphicon-plus-sign"></span> Agregar nuevo</a>
	        	<?php endif ?>
		        <a href="<?= base_url() ?>admin" class="button"><span class="glyphicon glyphicon-menu-hamburger"></span> Menú</a>
	        </p>
	    </div>
    </div>
</div>
<div class="content-layout">
    <div class="content-layout-row">
    	<div class="layout-cell" style="width: 100%" >
			<?php if($num_medicos > 0){ ?>
			<?php foreach ($medicos as $doctor): ?>
			<div class="col-md-4 col-sm-6 col-xs-12">	
		        <p style="text-align: center;">
		        <img width="180" height="180" class="lightbox" src="<?= base_url() ?>assets/images/personas/<?= $doctor->foto ?>"><br></p>
		        <h3 style="text-align: center;"><?= $doctor->nombre ?></h3>
		        <h4 style="text-align: center;"><?= $doctor->especialidad ?></h4>
		        <h4 style="text-align: center;">Bs. <?= $doctor->precio_consulta ?></h4>
		        <p style="text-align: center;">
		        	<?php if($this->session->userdata('tipo') == "Administrador" || $this->session->userdata('tipo') == "Editor"): ?>
		        	<a href="#" class="button" title="Editar" data-toggle="modal" data-target="#ModalEditar<?= $doctor->id ?>"><span class="glyphicon glyphicon-edit"></a>
		        	<?php endif?>
		        	<?php if($this->session->userdata('tipo') == "Administrador"): ?>
						<a href="#" class="button" title="Eliminar" data-toggle="modal" data-target="#ModalEliminar<?= $doctor->id ?>"><span class="glyphicon glyphicon-remove"></a>
					<?php endif?>
		        </p>
		    </div>
		    <!--Modal Editar-->
			<?php
			$data = array(
				'id' => $doctor->id,
				'nombre' => $doctor->nombre,
				'documento' => $doctor->documento,
				'sexo' => $doctor->sexo,
				'email' => $doctor->email,
				'tlf' => $doctor->tlf,
				'foto' => $doctor->foto,
				'especialidad' => $doctor->id_especialidad,
				'especialidades' => $especialidades,
				'ingreso' => $doctor->ingreso,
				'consultorio' => $doctor->consultorio,
				'precio_consulta' => $doctor->precio_consulta,
				);
			$this->load->view('medicos/editar_view', $data);
			?>
			<!--Modal Eliminar-->
			<?php
			$data = array('id' => $doctor->id, 'nombre' => $doctor->nombre);
			$this->load->view('medicos/eliminar_view', $data);
			?>
			<?php endforeach ?>
		</div>
	</div>
</div>
<div class="content-layout">
    <div class="content-layout-row">
	    <div class="layout-cell" style="width: 100%" >
	    <?= $pagination ?>
	    </div>
   </div>
</div>
<?php } else { ?>
<div class="content-layout">
    <div class="content-layout-row">
	    <div class="layout-cell" style="width: 100%" >
		    <div class="alert alert-warning">
		    	<h3 class="text-center"><?= $mensaje ?></h3>
		    </div>
	    </div>
    </div>
</div>
<?php } ?>
<!--Modal para agregar registros-->
<?php $this->load->view('medicos/agregar_view', array('especialidades' => $especialidades)); ?>