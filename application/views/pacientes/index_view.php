<div class="content-layout">
    <div class="content-layout-row">
	    <div class="layout-cell" style="width: 33%" >
	        <?= form_open('pacientes/', array('class' => 'search', 'id' => 'busquedaForm', 'method' => 'get')) ?>
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
			<?php if($num_pacientes > 0){ ?>
			<?php foreach ($pacientes as $pac): ?>
			<div class="col-md-4 col-sm-6 col-xs-12">	
		        <p style="text-align: center;">
		        <img width="180" height="180" class="lightbox" src="<?= base_url() ?>assets/images/personas/<?= $pac->foto ?>"><br></p>
		        <h3 style="text-align: center;"><?= $pac->nombre ?></h3>
		        <h4 style="text-align: center;"><?= $pac->documento ?></h4>
		        <p style="text-align: center;">
		        	<?php if($this->session->userdata('tipo') == "Administrador" || $this->session->userdata('tipo') == "Editor"): ?>
		        	<a href="#" class="button" title="Editar" data-toggle="modal" data-target="#ModalEditar<?= $pac->id ?>"><span class="glyphicon glyphicon-edit"></a>
		        	<?php endif?>
		        	<?php if($this->session->userdata('tipo') == "Administrador"): ?>
						<a href="#" class="button" title="Eliminar" data-toggle="modal" data-target="#ModalEliminar<?= $pac->id ?>"><span class="glyphicon glyphicon-remove"></a>
					<?php endif?>
		        </p>
		    </div>
		    <!--Modal Editar-->
			<?php
			$data = array(
				'id' => $pac->id,
				'nombre' => $pac->nombre,
				'documento' => $pac->documento,
				'sexo' => $pac->sexo,
				'email' => $pac->email,
				'tlf' => $pac->tlf,
				'foto' => $pac->foto,
				'nacimiento' => $pac->nacimiento,
				'adn' => $pac->adn,
				'peso' => $pac->peso,
				'altura' => $pac->altura,
				);
			$this->load->view('pacientes/editar_view', $data);
			?>
			<!--Modal Eliminar-->
			<?php
			$data = array('id' => $pac->id, 'nombre' => $pac->nombre);
			$this->load->view('pacientes/eliminar_view', $data);
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
<?php $this->load->view('pacientes/agregar_view', array('sangres' => $sangres)); ?>